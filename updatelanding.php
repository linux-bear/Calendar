<?php
//this starts the session so I can retrieve the variable from updateEntry.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Linux Bear Calendar</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="micrastyles.css" rel="stylesheet">
  <style>
    .footer {
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
      background-color: #2E2E2E;
      color: white;
      text-align: center;
    }
    </style>
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
    <a class="navbar-brand" href="">
      <img class="img-responsive" width="50px" height="" src="tuxBear.png/150x50?text=Logo" alt="">
    </a>
      <a class="navbar-brand" href="index.php">Calendar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav"> 

          <li class="nav-item">
            <a class="nav-link" href="addEntry.php">Add Entry
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="deleteEntry.php">Delete Entry
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="updateEntry.php">View/Edit Entry
            <span class="sr-only">(current)</span></a>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="jumbotron">
      <h1>View or Edit Appointment</h1>
      <br>
      <!-- form which displays the details automatically, which can then be updated if changed-->
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <?php
      include 'pdoconfig.php';

        //temporarily assign variable as not coming through from previous page
        $id = $_SESSION["sessId"];

        //prepare sql statement
        $stmt = "SELECT * FROM Micratable WHERE ID = ?";

        //create new object of the class PdoFetch
        $pdoObject = new Pdoconfig;

        //invoke the method fetchPdo with sql statement and id to select
        $rtnArray = $pdoObject->fetchPdo($stmt, $id);

        //insert data from array into variables
        $summary = $rtnArray[1];
        //echo $summary; this gives the full phrase
        $location = $rtnArray[2];
        $startDate = $rtnArray[3];
        $endDate = $rtnArray[4];

      ?>
  
        <!--insert php code into value, which prefills the html boxes with php variables -->
        Summary: <input type="text" name="summary" value= "<?php echo $summary ?>">
        <br><br>
        Location: <input type="text" name="location" value = "<?php echo $location ?>">
        <br><br>
        Start Date: <input type="date" name="startDate" value = <?php echo $startDate ?>>
        <br><br>
        End Date: <input type="date" name="endDate" value = <?php echo $endDate ?>>        
        <br><br>
        <input type="submit" name="submit" value="Edit">
      </form>
      <?php
      echo "The summary of the selected appointment is: ";
      echo $summary;
      echo "<br>";
      echo "The location of the selected appointment is: ";
      echo $location;
      echo "<br>";
      echo "The start date of the selected appointment is: ";
      echo $startDate;
      echo "<br>";
      echo "The end date of the selected appointment is: ";
      echo $endDate;
      echo "<br>";
      ?>
    </div>
  </div>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //run the function that deletes the entry with that id from the database
  $pdoObject->deletePdo($id);

  //this takes the post data from the form and inserts it into variables
  $summary = $_POST["summary"];
  $location = $_POST["location"];
  $startDate = $_POST["startDate"];
  $endDate = $_POST["endDate"];

  //Including this variable tells the addPdo method to insert "created" into the echo confirmation
  $created = "updated";

  //invoke the method to add the data to the database, including the post data from the form as arguments
  $pdoObject->addPdo($summary, $location, $startDate, $endDate);

    //this prints a confirmation to the screen that the entry has been added. 
    echo "<div style='color:navy;'><h2>The following appointment has been updated:</h2>";
    echo "Summary: ". $summary;
    echo "<br>";
    echo "Location: " . $location;
    echo "<br>";
    echo "Start Date: ". $startDate;
    echo "<br>";
    echo "End Date: " . $endDate;
    echo "<br>";
    echo "<h2></h2></div>";
    echo "<br>";
    echo "<br>";

  //don't leave objects lying around
  $pdoObject = null;
 
}
?>
   
  <div class="footer">
     <p>Linux Bear</p>
   </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>

  
  
