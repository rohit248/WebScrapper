<?php

namespace App\Helpers;

/**
 * CUrlHelper Class consists of methods useful for web scrapping
 *
 */
class CurlHelper
{

    public $url;
    public $response;
    public $ch;
    public $body;

    function __construct($url) {
        $this->url = $url;
    }

    /**
     * Execute a curl Request and fetch page content
     *
     * @return Boolean
     */
    public function fetchPage()
    {
        try {
            $this->ch = curl_init();
            curl_setopt($this->ch, CURLOPT_URL, $this->url);
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($this->ch, CURLOPT_HEADER, 1);
            curl_setopt($this->ch, CURLOPT_FAILONERROR, true);
            
            $this->response = curl_exec($this->ch);


            if ($this->check_response_for_error()) 
            {
                return false;
            }
            
            return true;
            
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return false;

        }
        
    }

    /**
     * Retrieve header data from curl response 
     *
     * @return Array array of header data
     */
    public function get_headers_from_curl_response()
    {
        $headers = array();

        $header_text = substr($this->response, 0, strpos($this->response, "\r\n\r\n"));

        foreach (explode("\r\n", $header_text) as $i => $line)
            if ($i === 0)
                $headers['http_code'] = $line;
            else
            {
                list ($key, $value) = explode(': ', $line);

                $headers[$key] = $value;
            }

        return $headers;
    }

    /**
     * check curl request for any errors
     *
     * @return Boolean
     */
    private function check_response_for_error()
    {
        if (curl_errno($this->ch)) {
            $error_msg = curl_error($this->ch);
            error_log('Curl Error '. $e->getMessage());
            return true;
        }
        return false;
    }


    /**
     * get meta information related to curl request
     *
     * @return Mix
     */
    public function get_curl_info()
    {
        return curl_getinfo($this->ch);
    }


    /**
     * get html tag count from response html
     *
     * @return Boolean
     */
    public function get_html_tag_count()
    {
        $header_size = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
            
        $body = substr($this->response, $header_size);
        preg_match_all('/<[^\/>]+>/', $body, $matches);
        return count($matches[0]);
    }
}
