Feature: Get many affiliates

  Scenario:
    Given I send a GET request to "/affiliates/?page=1&per-page=3"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON should be equal to:
"""
{
  "count": 3,
  "total": 3,
  "_embedded": [
    {
      "id": "1",
      "status_id": 1,
      "key": "557b0c201096e0d91448c315ea376897582a0fac9799d34c87b0a121245aa33a",
      "name": "Pepe1",
      "last_name": "Mora1",
      "email": "pepe.mora1@mailinator.com",
      "_links": {
        "self": {
          "href": "/app_test.php/affiliates/1"
        }
      }
    },
    {
      "id": "2",
      "status_id": 2,
      "key": "da60c7fa32b7f3b82248a7cc551add02e7b24218b542651c85fd0a7cf4583869",
      "name": "Pepe2",
      "last_name": "Mora2",
      "email": "pepe.mora2@mailinator.com",
      "_links": {
        "self": {
          "href": "/app_test.php/affiliates/2"
        }
      }
    },
    {
      "id": "3",
      "status_id": 1,
      "key": "da60c7fa32b7f3b82248a7cc551add02e7b24218b542651c85fd0a7cf4583870",
      "name": "Pepe3",
      "last_name": "Mora3",
      "email": "pepe.mora3@mailinator.com",
      "_links": {
        "self": {
          "href": "/app_test.php/affiliates/3"
        }
      }
    }
  ],
  "_links": {
    "first": {
      "href": "/app_test.php/affiliates/?page=1&per-page=3"
    },
    "self": {
      "href": "/app_test.php/affiliates/?page=1&per-page=3"
    },
    "prev": {
      "href": "/app_test.php/affiliates/?page=1&per-page=3"
    },
    "next": {
      "href": "/app_test.php/affiliates/?page=1&per-page=3"
    },
    "last": {
      "href": "/app_test.php/affiliates/?page=1&per-page=3"
    }
  }
}
"""
