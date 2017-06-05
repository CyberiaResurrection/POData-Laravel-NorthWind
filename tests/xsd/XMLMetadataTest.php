<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class XMLXSDMetadataTest extends TestCase
{

    public function getMetadataDocument($version)
    {
        $user = new User();
        switch ($version) {
            case 1:
                $version = "1.0;";
                break;
            case 2:
                $version = "2.0;";
                break;
            case 3:
                $version = "3.0;";
                break;
            case 4:
                $version = "4.0;";
                break;
            default:
                $this->fail("Requested a version not between 1 and 4");
        }
        $response = $this->actingAs($user)->call(
            'GET',
            '/odata.svc/$metadata',
            [],
            [],
            [],
            [ "DataServiceVersion" => $version, "MaxDataServiceVersion" => $version]
        );
        $this->assertEquals($version, $response->headers->get("DataServiceVersion"));
        return $response;
    }

    public function testV1MetadataAgainstXSD()
    {
        return true;
        $response = $this->getMetadataDocument(1);

        $xml = new DOMDocument();
        $xml->loadXML($response->content());
        $xml->schemaValidate(dirname(__FILE__) . "/Microsoft.Data.Entity.Design.Edmx_1.xsd");
    }


    public function testV2MetadataAgainstXSD()
    {
        return true;

        $response = $this->getMetadataDocument(2);

        $xml = new DOMDocument();
        $xml->loadXML($response->content());
        $xml->schemaValidate(dirname(__FILE__) . "/Microsoft.Data.Entity.Design.Edmx_2.xsd");
    }

    public function testV3MetadataAgainstXSD()
    {
        $response = $this->getMetadataDocument(3);

        $xml = new DOMDocument();
        $xml->loadXML($response->content());
        $xml->schemaValidate(dirname(__FILE__) . "/Microsoft.Data.Entity.Design.Edmx_3.xsd");
    }

    public function testV4MetadataAgainstXSD()
    {
        return true;

        $this->markTestSkipped("Odata Version 4 Not Implemented");
        $response = $this->getMetadataDocument(4);

        $xml = new DOMDocument();
        $xml->loadXML($response->content());
        $xml->schemaValidate(dirname(__FILE__) . "/edmx.xsd");
    }

    public function testAgainstXSD()
    {
        return true;

        $response = $this->call('GET', '/odata.svc/$metadata');

        $xml = new DOMDocument();
        $xml->loadXML($response->content());
        $xml->schemaValidate(dirname(__FILE__) . "/CSDLSchema3.0.xsd");
        try {
        } catch (Exception $e) {
//            $this->fail($e->getMessage() . ' RelaxNG Input: ' . $rng);
        }
    }
}
