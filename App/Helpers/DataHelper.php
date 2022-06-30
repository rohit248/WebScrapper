<?php

namespace App\Helpers;

class DataHelper
{

    /**
     * Validate URL
     *
     * @return Boolean
     */
    public static function validateURL($url)
    {
        // Remove all illegal characters from a url
        $url = filter_var($url, FILTER_SANITIZE_URL);

        // Validate url
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Generate report id of 14 Characters
     *
     * @return Integer
     */
    public static function generateReportID()
    {
        //Get Current TimeStamp
        $currentTime = time();

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
    
        for ($i = 0; $i < 4; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        
        $reportID = (string) ( (string) $currentTime . $randomString );

        return $reportID;

    }

}
