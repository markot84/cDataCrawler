<?php

/**
 * Class DataParserHelper
 */
class DataParserHelper
{

    /**
     * Parses the fetched HTML
     *
     * @param $html
     * @return array
     */
    public static function parseHtml($html)
    {
        $data = null;

        $doc = new DOMDocument();
        @$doc->loadHTML($html);

        $tableToParse = $doc->getElementById(TABLE);
        $tbodyToParse = $tableToParse->childNodes[1];

        foreach ($tbodyToParse->childNodes as $rowToParse) {
            $rowString = preg_replace('/\s+/', ' ', $rowToParse->nodeValue);
            $rowData   = explode(' ', $rowString);

            $data[] = $rowData;
        }

        return $data;
    }
}