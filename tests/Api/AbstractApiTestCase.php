<?php

declare(strict_types=1);


namespace App\Tests\Api;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractApiTestCase extends ApiTestCase
{
    use RefreshDatabaseTrait;

    private Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient([], [
            'auth_basic' => 'user1:password',
        ]);
    }

    abstract protected function getEndpoint(): string;

    public function testList(): void
    {
        $this->client->request(Request::METHOD_GET, $this->getEndpoint());

        $this->assertResponseIsSuccessful();
    }

    public function testGet(): void
    {
        $this->client->request(Request::METHOD_GET, "{$this->getEndpoint()}/1");

        $this->assertResponseIsSuccessful();
    }

    /**
     * @dataProvider postDataProvider
     */
    public function testPost(array $payload, int $expectedCode): void
    {
        $response = $this->client->request(Request::METHOD_POST, $this->getEndpoint(), [
            'body' => json_encode($payload),
            'headers' => [
                'CONTENT_TYPE' => 'application/json'
            ]
        ]);

        $content = $response->getContent(false);

        $this->assertResponseStatusCodeSame($expectedCode);
    }

    /**
     * @dataProvider putDataProvider
     */
    public function testPut(int $id, array $payload, int $expectedCode): void
    {
        $this->client->request(Request::METHOD_PUT, "{$this->getEndpoint()}/{$id}", [
            'body' => json_encode($payload),
            'headers' => [
                'CONTENT_TYPE' => 'application/json'
            ]
        ]);

        $this->assertResponseStatusCodeSame($expectedCode);
    }

    public function testDelete(): void
    {
        $this->client->request(Request::METHOD_DELETE, "{$this->getEndpoint()}/1");

        $this->assertResponseIsSuccessful();
    }

    abstract public function postDataProvider(): iterable;

    abstract public function putDataProvider(): iterable;
}