Feature: Get an affiliate

  Scenario:
    Given I send a GET request to "/affiliates/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON should be equal to:
"""
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
}
"""

  Scenario:
    Given I send a GET request to "/affiliates/99999"
    Then the response status code should be 404
    Then the response should be in JSON
    And the JSON should be equal to:
"""
{
  "total": 1,
  "_embedded": {
    "errors": [
      {
        "message": "Could not find affiliate with id '99999'.",
        "path": "/id"
      }
    ]
  }
}
"""