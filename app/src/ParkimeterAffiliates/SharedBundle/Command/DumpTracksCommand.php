<?php

namespace ParkimeterAffiliates\SharedBundle\Command;

use ParkimeterAffiliates\Domain\Model\CancellationTrack\CancellationTrack;
use ParkimeterAffiliates\Domain\Model\CancellationTrack\CancellationTrackRepository;
use ParkimeterAffiliates\Domain\Model\ClickTrack\ClickTrack;
use ParkimeterAffiliates\Domain\Model\Affiliate\AffiliateRepository;
use ParkimeterAffiliates\Domain\Model\ClickTrack\ClickTrackRepository;
use ParkimeterAffiliates\Domain\Model\ConversionTrack\ConversionTrack;
use ParkimeterAffiliates\Domain\Model\ConversionTrack\ConversionTrackRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Command\LockableTrait;
use MongoDB\Driver\Manager as MongoClient;
use MongoDB\BSON\UTCDateTime;

class DumpTracksCommand extends ContainerAwareCommand
{
    use LockableTrait;

    /**
     * @var SymfonyStyle
     */
    private $io;

    /**
     * @var MongoClient
     */
    private $mongoClient;

    /**
     * @var AffiliateRepository
     */
    private $affiliateRepo;

    /**
     * @var ClickTrackRepository
     */
    private $clickTrackRepo;

    /**
     * @var ConversionTrackRepository
     */
    private $conversionTrackRepo;

    /**
     * @var CancellationTrackRepository
     */
    private $cancellationTrackRepo;

