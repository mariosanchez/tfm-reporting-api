<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate\GetManyAffiliate;

class GetManyAffiliateResponse
{

    const DEFAULT_FIRST_PAGE = 1;

    /**
     * @var array
     */
    private $content = [];

    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $perPage;

    /**
     * @var int
     */
    private $totalPages;

    /**
     * @var int
     */
    private $totalElements;

    /**
     * GetManyRequest constructor.
     * @param array|null $content
     * @param int|null $page
     * @param int|null $perPage
     * @param int|null $totalElements
     */
    public function __construct(
        ?array $content,
        ?int $page,
        ?int $perPage,
        ?int $totalElements
    ) {
        $this->content = $content;
        $this->page = (int) $page;
        $this->perPage = (int) $perPage;
        $this->totalPages = (int) $this->calculateTotalPages();
        $this->totalElements = (int) $totalElements;
    }

    /**
     * @return array|null
     */
    public function content(): ?array
    {
        return $this->content;
    }

    /**
     * @return int|null
     */
    public function page(): ?int
    {
        return $this->page;
    }

    /**
     * @return int|null
     */
    public function perPage(): ?int
    {
        return $this->perPage;
    }

    /**
     * @return int|null
     */
    public function totalPages(): ?int
    {
        return $this->totalPages;
    }

    /**
     * @return int|null
     */
    public function totalElements(): ?int
    {
        return $this->totalElements;
    }

    /**
     * @return int
     */
    public function firstPage(): int
    {
        return self::DEFAULT_FIRST_PAGE;
    }

    /**
     * @return int
     */
    public function previousPage(): int
    {
        $previousPage = $this->page() - 1;

        return ($previousPage < self::DEFAULT_FIRST_PAGE) ? self::DEFAULT_FIRST_PAGE : $previousPage;
    }

    /**
     * @return int
     */
    public function nextPage(): int
    {
        $nextPage = $this->page() + 1;

        return ($nextPage < $this->totalPages) ? $nextPage : $this->totalPages;
    }

    /**
     * @return int
     */
    private function calculateTotalPages(): int
    {
        $elementPerPageRelation = ($this->totalElements / $this->perPage);

        return  $elementPerPageRelation < self::DEFAULT_FIRST_PAGE ? self::DEFAULT_FIRST_PAGE : $elementPerPageRelation;
    }
}
