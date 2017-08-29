Feature: Add a new affiliate

  Scenario:
    Given I send a POST request to "/affiliates/" with body:
"""
{
  "name": "test",
  "last_name": "test",
  "email": "test@test.com"
}
"""
    Then the response status code should be 201
    And I send a GET request to "/affiliates/4"
    Then the response status code should be 200
    Then the response should be in JSON

  Scenario:
    Given I send a POST request to "/affiliates/" with body:
"""
{
  "name": "test",
  "last_name": "test",
  "email": "test"
}
"""
    Then the response status code should be 400
    And the response should be in JSON
    And the JSON should be equal to:
"""
{
  "total": 1,
  "_embedded": {
    "errors": [
      {
        "message": "Provided value 'test' is considered an empty value or invalid.",
        "path": "/email"
      }
    ]
  }
}
"""

  Scenario:
    Given I send a POST request to "/affiliates/" with body:
"""
{
  "name": "test",
  "last_name": "test",
  "email": "pepe.mora1@mailinator.com"
}
"""
    Then the response status code should be 400
    And the response should be in JSON
    And the JSON should be equal to:
"""
{
  "total": 1,
  "_embedded": {
    "errors": [
      {
        "message": "Provided value 'pepe.mora1@mailinator.com' is considered an empty value or invalid.",
        "path": "/email"
      }
    ]
  }
}
"""