    public function __construct(
        AffiliateRepository $affiliateRepo,
        ClickTrackRepository $clickTrackRepo,
        ConversionTrackRepository $conversionTrackRepo,
        CancellationTrackRepository $cancellationTrackRepo
    ) {
        $this->affiliateRepo = $affiliateRepo;
        $this->clickTrackRepo = $clickTrackRepo;
        $this->conversionTrackRepo = $conversionTrackRepo;
        $this->cancellationTrackRepo = $cancellationTrackRepo;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('tracks:dump')
            ->setDescription('Bulk dumps all tracks')
            ->setHelp('This command allows you to dump all tracks from MongoDB to MySQL.');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        if (!$this->lock()) {
            $output->writeln('The command is already running in another process.');

            return 0;
        }

        $this->io = new SymfonyStyle($input, $output);

        parent::initialize($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->io->title('Affiliate Track Bulk Dump');
        $this->io->section('Dumping data');

        $this->mongoClient = $this->connect();

        $this->dumpClickTracks();
        $this->dumpConversionTracks();
        $this->dumpCancellationTracks();

        $this->io->success('Finish!');
        $this->release();
    }

    /**
     * @param $mongoTracks
     * @return array
     */
    private function createClickTracksFromMongoData($mongoTracks)
    {
        $tracks = [];
        foreach ($mongoTracks as $track) {
            $track = (array) $track;
            $affiliateId = $this->getAffiliateIdByKey($track['affiliate_key']);

            if (!isset($affiliateId)) {
                continue;
            }

            $tracks[] = ClickTrack::create(
                null,
                $affiliateId,
                $track['affiliate_key'],
                $track['_id'],
                $track['created_at']->toDateTime(),
                (int) $track['created_at']->__toString()
            );
        }

        return $tracks;
    }

    /**
     * @param $mongoTracks
     * @return array
     */
    private function createConversionTracksFromMongoData($mongoTracks)
    {
        $tracks = [];
        foreach ($mongoTracks as $track) {
            $track = (array) $track;
            $affiliateId = $this->getAffiliateIdByKey($track['affiliate_key']);

            if (!isset($affiliateId)) {
                continue;
            }

            $tracks[] = ConversionTrack::create(
                null,
                $affiliateId,
                $track['affiliate_key'],
                $track['conversion_id'],
                $track['created_at']->toDateTime(),
                (int) $track['created_at']->__toString()
            );
        }

        return $tracks;
    }

    /**
     * @param $mongoTracks
     * @return array
     */
    private function createCancellationTracksFromMongoData($mongoTracks)
    {
        $tracks = [];
        foreach ($mongoTracks as $track) {
            $track = (array) $track;
            $affiliateId = $this->getAffiliateIdByKey($track['affiliate_key']);

            if (!isset($affiliateId)) {
                continue;
            }

            $tracks[] = CancellationTrack::create(
                null,
                $affiliateId,
                $track['affiliate_key'],
                $track['cancellation_id'],
                $track['created_at']->toDateTime(),
                (int) $track['created_at']->__toString()
            );
        }

        return $tracks;
    }

    private function connect()
    {
        $user           = $this->getContainer()->getParameter('mongodb_user');
        $password       = $this->getContainer()->getParameter('mongodb_password');
        $host           = $this->getContainer()->getParameter('mongodb_host');
        $port           = $this->getContainer()->getParameter('mongodb_port');
        $database       = $this->getContainer()->getParameter('mongodb_collection');
        $connectionData = "mongodb://";
        if (!empty($user) && !empty($password)) {
            $connectionData .= $user . ":" . $password . "@";
        }
        $connectionData .= $host;
        if (!empty($port)) {
            $connectionData .= ":" . $port;
        }
        if (!empty($database)) {
            $connectionData .= "/" . $database;
        }

        try {
            return new MongoClient($connectionData);
        } catch (\MongoConnectionException $e) {
            $this->io->error($e->getMessage());
        }

        return null;
    }

    /**
     * @return ClickTrack
     */
    private function getLastClickTrack(): ClickTrack
    {
        $track = $this->clickTrackRepo->findOneBy([], ['createdAtEpoch' => 'DESC']);

        return $track;
    }

    /**
     * @return ConversionTrack
     */
    private function getLastConversionTrack(): ConversionTrack
    {
        $track = $this->conversionTrackRepo->findOneBy([], ['createdAtEpoch' => 'DESC']);

        return $track;
    }

    /**
     * @return CancellationTrack
     */
    private function getLastCancellationTrack(): CancellationTrack
    {
        $track = $this->cancellationTrackRepo->findOneBy([], ['createdAtEpoch' => 'DESC']);

        return $track;
    }

    /**
     * @param int $milliseconds
     * @return \MongoDB\Driver\Query
     */
    private function getTrackFromDateQuery(int $milliseconds):\MongoDB\Driver\Query
    {
        $query = new \MongoDB\Driver\Query(
            [
                'created_at' => [
                    '$gt' => new UTCDateTime($milliseconds)
                ]
            ]
        );

        return $query;
    }

    /**
     * @param string $key
     * @return null|int
     */
    private function getAffiliateIdByKey(string $key): ?int
    {
        $affiliate = $this->affiliateRepo->findOneByColumn('affiliateKey', $key);

        if (!isset($affiliate)) {
            return null;
        }

        return $affiliate->getId();
    }

    protected function dumpClickTracks()
    {
        $this->io->text('Dumping click tracks...');

        $lastClickTrack = $this->getLastClickTrack();
        $query = $this->getTrackFromDateQuery($lastClickTrack->getCreatedAtEpoch());
        $mongoClickTracks = $this->mongoClient->executeQuery('admin.clicks', $query);
        $clickTracks = $this->createClickTracksFromMongoData($mongoClickTracks);
        $this->clickTrackRepo->saveMany($clickTracks);

        $this->io->text('Total click tracks imported: ' . count($clickTracks));

        return;
    }

    protected function dumpConversionTracks()
    {
        $this->io->text('Dumping conversion tracks...');

        $lastConversionTrack = $this->getLastConversionTrack();
        $query = $this->getTrackFromDateQuery($lastConversionTrack->getCreatedAtEpoch());
        $mongoConversionTracks = $this->mongoClient->executeQuery('admin.conversions', $query);
        $conversionTracks = $this->createConversionTracksFromMongoData($mongoConversionTracks);
        $this->conversionTrackRepo->saveMany($conversionTracks);

        $this->io->text('Total conversion tracks imported: ' . count($conversionTracks));

        return;
    }

    protected function dumpCancellationTracks()
    {
        $this->io->text('Dumping cancellation tracks...');

        $lastCancellationTrack = $this->getLastCancellationTrack();
        $query = $this->getTrackFromDateQuery($lastCancellationTrack->getCreatedAtEpoch());
        $mongoCancellationTracks = $this->mongoClient->executeQuery('admin.cancellations', $query);
        $cancellationTracks = $this->createCancellationTracksFromMongoData($mongoCancellationTracks);
        $this->cancellationTrackRepo->saveMany($cancellationTracks);

        $this->io->text('Total cancellation tracks imported: ' . count($cancellationTracks));

        return;
    }
}
