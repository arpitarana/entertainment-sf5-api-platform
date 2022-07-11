<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\ApiToken;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class MovieTest
 * @package App\Tests
 */
class MovieTest extends ApiTestCase
{
    private const API_TOKEN = '5d554081460ad848858d50dedea2f0deeedc7042c3c84b1b2a348dc9fbc71ee57975bd496f566990e43afba7c8200a633a013b499914db84e9812e68';

    private HttpClientInterface $client;
    private EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        $this->client = $this->createClient();
        $this->entityManager = $this->client->getContainer()->get('doctrine')->getManager();

    }

    public function testCreateMovie(): void
    {
        $this->client->request('POST', '/api/v1/movies', [
            'headers' => ['x-api-token' => self::API_TOKEN],
            'json'    => [
                'name'         => 'A Test Movie',
                'director'  => 'A Test Director name',
                'realeaseDate'    => '2022-07-31',
                'casts' => ["/api/v1/casts/1"],
            ]
        ]);

        $this->assertResponseStatusCodeSame(201);

        $this->assertResponseHeaderSame(
            'content-type', 'application/ld+json; charset=utf-8'
        );

        $this->assertJsonContains([
            'name'         => 'A Test Movie',
            'director'  => 'A Test Director name',
            'casts' => ["/api/v1/casts/1"]
        ]);
    }

    public function testUpdateMovie(): void
    {
        $this->client->request('PUT', '/api/v1/movies/1', [
            'headers' => ['x-api-token' => self::API_TOKEN],
            'json'    => [
                'name'         => 'A Test Movie1',
                'director'  => 'A Test Director name1',
                'realeaseDate'    => '2022-07-31',
                'casts' => ["/api/v1/casts/1"],
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);

        $this->assertResponseHeaderSame(
            'content-type', 'application/ld+json; charset=utf-8'
        );

        $this->assertJsonContains([
            'name'         => 'A Test Movie1',
            'director'  => 'A Test Director name1',
            'casts' => ["/api/v1/casts/1"]
        ]);
    }

    public function testGetCollection(): void
    {
        $response = $this->client->request('GET', '/api/v1/movies', [
            'headers' => ['x-api-token' => self::API_TOKEN]
        ]);

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame(
            'content-type', 'application/ld+json; charset=utf-8'
        );

        $this->assertJsonContains([
            '@context'         => '/api/v1/contexts/Movie',
            '@id'              => '/api/v1/movies',
            '@type'            => 'hydra:Collection',
            'hydra:totalItems' => 1
        ]);

        $this->assertCount(1, $response->toArray()['hydra:member']);
    }

    public function testPagination(): void
    {
        $response = $this->client->request('GET', '/api/v1/movies?page=1', [
            'headers' => ['x-api-token' => self::API_TOKEN]
        ]);
        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame(
            'content-type', 'application/ld+json; charset=utf-8'
        );
        $this->assertJsonContains([
            '@context'         => '/api/v1/contexts/Movie',
            '@id'              => '/api/v1/movies',
            '@type'            => 'hydra:Collection',
            'hydra:totalItems' => 1
        ]);
        $this->assertCount(1, $response->toArray()['hydra:member']);
    }

    public function testCreateInvalidMovie(): void
    {
        $this->client->request('POST', '/api/v1/movies', [
            'headers' => ['x-api-token' => self::API_TOKEN],
            'json' => [
                'name'         => "",
                'director'  => 'A Test Director name',
                'realeaseDate'    => '2022-07-31',
                'casts' => ["api/v1/casts/1"]
            ]
        ]);

        $this->assertResponseStatusCodeSame(422);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context'          => '/api/v1/contexts/ConstraintViolationList',
            '@type'             => 'ConstraintViolationList',
            'hydra:title'       => 'An error occurred',
            'hydra:description' => 'name: This value should not be blank.',
        ]);
    }

    public function testInvalidToken(): void
    {
        $response = $this->client->request('GET', '/api/v1/movies', [
            'headers' => ['x-api-token' => 'fake-token']
        ]);

        $this->assertResponseStatusCodeSame(401);
        $this->assertJsonContains([
            'message'         => 'Invalid credentials.',
        ]);
    }
}










