<?php
include 'connecting.php';

class Pdoconfig extends connect
{
      //This Fn connects to the database and retrieves the summary
    public function fetchPdo($sqlI, $valueI){

        try{
            //create a new pdo object from the connect class
            $pdo = $this->connecting();

            //insert the sql statement into the stmt variable
            $sth = $pdo->prepare("$sqlI");

            //use bindValue() to insert the variable into the sql statement
            $sth->bindValue(1, $valueI);

            //this executes the statement
            $sth->execute();

            //this fetches 1 row from the database
            $row = $sth->fetch();

            //return $pdo to null ready for next method
            $pdo = null;
        }
        //this will display any pdo errors
        catch (PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return $row;
    }


    public function addPdo($summaryI, $locationI, $startDateI, $endDateI){
        try {
            //create a new pdo object from the connect class
            $pdo = $this->connecting();

            //set exception attributes
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare("INSERT INTO Micratable (Summary,Location,Startdate,Enddate) VALUES (:summary, :location, :startDate, :endDate)");
            
            //binding the parameters securely inserts my variables into the prepare statement, preventing malicious users intercepting and modifying the variables
            $stmt->bindParam(':summary', $summary);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':startDate', $startDate);
            $stmt->bindParam(':endDate', $endDate);

            //clean the data before insert as it can contain nasties from an sql injection attack
            $summary = $this->clean($summaryI);
            $location = $this->clean($locationI);
            $startDate = $this->clean($startDateI);
            $endDate = $this->clean($endDateI);

            if ($endDate < $startDate){
                echo "End date cannot be sooner than start date!";
                exit();
            }

            $stmt->execute();

            //don't leave objects lying around
            $pdo = null;

        }
        catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

    }


    public function fetchAllPdo(){
        try{
            //create a new pdo object from the connect class
            $pdo = $this->connecting();

            //create sql statement 
            $sql = "SELECT ID, Summary, Startdate FROM Micratable";

            //insert the sql statement into the stmt variable
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            //place the array into $result variable
            $result = $stmt->fetchAll(); 

            $pdo = null;
            
            return $result;
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }



    public function deletePdo($idI){
          try {
            //create a new pdo object from the connect class
            $pdo = $this->connecting();

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("DELETE FROM Micratable WHERE ID = :ID");

            $stmt->bindParam(':ID', $id);

            $id = $this->clean($idI);

            $stmt->execute();

            $pdoObject = null;
            $pdo = null;
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

    }



        //I didn't write this, swiped off the internet somewhere
    public function clean($userInput) {
            $userInput = trim($userInput);
            $userInput = stripslashes($userInput);
            $userInput = htmlspecialchars($userInput);
            return $userInput;
          }
    

}

?>
