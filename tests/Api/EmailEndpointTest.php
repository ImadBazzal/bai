<?php

namespace App\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EmailEndpointTest extends AbstractApiTestCase
{
    protected function getEndpoint(): string
    {
        return 'api/emails';
    }

    public function postDataProvider(): iterable
    {
        yield 'valid payload' => [
            'payload' => [
                'email' => 'test@email.com',
                'representative' => 'api/representatives/1',
            ],
            'expectedCode' => Response::HTTP_CREATED
        ];
    }

    public function putDataProvider(): iterable
    {
        yield 'valid payload' => [
            'id' => 1,
            'payload' => [
                'email' => 'updated@email.com',
            ],
            'expectedCode' => Response::HTTP_OK
        ];
    }
}
