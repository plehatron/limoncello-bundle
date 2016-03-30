<?php

namespace Plehatron\LimoncelloBundle\Tests\Integration\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryControllerTest extends WebTestCase
{
    protected function assertIsJson($data)
    {
        json_decode($data);
        $this->assertTrue(json_last_error() == JSON_ERROR_NONE);
    }

    protected function assertIsResponseCode($expected, Response $response, $message = null)
    {
        $this->assertEquals($expected, $response->getStatusCode(), $message);
    }

    public function testIndexAction()
    {
        $client = static::createClient();
        $client->request('GET', '/api/category');
        $response = $client->getResponse();
        $this->assertIsResponseCode(Response::HTTP_OK, $response);
        $body = $response->getContent();
        $this->assertIsJson($body);
        $expected = <<<JSON
{"data":[{"type":"category","id":"1","links":{"self":"\/api\/category\/1"}},{"type":"category","id":"2","links":{"self":"\/api\/category\/2"}}]}
JSON;
        $this->assertEquals($expected, $body);
    }

    public function testShowAction()
    {
        $client = static::createClient();
        $client->request('GET', '/api/category/1');
        $response = $client->getResponse();
        $this->assertIsResponseCode(Response::HTTP_OK, $response);
        $body = $response->getContent();
        $this->assertIsJson($body);
        $expected = <<<JSON
{"data":{"type":"category","id":"1","links":{"self":"\/api\/category\/1"}}}
JSON;
        $this->assertEquals($expected, $body);
    }

    public function testShowNotFoundAction()
    {
        $this->expectException(NotFoundHttpException::class);
        $client = static::createClient();
        $client->request('GET', '/api/category/2');
    }
}