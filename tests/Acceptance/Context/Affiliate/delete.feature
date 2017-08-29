Feature: Delete an affiliate

  Scenario:
    Given I send a DELETE request to "/affiliates/1"
    Then the response status code should be 204

  Scenario:
    Given I send a DELETE request to "/affiliates/99999"
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