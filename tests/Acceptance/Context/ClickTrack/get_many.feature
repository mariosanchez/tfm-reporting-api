Feature: Get many click tracks

  Scenario:
    Given I send a GET request to "/click-tracks/?page=1&per-page=10&affiliate-id=1&from-date=20170724&to-date=20170725"
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
      "click_id": "4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a",
      "crated_at": {
        "date": "2017-07-24 11:05:54.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      },
      "_links": {
        "self": {
          "href": "/app_test.php/click-tracks/3"
        }
      }
    },
    {
      "id": "4",
      "affiliate_id": "1",
      "affiliate_key": "557b0c201096e0d91448c315ea376897582a0fac9799d34c87b0a121245aa33a",
      "click_id": "ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d",
      "crated_at": {
        "date": "2017-07-24 11:05:54.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      },
      "_links": {
        "self": {
          "href": "/app_test.php/click-tracks/4"
        }
      }
    },
    {
      "id": "5",
      "affiliate_id": "1",
      "affiliate_key": "557b0c201096e0d91448c315ea376897582a0fac9799d34c87b0a121245aa33a",
      "click_id": "e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683",
      "crated_at": {
        "date": "2017-07-24 11:05:54.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      },
      "_links": {
        "self": {
          "href": "/app_test.php/click-tracks/5"
        }
      }
    },
    {
      "id": "6",
      "affiliate_id": "1",
      "affiliate_key": "557b0c201096e0d91448c315ea376897582a0fac9799d34c87b0a121245aa33a",
      "click_id": "7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451",
      "crated_at": {
        "date": "2017-07-24 11:05:54.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      },
      "_links": {
        "self": {
          "href": "/app_test.php/click-tracks/6"
        }
      }
    }
  ],
  "_links": {
    "first": {
      "href": "/app_test.php/click-tracks/?affiliate-id=1&from-date=20170724&page=1&per-page=10&to-date=20170725"
    },
    "self": {
      "href": "/app_test.php/click-tracks/?affiliate-id=1&from-date=20170724&page=1&per-page=10&to-date=20170725"
    },
    "prev": {
      "href": "/app_test.php/click-tracks/?affiliate-id=1&from-date=20170724&page=1&per-page=10&to-date=20170725"
    },
    "next": {
      "href": "/app_test.php/click-tracks/?affiliate-id=1&from-date=20170724&page=1&per-page=10&to-date=20170725"
    },
    "last": {
      "href": "/app_test.php/click-tracks/?affiliate-id=1&from-date=20170724&page=1&per-page=10&to-date=20170725"
    }
  }
}
"""
