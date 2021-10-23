<?php

namespace App\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RepresentativeEndpointTest extends AbstractApiTestCase
{
    protected function getEndpoint(): string
    {
        return 'api/representatives';
    }

    public function postDataProvider(): iterable
    {
        yield 'valid payload' => [
            'payload' => [
                'name' => 'Some name',
                'company' => 'some company',
                'emails' => [
                    [
                        'email' => 'new@email.com'
                    ]
                ]
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
                'company' => 'Some updated company',
            ],
            'expectedCode' => Response::HTTP_OK
        ];
    }
}
