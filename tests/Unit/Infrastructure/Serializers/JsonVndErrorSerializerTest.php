<?php
namespace ParkimeterAffiliates\Tests\Unit\Infrastructure\Serializers;

use ParkimeterAffiliates\Domain\Model\ErrorBag;
use ParkimeterAffiliates\Infrastructure\Serializers\JsonVndErrorSerializer;

final class JsonVndErrorSerializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itCanSerializeErrorBagToVndError()
    {
        $errorBag = new ErrorBag("Some Parkimeter Affiliates test error", 400);
        $errorBag->add("email", "Provided address 'hello-world' is invalid or empty.");

        $serializer = new JsonVndErrorSerializer();

        $vndError = $serializer->serialize($errorBag);

        $expected = <<<JSON
{
  "total": 1,
  "_embedded": {
    "errors": [
      {
        "message": "Provided address 'hello-world' is invalid or empty.",
        "path": "\/email"
      }
    ]
  }
}
JSON;

        $this->assertEquals(json_decode($expected), json_decode($vndError));
    }
}
