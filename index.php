<?php
require_once 'config.php';
require_once 'Crawler/CrawlerHelper.php';
require_once 'DataParser/DataParserHelper.php';
require_once 'DataExporter/ExcelExporter.php';

$ch = CrawlerHelper::prepareCurl(URL);
try {
    $html = CrawlerHelper::fetchHTML($ch);
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

$parsedData = DataParserHelper::parseHtml($html);

$excelExporter = new ExcelExporter();
$excelExporter->writeData($parsedData);
$excelExporter->exportData();





