Feature: Get an affiliate

  Scenario:
    Given I send a GET request to "/affiliates/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON should be equal to:
"""
{
  "id": "1",
  "key": "557b0c201096e0d91448c315ea376897582a0fac9799d34c87b0a121245aa33a",
  "name": "Pepe",
  "last_name": "Mora",
  "email": "pepe.mora@mailinator.com",
  "_links": {
    "self": {
      "href": "/app_dev.php/affiliates/1"
    }
  }
}
"""