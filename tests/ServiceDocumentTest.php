<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServiceDocumentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheckToSeeNameSpaces()
    {
        $this->visit('/odata.svc')
             ->see('xmlns:atom="http://www.w3.org/2005/Atom"')
             ->see('xml:base="http://localhost/odata.svc"')
             ->see('xmlns="http://www.w3.org/2007/app"');

    }

    public function testXML()
    {
        $response = $this->call('GET', '/odata.svc');
        $this->assertEquals(200, $response->status());
        libxml_use_internal_errors(true);

        $xml = new DOMDocument();
        $xml->loadXML($response->content());
        $errors = libxml_get_errors();
        $this->assertTrue(empty($errors));
        $xml->schemaValidateSource(Schemas::ATOMxsd());

//        $xml->schemaValidate(__DIR__ . "/ATOM.xsd");

        dd($xml);

    }
}
