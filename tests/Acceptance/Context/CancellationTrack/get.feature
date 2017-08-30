Feature: Get a cancellation track

  Scenario:
    Given I send a GET request to "/cancellation-tracks/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON should be equal to:
"""
{
  "id": "1",
  "affiliate_id": "1",
  "affiliate_key": "557b0c201096e0d91448c315ea376897582a0fac9799d34c87b0a121245aa33a",
  "cancellation_id": "b1556dea32e9d0cdbfed038fd7787275775ea40939c146a64e205bcb349ad02f",
  "created_at": {
    "date": "2017-07-23 11:05:54.000000",
    "timezone_type": 3,
    "timezone": "UTC"
  },
  "_links": {
    "self": {
      "href": "/app_test.php/cancellation-tracks/1"
    }
  }
}
"""

  Scenario:
    Given I send a GET request to "/cancellation-tracks/99999"
    Then the response status code should be 404
    Then the response should be in JSON
    And the JSON should be equal to:
"""
{
  "total": 1,
  "_embedded": {
    "errors": [
      {
        "message": "Could not find cancellation track with id '99999'.",
        "path": "/id"
      }
    ]
  }
}
"""