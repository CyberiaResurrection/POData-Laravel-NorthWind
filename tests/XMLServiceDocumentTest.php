<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class XMLServiceDocumentTest extends TestCase
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
    public function GetServiceDocument($version){
        switch($version){
            case 1:
                $version = "1.0";
                break;
            case 2:
                $version = "2.0";
                break;
            case 3:
                $version = "3.0";
                break;
            case 4:
                $version = "4.0";
                $this->markTestSkipped("Odata Version 4 not implomented yet");
                break;
            default:
                $this->fail("Requested a version not between 1 and 4");
        }
        $response = $this->call('GET', '/odata.svc',[],[],[],[ "DataServiceVersion" => $version, "MaxDataServiceVersion" => $version]);
        $this->assertEquals($version,$response->headers->get("DataServiceVersion"));
        return $response;
    }


    /**
     * @dataProvider RngRulesProvider
     */
    public function testXMLRulesRNG($rule,$odataVerision)
    {
        $response = $this->call('GET', '/odata.svc');
        $xml = new DOMDocument();
        $xml->loadXML($response->content());

        try{
            $this->assertTrue($xml->relaxNGValidateSource(base64_decode($rule)));
        }catch (Exception $e) {
            $this->fail($e->getMessage() . 'RelaxNG Input: ' . base64_decode($rule));
        }

    }

    public function RngRulesProvider()
    {
        return [
            'The root URL of a data service that implements the AtomPub protocol SHOULD identify the service document. [2.2.6.2.7]'  => ["PGdyYW1tYXIgeG1sbnM9Imh0dHA6Ly9yZWxheG5nLm9yZy9ucy9zdHJ1Y3R1cmUvMS4wIiB4bWxuczphcHA9Imh0dHA6Ly93d3cudzMub3JnLzIwMDcvYXBwIj4NCiAgICAgICAgPHN0YXJ0Pg0KICAgICAgICAgIDxlbGVtZW50IG5hbWU9ImFwcDpzZXJ2aWNlIj4NCiAgICAgICAgICAgIDwhLS0gT25seSBjaGVjayB0aGUgcm9vdCBsZXZlbCBvZiB0aGUgc2VydmljZSBkb2N1bWVudC4gUmVzdCBvZiB0aGVtIGNhbiBiZSBpZ25vcmVkLiAtLT4NCiAgICAgICAgICAgIDxyZWYgbmFtZT0iYW55QXR0cmlidXRlcyIgLz4NCiAgICAgICAgICAgIDxyZWYgbmFtZT0iYW55Q29udGVudCIgLz4NCiAgICAgICAgICA8L2VsZW1lbnQ+DQogICAgICAgIDwvc3RhcnQ+DQogICAgICAgIDxkZWZpbmUgbmFtZT0iYW55RWxlbWVudCI+DQogICAgICAgICAgPGVsZW1lbnQ+DQogICAgICAgICAgICA8YW55TmFtZSAvPg0KICAgICAgICAgICAgPHplcm9Pck1vcmU+DQogICAgICAgICAgICAgIDxjaG9pY2U+DQogICAgICAgICAgICAgICAgPGF0dHJpYnV0ZT4NCiAgICAgICAgICAgICAgICAgIDxhbnlOYW1lIC8+DQogICAgICAgICAgICAgICAgPC9hdHRyaWJ1dGU+DQogICAgICAgICAgICAgICAgPHRleHQgLz4NCiAgICAgICAgICAgICAgICA8cmVmIG5hbWU9ImFueUVsZW1lbnQiIC8+DQogICAgICAgICAgICAgIDwvY2hvaWNlPg0KICAgICAgICAgICAgPC96ZXJvT3JNb3JlPg0KICAgICAgICAgIDwvZWxlbWVudD4NCiAgICAgICAgPC9kZWZpbmU+DQogICAgICAgIDxkZWZpbmUgbmFtZT0iYW55QXR0cmlidXRlcyI+DQogICAgICAgICAgPHplcm9Pck1vcmU+DQogICAgICAgICAgICA8Y2hvaWNlPg0KICAgICAgICAgICAgICA8YXR0cmlidXRlPg0KICAgICAgICAgICAgICAgIDxhbnlOYW1lIC8+DQogICAgICAgICAgICAgIDwvYXR0cmlidXRlPg0KICAgICAgICAgICAgPC9jaG9pY2U+DQogICAgICAgICAgPC96ZXJvT3JNb3JlPg0KICAgICAgICA8L2RlZmluZT4NCiAgICAgICAgPGRlZmluZSBuYW1lPSJhbnlDb250ZW50Ij4NCiAgICAgICAgICA8emVyb09yTW9yZT4NCiAgICAgICAgICAgIDxjaG9pY2U+DQogICAgICAgICAgICAgIDxhdHRyaWJ1dGU+DQogICAgICAgICAgICAgICAgPGFueU5hbWUgLz4NCiAgICAgICAgICAgICAgPC9hdHRyaWJ1dGU+DQogICAgICAgICAgICAgIDx0ZXh0IC8+DQogICAgICAgICAgICAgIDxyZWYgbmFtZT0iYW55RWxlbWVudCIgLz4NCiAgICAgICAgICAgIDwvY2hvaWNlPg0KICAgICAgICAgIDwvemVyb09yTW9yZT4NCiAgICAgICAgPC9kZWZpbmU+DQogICAgICA8L2dyYW1tYXI+", [1,2,3,4]],
            'A data service SHOULD represent all available collections in a single <app:workspace> element. [2.2.6.2.7]' => ["PGdyYW1tYXIgeG1sbnM9Imh0dHA6Ly9yZWxheG5nLm9yZy9ucy9zdHJ1Y3R1cmUvMS4wIiB4bWxuczphdG9tPSJodHRwOi8vd3d3LnczLm9yZy8yMDA1L0F0b20iIHhtbG5zOmFwcD0iaHR0cDovL3d3dy53My5vcmcvMjAwNy9hcHAiPg0KICAgICAgICA8c3RhcnQ+DQogICAgICAgICAgPGVsZW1lbnQ+DQogICAgICAgICAgICA8IS0tIHNlcnZpY2UgbGV2ZWwgZWxlbWVudCBjYW4gYmUgaWdub3JlZCBzaW5jZSB0aGUgd29ya3NwYWNlIGVsZW1lbnQgaXMgdGhlIGZvY3VzIGhlcmUuIC0tPg0KICAgICAgICAgICAgPGFueU5hbWUgLz4NCiAgICAgICAgICAgIDxyZWYgbmFtZT0iYW55QXR0cmlidXRlcyIgLz4NCiAgICAgICAgICAgIDxlbGVtZW50IG5hbWU9ImFwcDp3b3Jrc3BhY2UiPg0KICAgICAgICAgICAgICA8ZWxlbWVudCBuYW1lPSJhdG9tOnRpdGxlIj4NCiAgICAgICAgICAgICAgICA8cmVmIG5hbWU9ImFueUF0dHJpYnV0ZXMiIC8+DQogICAgICAgICAgICAgICAgPHRleHQvPg0KICAgICAgICAgICAgICA8L2VsZW1lbnQ+DQogICAgICAgICAgICAgIDx6ZXJvT3JNb3JlPg0KICAgICAgICAgICAgICAgIDxlbGVtZW50IG5hbWU9ImFwcDpjb2xsZWN0aW9uIj4NCiAgICAgICAgICAgICAgICAgIDxhdHRyaWJ1dGUgbmFtZT0iaHJlZiI+DQogICAgICAgICAgICAgICAgICAgIDx0ZXh0IC8+DQogICAgICAgICAgICAgICAgICA8L2F0dHJpYnV0ZT4NCiAgICAgICAgICAgICAgICAgIDxlbGVtZW50IG5hbWU9ImF0b206dGl0bGUiPg0KICAgICAgICAgICAgICAgICAgICA8cmVmIG5hbWU9ImFueUF0dHJpYnV0ZXMiIC8+DQogICAgICAgICAgICAgICAgICAgIDx0ZXh0Lz4NCiAgICAgICAgICAgICAgICAgIDwvZWxlbWVudD4NCiAgICAgICAgICAgICAgICAgIDx6ZXJvT3JNb3JlPg0KICAgICAgICAgICAgICAgICAgICA8cmVmIG5hbWU9ImFueUVsZW1lbnRfb3RoZXJfdGhhbl9hdG9tX3RpdGxlIiAvPg0KICAgICAgICAgICAgICAgICAgPC96ZXJvT3JNb3JlPg0KICAgICAgICAgICAgICAgIDwvZWxlbWVudD4NCiAgICAgICAgICAgICAgPC96ZXJvT3JNb3JlPg0KICAgICAgICAgICAgPC9lbGVtZW50Pg0KICAgICAgICAgIDwvZWxlbWVudD4NCiAgICAgICAgPC9zdGFydD4NCiAgICAgICAgPGRlZmluZSBuYW1lPSJhbnlBdHRyaWJ1dGVzIj4NCiAgICAgICAgICA8emVyb09yTW9yZT4NCiAgICAgICAgICAgIDxjaG9pY2U+DQogICAgICAgICAgICAgIDxhdHRyaWJ1dGU+DQogICAgICAgICAgICAgICAgPGFueU5hbWUgLz4NCiAgICAgICAgICAgICAgPC9hdHRyaWJ1dGU+DQogICAgICAgICAgICA8L2Nob2ljZT4NCiAgICAgICAgICA8L3plcm9Pck1vcmU+DQogICAgICAgIDwvZGVmaW5lPg0KICAgICAgICA8ZGVmaW5lIG5hbWU9ImFueUVsZW1lbnQiPg0KICAgICAgICAgIDxlbGVtZW50Pg0KICAgICAgICAgICAgPGFueU5hbWUgLz4NCiAgICAgICAgICAgIDx6ZXJvT3JNb3JlPg0KICAgICAgICAgICAgICA8Y2hvaWNlPg0KICAgICAgICAgICAgICAgIDxhdHRyaWJ1dGU+DQogICAgICAgICAgICAgICAgICA8YW55TmFtZSAvPg0KICAgICAgICAgICAgICAgIDwvYXR0cmlidXRlPg0KICAgICAgICAgICAgICAgIDx0ZXh0IC8+DQogICAgICAgICAgICAgICAgPHJlZiBuYW1lPSJhbnlFbGVtZW50IiAvPg0KICAgICAgICAgICAgICA8L2Nob2ljZT4NCiAgICAgICAgICAgIDwvemVyb09yTW9yZT4NCiAgICAgICAgICA8L2VsZW1lbnQ+DQogICAgICAgIDwvZGVmaW5lPg0KICAgICAgICA8ZGVmaW5lIG5hbWU9ImFueUNvbnRlbnQiPg0KICAgICAgICAgIDx6ZXJvT3JNb3JlPg0KICAgICAgICAgICAgPGNob2ljZT4NCiAgICAgICAgICAgICAgPGF0dHJpYnV0ZT4NCiAgICAgICAgICAgICAgICA8YW55TmFtZSAvPg0KICAgICAgICAgICAgICA8L2F0dHJpYnV0ZT4NCiAgICAgICAgICAgICAgPHRleHQgLz4NCiAgICAgICAgICAgICAgPHJlZiBuYW1lPSJhbnlFbGVtZW50IiAvPg0KICAgICAgICAgICAgPC9jaG9pY2U+DQogICAgICAgICAgPC96ZXJvT3JNb3JlPg0KICAgICAgICA8L2RlZmluZT4NCiAgICAgICAgPGRlZmluZSBuYW1lPSJhbnlFbGVtZW50X290aGVyX3RoYW5fYXRvbV90aXRsZSI+DQogICAgICAgICAgPGVsZW1lbnQ+DQogICAgICAgICAgICA8Y2hvaWNlPg0KICAgICAgICAgICAgICA8YW55TmFtZT4NCiAgICAgICAgICAgICAgICA8ZXhjZXB0Pg0KICAgICAgICAgICAgICAgICAgPG5zTmFtZSBucz0iaHR0cDovL3d3dy53My5vcmcvMjAwNS9BdG9tIiAvPg0KICAgICAgICAgICAgICAgIDwvZXhjZXB0Pg0KICAgICAgICAgICAgICA8L2FueU5hbWU+DQogICAgICAgICAgICAgIDxuc05hbWUgbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDUvQXRvbSI+DQogICAgICAgICAgICAgICAgPGV4Y2VwdD4NCiAgICAgICAgICAgICAgICAgIDxuYW1lPmF0b206dGl0bGU8L25hbWU+DQogICAgICAgICAgICAgICAgPC9leGNlcHQ+DQogICAgICAgICAgICAgIDwvbnNOYW1lPg0KICAgICAgICAgICAgPC9jaG9pY2U+DQogICAgICAgICAgICA8cmVmIG5hbWU9ImFueUNvbnRlbnQiIC8+DQogICAgICAgICAgPC9lbGVtZW50Pg0KICAgICAgICA8L2RlZmluZT4NCiAgICAgIDwvZ3JhbW1hcj4=",[1,2,3,4]],
            'The URI identifying the EntitySet MUST be used as the value of the href attribute of the <app:collection> element. [2.2.6.2.7]' => ["PGdyYW1tYXIgeG1sbnM9Imh0dHA6Ly9yZWxheG5nLm9yZy9ucy9zdHJ1Y3R1cmUvMS4wIiB4bWxuczphcHA9Imh0dHA6Ly93d3cudzMub3JnLzIwMDcvYXBwIj4NCiAgICAgICAgPHN0YXJ0Pg0KICAgICAgICAgIDxlbGVtZW50Pg0KICAgICAgICAgICAgPCEtLSBJZ25vcmUgdGhlIHNlcnZpY2UgbGV2ZWwgZWxlbWVudCAtLT4NCiAgICAgICAgICAgIDxhbnlOYW1lIC8+DQogICAgICAgICAgICA8cmVmIG5hbWU9ImFueUF0dHJpYnV0ZXMiIC8+DQogICAgICAgICAgICA8ZWxlbWVudD4NCiAgICAgICAgICAgICAgPCEtLSBJZ25vcmUgdGhlIHdvcmtzcGFjZSBsZXZlbCBlbGVtZW50IC0tPg0KICAgICAgICAgICAgICA8YW55TmFtZSAvPg0KICAgICAgICAgICAgICA8ZWxlbWVudD4NCiAgICAgICAgICAgICAgICA8IS0tIElnbm9yZSB0aGUgdGl0bGUgZWxlbWVudCBmb3IgZGVmYXVsdCAtLT4NCiAgICAgICAgICAgICAgICA8YW55TmFtZSAvPg0KICAgICAgICAgICAgICAgIDxyZWYgbmFtZT0iYW55QXR0cmlidXRlcyIgLz4NCiAgICAgICAgICAgICAgICA8dGV4dCAvPg0KICAgICAgICAgICAgICA8L2VsZW1lbnQ+DQogICAgICAgICAgICAgIDx6ZXJvT3JNb3JlPg0KICAgICAgICAgICAgICAgIDxlbGVtZW50IG5hbWU9ImFwcDpjb2xsZWN0aW9uIj4NCiAgICAgICAgICAgICAgICAgIDxhdHRyaWJ1dGUgbmFtZT0iaHJlZiI+DQogICAgICAgICAgICAgICAgICA8L2F0dHJpYnV0ZT4NCiAgICAgICAgICAgICAgICAgIDxlbGVtZW50Pg0KICAgICAgICAgICAgICAgICAgICA8IS0tIElnbm9yZSB0aGUgdGl0bGUgZWxlbWVudCAtLT4NCiAgICAgICAgICAgICAgICAgICAgPGFueU5hbWUgLz4NCiAgICAgICAgICAgICAgICAgICAgPHJlZiBuYW1lPSJhbnlBdHRyaWJ1dGVzIiAvPg0KICAgICAgICAgICAgICAgICAgICA8dGV4dC8+DQogICAgICAgICAgICAgICAgICA8L2VsZW1lbnQ+DQogICAgICAgICAgICAgICAgPC9lbGVtZW50Pg0KICAgICAgICAgICAgICA8L3plcm9Pck1vcmU+DQogICAgICAgICAgICA8L2VsZW1lbnQ+DQogICAgICAgICAgPC9lbGVtZW50Pg0KICAgICAgICA8L3N0YXJ0Pg0KICAgICAgICA8ZGVmaW5lIG5hbWU9ImFueUVsZW1lbnQiPg0KICAgICAgICAgIDxlbGVtZW50Pg0KICAgICAgICAgICAgPGFueU5hbWUgLz4NCiAgICAgICAgICAgIDx6ZXJvT3JNb3JlPg0KICAgICAgICAgICAgICA8Y2hvaWNlPg0KICAgICAgICAgICAgICAgIDxhdHRyaWJ1dGU+DQogICAgICAgICAgICAgICAgICA8YW55TmFtZSAvPg0KICAgICAgICAgICAgICAgIDwvYXR0cmlidXRlPg0KICAgICAgICAgICAgICAgIDx0ZXh0IC8+DQogICAgICAgICAgICAgICAgPHJlZiBuYW1lPSJhbnlFbGVtZW50IiAvPg0KICAgICAgICAgICAgICA8L2Nob2ljZT4NCiAgICAgICAgICAgIDwvemVyb09yTW9yZT4NCiAgICAgICAgICA8L2VsZW1lbnQ+DQogICAgICAgIDwvZGVmaW5lPg0KICAgICAgICA8ZGVmaW5lIG5hbWU9ImFueUF0dHJpYnV0ZXMiPg0KICAgICAgICAgIDx6ZXJvT3JNb3JlPg0KICAgICAgICAgICAgPGNob2ljZT4NCiAgICAgICAgICAgICAgPGF0dHJpYnV0ZT4NCiAgICAgICAgICAgICAgICA8YW55TmFtZSAvPg0KICAgICAgICAgICAgICA8L2F0dHJpYnV0ZT4NCiAgICAgICAgICAgIDwvY2hvaWNlPg0KICAgICAgICAgIDwvemVyb09yTW9yZT4NCiAgICAgICAgPC9kZWZpbmU+DQogICAgICAgIDxkZWZpbmUgbmFtZT0iYW55Q29udGVudCI+DQogICAgICAgICAgPHplcm9Pck1vcmU+DQogICAgICAgICAgICA8Y2hvaWNlPg0KICAgICAgICAgICAgICA8YXR0cmlidXRlPg0KICAgICAgICAgICAgICAgIDxhbnlOYW1lIC8+DQogICAgICAgICAgICAgIDwvYXR0cmlidXRlPg0KICAgICAgICAgICAgICA8dGV4dCAvPg0KICAgICAgICAgICAgICA8cmVmIG5hbWU9ImFueUVsZW1lbnQiIC8+DQogICAgICAgICAgICA8L2Nob2ljZT4NCiAgICAgICAgICA8L3plcm9Pck1vcmU+DQogICAgICAgIDwvZGVmaW5lPg0KICAgICAgPC9ncmFtbWFyPg==",[1,2,3,4]],
        ];
    }

    /**
     * @dataProvider XSLTRngRulesProvider
     */
    public function testXMLRulesXSLTRNG($rule,$odataVerision)
    {
        $response = $this->call('GET', '/odata.svc');

        $xml = new DOMDocument();
        $xml->loadXML($response->content());

        # START XSLT
        $xslt = new XSLTProcessor();

        $xsl = new DOMDocument();
        $xsl->loadXML( base64_decode($rule));
        $xslt->importStylesheet( $xsl );
        $rng = $xslt->transformToXML( $xsl );
        try{
            $this->assertTrue($xml->relaxNGValidateSource($rng));
        }catch (Exception $e) {
            $this->fail($e->getMessage() . 'RelaxNG Input: ' . $rng);
        }
    }

    public function XSLTRngRulesProvider()
    {
        return [
            'A data service MUST represent each EntitySet in its associated Entity Data Model as an <app:collection> element. [2.2.6.2.7]' => ["PHhzbDpzdHlsZXNoZWV0IHZlcnNpb249IjEuMCIgeG1sbnM6eHNsPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L1hTTC9UcmFuc2Zvcm0iPg0KICAgICAgICA8eHNsOm91dHB1dCBtZXRob2Q9InhtbCIgb21pdC14bWwtZGVjbGFyYXRpb249Im5vIiBpbmRlbnQ9InllcyIvPg0KICAgICAgICA8eHNsOnRlbXBsYXRlIG1hdGNoPSIvIj4NCiAgICAgICAgICA8Z3JhbW1hciB4bWxucz0iaHR0cDovL3JlbGF4bmcub3JnL25zL3N0cnVjdHVyZS8xLjAiIHhtbG5zOmF0b209Imh0dHA6Ly93d3cudzMub3JnLzIwMDUvQXRvbSIgeG1sbnM6YXBwPSJodHRwOi8vd3d3LnczLm9yZy8yMDA3L2FwcCI+DQogICAgICAgICAgICA8c3RhcnQ+DQogICAgICAgICAgICAgIDxlbGVtZW50Pg0KICAgICAgICAgICAgICAgIDwhLS0gSWdub3JlIHRoZSBzZXJ2aWNlIGxldmVsIGVsZW1lbnQgLS0+DQogICAgICAgICAgICAgICAgPGFueU5hbWUgLz4NCiAgICAgICAgICAgICAgICA8cmVmIG5hbWU9ImFueUF0dHJpYnV0ZXMiIC8+DQogICAgICAgICAgICAgICAgPGVsZW1lbnQ+DQogICAgICAgICAgICAgICAgICA8IS0tIElnbm9yZSB0aGUgd29ya3NwYWNlIGxldmVsIGVsZW1lbnQgLS0+DQogICAgICAgICAgICAgICAgICA8YW55TmFtZSAvPg0KICAgICAgICAgICAgICAgICAgPGVsZW1lbnQ+DQogICAgICAgICAgICAgICAgICAgIDwhLS0gSWdub3JlIHRoZSB0aXRsZSBlbGVtZW50IGZvciBkZWZhdWx0IC0tPg0KICAgICAgICAgICAgICAgICAgICA8YW55TmFtZSAvPg0KICAgICAgICAgICAgICAgICAgICA8cmVmIG5hbWU9ImFueUF0dHJpYnV0ZXMiIC8+DQogICAgICAgICAgICAgICAgICAgIDx0ZXh0IC8+DQogICAgICAgICAgICAgICAgICA8L2VsZW1lbnQ+DQogICAgICAgICAgICAgICAgICA8Z3JvdXA+DQogICAgICAgICAgICAgICAgICAgIDwhLS0gQXBwbHkgWFNMVCB0byBnZXQgYWxsIEVudGl0eVNldCBmcm9tIE1ldGFkYXRhIGFuZCByZXByZXNlbnQgdGhlbSBhcyBjb2xsZWN0aW9ucyAtLT4NCiAgICAgICAgICAgICAgICAgICAgPHhzbDphcHBseS10ZW1wbGF0ZXMgc2VsZWN0PSIqW2xvY2FsLW5hbWUoKT0nRWRteCddLypbbG9jYWwtbmFtZSgpPSdEYXRhU2VydmljZXMnXS8qW2xvY2FsLW5hbWUoKT0nU2NoZW1hJ10vKltsb2NhbC1uYW1lKCk9J0VudGl0eUNvbnRhaW5lciddIi8+DQogICAgICAgICAgICAgICAgICA8L2dyb3VwPg0KICAgICAgICAgICAgICAgIDwvZWxlbWVudD4NCiAgICAgICAgICAgICAgPC9lbGVtZW50Pg0KICAgICAgICAgICAgPC9zdGFydD4NCiAgICAgICAgICAgIDxkZWZpbmUgbmFtZT0iYW55QXR0cmlidXRlcyI+DQogICAgICAgICAgICAgIDx6ZXJvT3JNb3JlPg0KICAgICAgICAgICAgICAgIDxjaG9pY2U+DQogICAgICAgICAgICAgICAgICA8YXR0cmlidXRlPg0KICAgICAgICAgICAgICAgICAgICA8YW55TmFtZSAvPg0KICAgICAgICAgICAgICAgICAgPC9hdHRyaWJ1dGU+DQogICAgICAgICAgICAgICAgPC9jaG9pY2U+DQogICAgICAgICAgICAgIDwvemVyb09yTW9yZT4NCiAgICAgICAgICAgIDwvZGVmaW5lPg0KICAgICAgICAgIDwvZ3JhbW1hcj4NCiAgICAgICAgPC94c2w6dGVtcGxhdGU+DQogICAgICAgIDx4c2w6dGVtcGxhdGUgbWF0Y2g9IipbbG9jYWwtbmFtZSgpPSdFZG14J10vKltsb2NhbC1uYW1lKCk9J0RhdGFTZXJ2aWNlcyddLypbbG9jYWwtbmFtZSgpPSdTY2hlbWEnXS8qW2xvY2FsLW5hbWUoKT0nRW50aXR5Q29udGFpbmVyJ10iIHhtbG5zPSJodHRwOi8vcmVsYXhuZy5vcmcvbnMvc3RydWN0dXJlLzEuMCI+DQogICAgICAgICAgPHhzbDpmb3ItZWFjaCBzZWxlY3Q9IipbbG9jYWwtbmFtZSgpPSdFbnRpdHlTZXQnXSI+DQogICAgICAgICAgICA8ZWxlbWVudCBuYW1lPSJhcHA6Y29sbGVjdGlvbiI+DQogICAgICAgICAgICAgIDxhdHRyaWJ1dGUgbmFtZT0iaHJlZiI+DQogICAgICAgICAgICAgICAgPHRleHQgLz4NCiAgICAgICAgICAgICAgPC9hdHRyaWJ1dGU+DQogICAgICAgICAgICAgIDxlbGVtZW50IG5hbWU9ImF0b206dGl0bGUiPg0KICAgICAgICAgICAgICAgIDxyZWYgbmFtZT0iYW55QXR0cmlidXRlcyIgLz4NCiAgICAgICAgICAgICAgICA8dGV4dC8+DQogICAgICAgICAgICAgIDwvZWxlbWVudD4NCiAgICAgICAgICAgIDwvZWxlbWVudD4NCiAgICAgICAgICA8L3hzbDpmb3ItZWFjaD4NCiAgICAgICAgPC94c2w6dGVtcGxhdGU+DQogICAgICA8L3hzbDpzdHlsZXNoZWV0Pg==",[1,2,3,4]],
        ];
    }


    /**
     * @dataProvider RegExHeaderRulesProvider
     */
    public function testHeaders($field,$Regex,$searchString,$odataVerision)
    {

        $response = $this->call('GET', '/odata.svc');
        $fieldValue = $response->headers->get($field);
        if(null != $searchString){
            $this->assertTrue(str_contains($fieldValue,$searchString),"could not locate search string: " . $searchString . " within Field: ". $field);
        }
        $this->assertEquals(1,preg_match($Regex,$fieldValue),"Field: " . $field .' had value: ' . $fieldValue . " which is not matched by regex: " . $Regex);
    }

    public function RegExHeaderRulesProvider()
    {
        return [
            'AtomPub Service Documents MUST be identified with the \'application/atomsvc+xml\' Content Type. [2.2.3.7.1]' => ["Content-Type", "/.*application\/atomsvc\+xml.*/", "application/atomsvc+xml" ,[1,2,3,4]]
        ];
    }
}
