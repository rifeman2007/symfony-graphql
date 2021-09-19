<?php

namespace App\Tests;

use Doctrine\ORM\Tools\SchemaTool;
use Liip\FunctionalTestBundle\Test\WebTestCase as BaseWebTestCase;

class WebTestCase extends BaseWebTestCase
{
    private static $dbLoaded = false;

    public function setUp(): void
    {
        if (self::$dbLoaded) {
            return;
        }
        $this->resetDatabase();
        self::$dbLoaded = true;
    }

    protected function resetDatabase()
    {        
    }

    protected function request($query, $jsonVariables = '{}')
    {
        $client = static::makeClient();
        $path   = $this->getUrl('overblog_graphql_endpoint');

        $client->request(
            'GET', $path, ['query' => $query, 'variables' => $jsonVariables], [], ['CONTENT_TYPE' => 'application/graphql']
        );

        $result = json_decode($client->getResponse()->getContent());

        return $result->data;
    }

    protected function assertQuery($query, $jsonExpected, $jsonVariables = '{}')
    {
        $client = static::makeClient();
        $path   = $this->getUrl('overblog_graphql_endpoint');

        $client->request(
            'GET', $path, ['query' => $query, 'variables' => $jsonVariables], [], ['CONTENT_TYPE' => 'application/graphql']
        );
        $result = $client->getResponse()->getContent();

        $this->assertStatusCode(200, $client);
        $this->assertEquals(json_decode($jsonExpected, true), json_decode($result, true), $result);
    }
}