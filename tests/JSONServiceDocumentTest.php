<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;
use JsonSchema\Constraints\Factory;
use JsonSchema\Constraints\Constraint;

class JSONServiceDocumentTest extends TestCase
{
    /**
     * @dataProvider JsonSchemaRulesProvider
     */
    public function testJsonRules($rule,$jsonType)
    {
        $rule= base64_decode($rule);
        $response = $this->call('GET', '/odata.svc',[],[],[],["HTTP_ACCEPT" => "application/json;odata=verbose", "MaxDataServiceVersion" => "3.0"]);
        $content = $response->content();
        $validator = new JsonSchema\Validator;

        $validator->validate($content, $rule);
        $this->assertNotNull(json_decode ($content), "The Content Returned Was Not Valid Json");

        $message = "JSON does not validate. Violations:\n";
        if(!$validator->isValid()){
            $message .= sprintf("[%s] %s\n", $error['property'], $error['message']);
        }
        $this->assertTrue($validator->isValid(),$message . "\n ValidationData: " . $rule);
    }

    public function JsonSchemaRulesProvider()
    {
        return [
            'A data service SHOULD represent all available collections in a single EntitySet array. [2.2.6.3.12]'  => ["ew0KICAgICAgICAidHlwZSI6ICJvYmplY3QiLA0KICAgICAgICAicHJvcGVydGllcyIgOiB7DQogICAgICAgICJkIjogew0KICAgICAgICAiYWRkaXRpb25hbFByb3BlcnRpZXMiIDogZmFsc2UsDQogICAgICAgICJ0eXBlIjogIm9iamVjdCIsDQogICAgICAgICJwcm9wZXJ0aWVzIiA6IHsNCiAgICAgICAgIkVudGl0eVNldHMiIDogew0KICAgICAgICAidHlwZSI6ICJhcnJheSINCiAgICAgICAgfQ0KICAgICAgICB9DQogICAgICAgIH0NCiAgICAgICAgfQ0KICAgICAgICB9", 'json'],
            'A service document in JSON must have at least two properties: odata.metadata and value in V3. [V4 5]' => ["ew0KICAgICAgICAiYWRkaXRpb25hbFByb3BlcnRpZXMiIDogdHJ1ZSwNCiAgICAgICAgInR5cGUiOiAib2JqZWN0IiwNCiAgICAgICAgInByb3BlcnRpZXMiIDogew0KICAgICAgICAib2RhdGEubWV0YWRhdGEiIDogew0KICAgICAgICAicmVxdWlyZWQiOnRydWUNCiAgICAgICAgfSwNCiAgICAgICAgInZhbHVlIiA6ew0KICAgICAgICAicmVxdWlyZWQiOnRydWV9DQogICAgICAgIH0NCiAgICAgICAgfQ==",'JsonLight'],
            'A service document in JSON is represented as a single JSON object. [V4 5]' => ["ICAgICAgICB7DQogICAgICAgICJhZGRpdGlvbmFsUHJvcGVydGllcyIgOiB0cnVlLA0KICAgICAgICAidHlwZSI6ICJvYmplY3QiLA0KICAgICAgICAicHJvcGVydGllcyIgOiB7DQogICAgICAgIH0NCiAgICAgICAgfQ==" ,'JsonLight'],
            'The value of the value property MUST be a JSON Array. [V4 5]' => ["ew0KICAgICAgICAidHlwZSIgOiAib2JqZWN0IiwNCiAgICAgICAgImFkZGl0aW9uYWxQcm9wZXJ0aWVzIiA6IHRydWUsDQogICAgICAgICJwcm9wZXJ0aWVzIiA6IHsNCiAgICAgICAgInZhbHVlIiA6IHsNCiAgICAgICAgInR5cGUiIDogImFycmF5IiwNCiAgICAgICAgImFkZGl0aW9uYWxQcm9wZXJ0aWVzIiA6IHRydWUsDQogICAgICAgICJyZXF1aXJlZCIgOiB0cnVlDQogICAgICAgIH0NCiAgICAgICAgfQ0KICAgICAgICB9", 'JsonLight'],
            'Each element in the value array MUST be a Json object. [V4 5]' => ["ICAgICAgICB7DQogICAgICAgICJ0eXBlIiA6ICJvYmplY3QiLA0KICAgICAgICAiYWRkaXRpb25hbFByb3BlcnRpZXMiIDogdHJ1ZSwNCiAgICAgICAgInByb3BlcnRpZXMiIDogew0KICAgICAgICAidmFsdWUiIDogew0KICAgICAgICAidHlwZSIgOiAiYXJyYXkiLA0KICAgICAgICAiaXRlbXMiIDogew0KICAgICAgICAidHlwZSIgOiAib2JqZWN0Ig0KICAgICAgICB9DQogICAgICAgIH0NCiAgICAgICAgfQ0KICAgICAgICB9", 'JsonLight'],
            'Each element in the value array MUST be a JSON object with at least two name/value pairs, "name" and "url". [V4 5]' => ["ew0KICAgICAgICAidHlwZSI6ICJvYmplY3QiLA0KICAgICAgICAiYWRkaXRpb25hbFByb3BlcnRpZXMiIDogdHJ1ZSwNCiAgICAgICAgInByb3BlcnRpZXMiIDogew0KICAgICAgICAidmFsdWUiIDogew0KICAgICAgICAiYWRkaXRpb25hbFByb3BlcnRpZXMiIDogdHJ1ZSwNCiAgICAgICAgInR5cGUiIDogImFycmF5IiwNCiAgICAgICAgInJlcXVpcmVkIiA6IHRydWUsDQogICAgICAgICJpdGVtcyIgOiB7DQogICAgICAgICJ0eXBlIiA6ICJvYmplY3QiLA0KICAgICAgICAicHJvcGVydGllcyIgOiB7DQogICAgICAgICJuYW1lIiA6IHsgInJlcXVpcmVkIiA6IHRydWV9LA0KICAgICAgICAidXJsIiA6IHsgInJlcXVpcmVkIiA6IHRydWV9DQogICAgICAgIH0NCiAgICAgICAgfQ0KICAgICAgICB9DQogICAgICAgIH0NCiAgICAgICAgfQ==", 'JsonLight'],
            'Each element in the value array MAY contain a name/value pair with name title.' => ["ew0KICAgICAgICAidHlwZSI6ICJvYmplY3QiLA0KICAgICAgICAiYWRkaXRpb25hbFByb3BlcnRpZXMiIDogdHJ1ZSwNCiAgICAgICAgInByb3BlcnRpZXMiIDogew0KICAgICAgICAidmFsdWUiIDogew0KICAgICAgICAiYWRkaXRpb25hbFByb3BlcnRpZXMiIDogdHJ1ZSwNCiAgICAgICAgInR5cGUiIDogImFycmF5IiwNCiAgICAgICAgInJlcXVpcmVkIiA6IHRydWUsDQogICAgICAgICJpdGVtcyIgOiB7DQogICAgICAgICJ0eXBlIiA6ICJvYmplY3QiLA0KICAgICAgICAicHJvcGVydGllcyIgOiB7DQogICAgICAgICJ0aXRsZSIgOiB7ICJyZXF1aXJlZCIgOiB0cnVlfQ0KICAgICAgICB9DQogICAgICAgIH0NCiAgICAgICAgfQ0KICAgICAgICB9DQogICAgICAgIH0=",'JsonLight'],
        ];
    }


//    /**
//     * @dataProvider XSLTRngRulesProvider
//     */
/*    public function testXMLRulesXSLTRNG($rule)
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

    public function XSLTJSONRulesProvider()
    {
        return [
            'A data service MUST represent each EntitySet in its associated Entity Data Model as an <app:collection> element. [2.2.6.2.7]' => ["PHhzbDpzdHlsZX$
        ];
    }*/


    /**
     * @dataProvider RegExHeaderRulesProvider
     */
    public function testHeaders($field,$Regex,$searchString)
    {

        $response = $this->call('GET', '/odata.svc');
        $fieldValue = $response->headers->get($field);
        if(null != $searchString){
            $this->assertTrue(str_contains($fieldValue,$searchString),"could not locate search string: " . $searchString . " within Field: ". $field . " FieldValue: " . $fieldValue);
        }
        $this->assertEquals(1,preg_match($Regex,$fieldValue),"Field: " . $field .' had value: ' . $fieldValue . " which is not matched by regex: " . $Regex);
    }

    public function RegExHeaderRulesProvider()
    {
        return [
            'JSON Service Documents MUST be identified using the "application/json" media type. [2.2.3.7.1]' => ["Content-Type", "/.*application\/json.*/", "application/json" ]
        ];
    }
}
