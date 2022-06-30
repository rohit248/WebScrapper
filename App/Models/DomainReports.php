<?php

namespace App\Models;

use PDO;

/**
 * domain_reports table model
 *
 */
class DomainReports extends \Core\Model
{

    /**
     * Table Name
     * @var string
     */
    const TABLE_NAME = 'domain_reports';


     /**
     * PRIMARY KEY
     * @var string
     */
    const PRIMARY_KEY = 'ID';

    /**
     * Insert data to table
     *
     * @return array
     */
    public static function saveData($data)
    {
        try {
            $db = static::getDB();
            
            $sql = 'INSERT INTO '.self::TABLE_NAME.'(domain,report_id,domain_data) VALUES(?,?,?)';

            $statement = $db->prepare($sql);
            
            $statement->execute($data);

            return true;
            
        } catch (\Exception $e) 
        {
            return false;
        }
        
    }


    /**
     * Get Row data using report_id
     *
     * @return array
     */
    public static function getDataByReportID($report_id)
    {
        try {
            $db = static::getDB();
            
            $sql = 'SELECT * FROM '.self::TABLE_NAME.' WHERE report_id="'.$report_id.'";';
            
            $statement = $db->query($sql);
            
            $report = $statement->fetch();

            if (empty($report)) 
            {
                return false;
            }
            
            return $report;
            
        } catch (\Exception $e) 
        {
            return false;
        }
        
    }
}
