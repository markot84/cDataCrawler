<?php

/**
 * Class CrawlerHelper
 */
class CrawlerHelper
{

    /**
     * Returns the curl to execute
     *
     * @param string $url
     * @return false|resource
     */
    public static function prepareCurl($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        return $ch;
    }

    /**
     * Returns the curl to execute
     *
     * @param resource $ch
     * @return string
     * @throws Exception
     */
    public static function fetchHtml($ch)
    {
        if (!$html = curl_exec($ch)) {
            throw new Exception('Curl not successful');
        } else {
            return $html;
        }
    }

}