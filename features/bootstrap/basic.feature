Feature: Sample Test
In order to test API
I need to be able to test the API

Scenario: Get Questions
Given I have the payload:
"""
"""
When I request "GET /api/questions"
Then the response is JSON
