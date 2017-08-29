Feature: Get many conversion tracks

  Scenario:
    Given I send a GET request to "/conversion-tracks/?page=1&per-page=10&affiliate-id=1&from-date=20170724&to-date=20170725"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON should be equal to:
"""
{
  "count": 4,
  "total": 4,
  "_embedded": [
    {
      "id": "3",
      "affiliate_id": "1",
      "affiliate_key": "557b0c201096e0d91448c315ea376897582a0fac9799d34c87b0a121245aa33a",
      "conversion_id": "8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61",
      "crated_at": {
        "date": "2017-07-24 11:05:54.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      },
      "_links": {
        "self": {
          "href": "/app_test.php/conversion-tracks/3"
        }
      }
    },
    {
      "id": "4",
      "affiliate_id": "1",
      "affiliate_key": "557b0c201096e0d91448c315ea376897582a0fac9799d34c87b0a121245aa33a",
      "conversion_id": "e629fa6598d732768f7c726b4b621285f9c3b85303900aa912017db7617d8bdb",
      "crated_at": {
        "date": "2017-07-24 11:05:54.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      },
      "_links": {
        "self": {
          "href": "/app_test.php/conversion-tracks/4"
        }
      }
    },
    {
      "id": "5",
      "affiliate_id": "1",
      "affiliate_key": "557b0c201096e0d91448c315ea376897582a0fac9799d34c87b0a121245aa33a",
      "conversion_id": "b17ef6d19c7a5b1ee83b907c595526dcb1eb06db8227d650d5dda0a9f4ce8cd9",
      "crated_at": {
        "date": "2017-07-24 11:05:54.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      },
      "_links": {
        "self": {
          "href": "/app_test.php/conversion-tracks/5"
        }
      }
    },
    {
      "id": "6",
      "affiliate_id": "1",
      "affiliate_key": "557b0c201096e0d91448c315ea376897582a0fac9799d34c87b0a121245aa33a",
      "conversion_id": "4523540f1504cd17100c4835e85b7eefd49911580f8efff0599a8f283be6b9e3",
      "crated_at": {
        "date": "2017-07-24 11:05:54.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      },
      "_links": {
        "self": {
          "href": "/app_test.php/conversion-tracks/6"
        }
      }
    }
  ],
  "_links": {
    "first": {
      "href": "/app_test.php/conversion-tracks/?affiliate-id=1&from-date=20170724&page=1&per-page=10&to-date=20170725"
    },
    "self": {
      "href": "/app_test.php/conversion-tracks/?affiliate-id=1&from-date=20170724&page=1&per-page=10&to-date=20170725"
    },
    "prev": {
      "href": "/app_test.php/conversion-tracks/?affiliate-id=1&from-date=20170724&page=1&per-page=10&to-date=20170725"
    },
    "next": {
      "href": "/app_test.php/conversion-tracks/?affiliate-id=1&from-date=20170724&page=1&per-page=10&to-date=20170725"
    },
    "last": {
      "href": "/app_test.php/conversion-tracks/?affiliate-id=1&from-date=20170724&page=1&per-page=10&to-date=20170725"
    }
  }
}
"""
