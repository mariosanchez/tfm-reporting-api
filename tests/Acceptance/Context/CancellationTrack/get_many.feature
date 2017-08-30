Feature: Get many cancellation tracks

  Scenario:
    Given I send a GET request to "/cancellation-tracks/?page=1&per-page=10&affiliate-id=1&from-date=20170724&to-date=20170725"
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
      "cancellation_id": "9f1f9dce319c4700ef28ec8c53bd3cc8e6abe64c68385479ab89215806a5bdd6",
      "created_at": {
        "date": "2017-07-24 11:05:54.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      },
      "_links": {
        "self": {
          "href": "/app_test.php/cancellation-tracks/3"
        }
      }
    },
    {
      "id": "4",
      "affiliate_id": "1",
      "affiliate_key": "557b0c201096e0d91448c315ea376897582a0fac9799d34c87b0a121245aa33a",
      "cancellation_id": "28dae7c8bde2f3ca608f86d0e16a214dee74c74bee011cdfdd46bc04b655bc14",
      "created_at": {
        "date": "2017-07-24 11:05:54.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      },
      "_links": {
        "self": {
          "href": "/app_test.php/cancellation-tracks/4"
        }
      }
    },
    {
      "id": "5",
      "affiliate_id": "1",
      "affiliate_key": "557b0c201096e0d91448c315ea376897582a0fac9799d34c87b0a121245aa33a",
      "cancellation_id": "e5b861a6d8a966dfca7e7341cd3eb6be9901688d547a72ebed0b1f5e14f3d08d",
      "created_at": {
        "date": "2017-07-24 11:05:54.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      },
      "_links": {
        "self": {
          "href": "/app_test.php/cancellation-tracks/5"
        }
      }
    },
    {
      "id": "6",
      "affiliate_id": "1",
      "affiliate_key": "557b0c201096e0d91448c315ea376897582a0fac9799d34c87b0a121245aa33a",
      "cancellation_id": "2ac878b0e2180616993b4b6aa71e61166fdc86c28d47e359d0ee537eb11d46d3",
      "created_at": {
        "date": "2017-07-24 11:05:54.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      },
      "_links": {
        "self": {
          "href": "/app_test.php/cancellation-tracks/6"
        }
      }
    }
  ],
  "_links": {
    "first": {
      "href": "/app_test.php/cancellation-tracks/?affiliate-id=1&from-date=20170724&page=1&per-page=10&to-date=20170725"
    },
    "self": {
      "href": "/app_test.php/cancellation-tracks/?affiliate-id=1&from-date=20170724&page=1&per-page=10&to-date=20170725"
    },
    "prev": {
      "href": "/app_test.php/cancellation-tracks/?affiliate-id=1&from-date=20170724&page=1&per-page=10&to-date=20170725"
    },
    "next": {
      "href": "/app_test.php/cancellation-tracks/?affiliate-id=1&from-date=20170724&page=1&per-page=10&to-date=20170725"
    },
    "last": {
      "href": "/app_test.php/cancellation-tracks/?affiliate-id=1&from-date=20170724&page=1&per-page=10&to-date=20170725"
    }
  }
}
"""
