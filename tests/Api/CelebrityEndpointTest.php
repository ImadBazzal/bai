<?php

namespace App\Tests\Api;

use Symfony\Component\HttpFoundation\Response;

class CelebrityEndpointTest extends AbstractApiTestCase
{
    protected function getEndpoint(): string
    {
        return 'api/celebrities';
    }

    public function postDataProvider(): iterable
    {
        yield 'valid payload' => [
            'payload' => [
                'name' => 'Some name',
                'birthday' => date('Y-m-d'),
                'bio' => 'Some bio',
            ],
            'expectedCode' => Response::HTTP_CREATED
        ];
    }

    public function putDataProvider(): iterable
    {
        yield 'valid payload' => [
            'id' => 1,
            'payload' => [
                'name' => 'Some updated name',
            ],
            'expectedCode' => Response::HTTP_OK
        ];
    }
}
