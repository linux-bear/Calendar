
<?php
include 'pdoconfig.php';
class DisplaySummary
{
    public function insertSummary($yearI, $monthI, $dayI){

        //create a date string suitable for inserting into sql statement
        $createDateString = new CreateDate;
        $dateString = $createDateString->createDateString($yearI, $monthI, $dayI);

        //select summary from the database, using dateString as an argument
        $selectFromDBase = new SelectDB;
        $fullSummary =  $selectFromDBase->selectFromDBase($dateString);

        //limit the string to being 60 characters
        $cutSummary = substr($fullSummary,0,60);

        return $cutSummary; 

    }
}

class CreateDate
{

    public function createDateString($year, $month, $day){
        //Turn the month into a number
        $numMonth = date('m',strtotime($month));
    
        //create string in format"2020-12-02"
        $dateString = $year;
        $dateString .= "-";
        $dateString .= $numMonth;
        $dateString .= "-";
        $dateString .= $day;

        return $dateString;
    
    }
}

class SelectDB
{
    
    public function selectFromDBase($dateStringI){

        //prepare sql statement
        $stmt = "SELECT Summary FROM Micratable WHERE Startdate = ?";

        //create new object of the class pdoConfig
        $pdoObject = new Pdoconfig;

        //invoke the method fetchPdo with sql statement and date string
        $rtnArray = $pdoObject->fetchPdo($stmt, $dateStringI);

        $summary = $rtnArray[0];

        return $summary;
    }

}

    
    
?>