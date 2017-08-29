Feature: Edit an affiliate

  Scenario:
    Given I send a PUT request to "/affiliates/2" with body:
"""
{
  "name": "test",
  "last_name": "test",
  "email": "test@test.com"
}
"""
    Then the response status code should be 200
    And I send a GET request to "/affiliates/2"
    Then the response status code should be 200
    Then the response should be in JSON
    And the JSON should be equal to:
"""
{
  "id": "2",
  "status_id": 2,
  "key": "da60c7fa32b7f3b82248a7cc551add02e7b24218b542651c85fd0a7cf4583869",
  "name": "test",
  "last_name": "test",
  "email": "test@test.com",
  "_links": {
    "self": {
      "href": "/app_test.php/affiliates/2"
    }
  }
}
"""

  Scenario:
    Given I send a PUT request to "/affiliates/2" with body:
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
    Given I send a PUT request to "/affiliates/2" with body:
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