<?php

require dirname(dirname(__DIR__)) . '/App/Config.php';

use App\Config;


/**
 * Migration for data_reports table
 * table will be used to save reports of domain data scrapped 
 */
class DomainReportsTable{

    /**
     * Initiate Migration
     */
    public function initiateMigration()
    {
        echo "Initiating Migration.....!!!\n";
        $this->tableName = 'domain_reports';
        $this->db = null;
        $this->getDBConnection();
        $this->createTable();
        echo "Migration Completed.....!!!\n";
        
    }

    /**
     * Create A DB connection using PDO 
     */
    public function getDBConnection()
    {
        $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
        $this->db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "DB Connection Successfull....!!!\n";
    }

    /**
     * Create Table data_reports 
     * @param int ID - Primary key of table with auto increment 
     * @param string domain - URL for data scrapping
     * @param int report_id - A unique id given to every report , it is a combination of current timestamp with 4 random numbers
     * @param json domain_data - All the recieved from url stored in json format
     * @param time updated_at - Timestamp of last updation in table row
     * @param time created_at - Timestamp of row creation time
     */
    public function createTable()
    {
        if ($this->checkIfTableExists()) 
        {
            echo "Exiting......\n";
            return;
        }

        echo "Creating Table ......\n";


        try {
            $sql ="CREATE table $this->tableName(
            `ID` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `domain` VARCHAR( 500 ) NOT NULL, 
            `report_id` INT( 14 ) NOT NULL, 
            `domain_data` JSON NOT NULL ,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            UNIQUE (`report_id`));" ;
            
            $this->db->exec($sql);

            print("Created $this->tableName Table.\n");
       
       } catch(PDOException $e) {
           echo $e->getMessage();
       }

        
    }

    /**
     * Check if table exists or not
     * 
     * 
     *  @return Boolean
     */
    public function checkIfTableExists()
    {
        try {
            $result = $this->db->query("SELECT 1 FROM $this->tableName LIMIT 1");
        } catch (Exception $e) {
            // Table Not Found
            echo "Table $this->tableName Not Found...\n";
            return FALSE;
        }
        echo "Table $this->tableName Found...\n";
        // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
        return $result !== FALSE;
    }

}


//Initiate the migration
$initiateMigration = new DomainReportsTable;

$initiateMigration->initiateMigration();