Feature: Get a affiliate

  Background:
    Given I send a POST request to "/affiliates" with body:
"""
{
  "id": "bfbaf03c-027c-42e7-a5d4-000000000011",
  "field1": "hello",
  "field2": "party",
  "field3": "people"
}
"""
    And the response status code should be 201

  Scenario:
    Given I send a GET request to "/affiliates/bfbaf03c-027c-42e7-a5d4-000000000011"
    Then the response should be in JSON
    And the JSON should be equal to:
"""
{
  "id": "bfbaf03c-027c-42e7-a5d4-000000000011",
  "field1": "hello",
  "field2": "party",
  "field3": "people",
  "_links":{
    "self":{
        "href":"\/affiliates\/bfbaf03c-027c-42e7-a5d4-000000000011"
    }
  }
}
"""

  Scenario:
    Given I send a GET request to "/affiliates/aaaa"
    Then the response status code should be 400
    Then the response should be in JSON
    And the JSON should be equal to:
"""
{
  "total":1,
  "_embedded":{
    "errors":[
      {
        "message":"Provided identifier 'aaaa' is not a valid UUID.",
        "path":"\/id"
      }
    ]
  }
}
"""