<?php

require 'vendor/autoload.php';

$httpClient = new \GuzzleHttp\Client();
$response = $httpClient->get('https://www.saq.com/en/store');
$htmlString = (string) $response->getBody();
libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($htmlString);
$xpath = new DOMXPath($doc);

if ($response == true) {
    echo "Connected";
} else {
    echo "No Connection";
}

$addresses = $xpath->evaluate('//div[@class="off-canvas-wrapper"]//div[@class="off-canvas-content"]//div[@class="page-wrapper"]//main[@id="maincontent"]//div[@class="columns"]
                            //div[@class="column main"]//div[@data-block="store-locator"]//div[@class="storelocator-container"]//div[@class="storelocator-list-container"]
                            //div[@class="list-header"]//ul[@class="store-list"]//li[@class="store store-list-item"]//div[@class="store-list-item-container"]
                            //div[@class="store-list-item-header"]//div[@class="address-container"]//div[@class="address"]//span[@class="address-row"]
                            //span[@data-bind="text: $data.street"]');

// $names = $xpath->evaluate('//div[@class="storelocator-container"]//div[@class="storelocator-list-container"]//ul[@class="store-list"]//li[@class="store store-list-item"]//div[@class="store-list-item-container"]//div[@class="store-list-item-header"]//div[@class="name-container"]//h3[@class="name"]');
$items = $doc->getElementsByTagName('span');
    $span_list = array();

    for($i = 0; $i < $items->length; $i++) {
    $item = $items->item($i);
    $span_list[$item->getAttribute('data-bind')] = $item->nodeValue;
    }
    extract($span_list);

    echo $data-bind;
// foreach ($addresses as $address) {
//     // $addressTxt = $address->getElementByTagName('span');
//     // echo $addressTxt . "\n";

// }

// foreach ($names as $name) {
//     $nameTxt = $name->getElementById('h3');
//     $extractedNames[] = $nameTxt;
//     echo $nameTxt . "\n";
// }
?>