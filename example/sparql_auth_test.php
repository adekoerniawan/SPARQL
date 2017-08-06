<?php
use BorderCloud\SPARQL\Endpoint;

// git clone https://github.com/BorderCloud/SPARQL
// ./query -r -e https://example.com/sparql-auth -f ./example/queryRead1.rq -l login -p password -v

require_once ('../vendor/autoload.php');

$endpoint = "http://example.com/sparql-auth/";
$sp_ReadAndWrite = new Endpoint($endpoint, false, true);
$sp_ReadAndWrite->setEndpointQuery($endpoint);
$sp_ReadAndWrite->setEndpointUpdate($endpoint);

$sp_ReadAndWrite->setLogin("test");
$sp_ReadAndWrite->setPassword("test!");

/*
 * PREFIX dct: <http://purl.org/dc/terms/>
 * PREFIX dctype: <http://purl.org/dc/dcmitype/>
 * PREFIX foaf: <http://xmlns.com/foaf/0.1/>
 * PREFIX vcard: <http://www.w3.org/2006/vcard/ns#>
 * PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
 *
 * PREFIX dcat: <http://www.w3.org/ns/dcat#>
 * PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
 * PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
 * PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
 */

$q = <<<EOT

PREFIX theme: <http://data.sparql.pro/w/Q>
PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>

INSERT
  { GRAPH <http://sparql.pro/lodTest> {
       theme:2223
         a skos:Concept ;
         rdfs:label "Physique"@fr ;
         rdfs:label "Physics"@en .
      }
}
EOT;

$sp_ReadAndWrite->ResetErrors();
$rows = $sp_ReadAndWrite->query($q, 'raw');
$err = $sp_ReadAndWrite->getErrors();
if ($err) {
    print_r($err);
}
/*
 * foreach($rows["result"]["variables"] as $variable){
 * printf("%-20.20s",$variable);
 * echo '|';
 * }
 * echo "\n";
 *
 * foreach ($rows["result"]["rows"] as $row){
 * foreach($rows["result"]["variables"] as $variable){
 * printf("%-20.20s",$row[$variable]);
 * echo '|';
 * }
 * echo "\n";
 * }
 */
