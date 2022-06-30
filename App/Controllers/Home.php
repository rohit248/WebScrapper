<?php

namespace App\Controllers;

use \Core\View;

use \App\Helpers\DataHelper;
use \App\Helpers\CurlHelper;
use \App\Models\DomainReports;
use App\Config;

/**
 * Home controller
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        return View::render('home.php');
    }

    /**
     * Controller for saving URL Data
     *
     * @var $_POST['url'] url submitted by user
     * @return Redirect to Report URL
     */
    public function submitURL()
    {
        $urlToScrap = $_POST['url'];

        //Return home page with error if url is not valid
        if (!DataHelper::validateURL($urlToScrap)) {
            return View::render('home.php',['error' => ['url' => 'URL is not Valid! Please Try Again.']]);
        }


        $curlHelper = new CurlHelper($urlToScrap);

        if (!$curlHelper->fetchPage()) 
        {
            return View::render('home.php',['error' => ['url' => 'URL could not be fetched! Please Try Again.']]);
        }

        $responseData = [
            'header' => $curlHelper->get_headers_from_curl_response(),
            'info' => $curlHelper->get_curl_info(),
            'html_tag_count' => $curlHelper->get_html_tag_count()
        ];

        $reportID = DataHelper::generateReportID();
        
        $dataToSaveDB = [
            $urlToScrap,
            $reportID,
            json_encode($responseData)
        ];

        if (! DomainReports::saveData($dataToSaveDB)) 
        {
            return View::render('home.php',['error' => ['url' => 'Unable to process your request! Please Try Again.']]);
        }

        /* Redirect browser */
        header( "Location:". Config::APP_URL."/report?report_id=$reportID" );
        
    }


    /**
     * Show the report page
     *
     * @return View
     */
    public function report()
    {
        $report_id = $_GET['report_id'];

        if (empty($report_id) || strlen($report_id) != 14) 
        {   
            //Redirect To home Page if Report id is not valid
            header( "Location:". Config::APP_URL );
        }

        $report_details = DomainReports::getDataByReportID($report_id);
        
        if (!$report_details) {
            header( "Location:". Config::APP_URL );
        }

        $report_details['domain_data'] = json_decode($report_details['domain_data'], true);

        return View::render('report.php',['report_details' => $report_details]);

    }
}
