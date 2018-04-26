<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->bearerToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBkMTk2YWQxYTYwMzA2YWZlZWY3M2YyODZmMDQ2MDY5YWViM2NmZjQ3YTMwOGE0NzBkMzczNzk3MmU5NTQ0YmIwY2I4MjllMjNkMGM4YzY3In0.eyJhdWQiOiIyIiwianRpIjoiMGQxOTZhZDFhNjAzMDZhZmVlZjczZjI4NmYwNDYwNjlhZWIzY2ZmNDdhMzA4YTQ3MGQzNzM3OTcyZTk1NDRiYjBjYjgyOWUyM2QwYzhjNjciLCJpYXQiOjE1MjQ3MjUyNTgsIm5iZiI6MTUyNDcyNTI1OCwiZXhwIjoxNTU2MjYxMjU4LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.jc0BlJmggOVwc6Ny-KOhB1uhAgZxf1Fn1WkFmxer74LFtGfJhAciwfXnehphvgj3IWJF3elTQgVtMvsyMlDM3WJIDgXG-9YnX-i8oM-SxMWIbCeoqGIzs35Itm9J77vPcSdkgFyz8r9m3i5c_j8MlQ4GeAANZf5UGaJgw4jEvc--4whsu1NcchIXRTl2QLgAOXRH0DxOZyW9CRfNwwVFgYz3E5CPz4cuq_DGkaWJvuC8GHEhJN9g4B-a5Jf90w7CprU_0FQn9up0bic1EjUhZKi5exFUVlYddFVvlv3LxUqs2HXjzwX0awcpOjKcl5nNTzhwK1kfwDdBXXNR5GX7EPKf46zKv3soL51ikfWE55bH52ePjdjskNaSb1xykxfh84R6K175G-QYybXvffAZ1QxuXoFlKHfkz3v5fYVp7cATOVEhjBvaQTNdrH_wDvNsohALupWFFKiUDjqkOWvcg47YBu_euusnhKUxPJF0xahPymNCwdB0g14gKAPtFbUco12kivHgiV5L4HBkJhGvVfRR_KxAJ-5fHc3VflbHpDRgfz6RX5VjuuQrlc9xp_CZS3U4YQ9LYQRilixv9MjWLKecuzOaNCfZdtkeP6NEcXJhUdnyFiiNOHW0HVqfR992w3kEGJ_-vMAd0zajbWBGPCvucLLbz2iRGJt9gYWAzKs";
    }

    /**
     * @Given I have the payload:
     */
    public function iHaveThePayload(PyStringNode $string)
    {
        $this->payload = $string;
    }

    /**
     * @When /^I request "(GET|PUT|POST|DELETE|PATCH) ([^"]*)"$/
     */
    public function iRequest($httpMethod, $argument1)
    {
        $client = new \GuzzleHttp\Client(['verify' => false]);
        $this->response = $client->request(
            $httpMethod,
            'https://Laravel-Building-RESTful-APIs.dev' . $argument1,
            [
                'body' => $this->payload,
                'headers' => [
                    "Authorization" => "Bearer {$this->bearerToken}",
                    "Content-Type" => "application/json",
                ],
            ]
        );
        $this->responseBody = $this->response->getBody(true);
    }

    /**
     * @Then /^I get a response$/
     */
    public function iGetAResponse()
    {
        if (empty($this->responseBody)) {
            throw new Exception('Did not get a response from the API');
        }
    }

    /**
     * @Given /^the response is JSON$/
     */
    public function theResponseIsJson()
    {
        $data = json_decode($this->responseBody);

        if (empty($data)) {
            throw new Exception("Response was not JSON\n" . $this->responseBody);
        }
    }
}