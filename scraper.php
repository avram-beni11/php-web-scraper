<?php

require 'vendor/autoload.php';

$httpClient = new \GuzzleHttp\Client();
$response = $httpClient->get('https://www.bordeaux-negoce.com/bordeaux-negoce/nos-membres/');
$htmlString = (string) $response->getBody();
libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($htmlString);
$xpath = new DOMXPath($doc);

$elements = $xpath->evaluate('//div[@class="container"]//div[@class="row"]//div[@class="col-lg-8 col-md-8 col-sm-12 col-xs-12"]//div[@class="list-membres"]//div[@class="membre-contact"]//div[@class="membre-info"]//div[@class="links-contact"]//a[@title="Envoyer un email"]');
$writeFile = fopen("emails.txt", "w");
foreach ($elements as $element) {
    $elementAttr = $element->getAttribute('href');
    $trimmed = str_replace("mailto:", "", $elementAttr);
    fwrite($writeFile, $trimmed . "\n");
    echo $elementAttr . "\n";
}
?>