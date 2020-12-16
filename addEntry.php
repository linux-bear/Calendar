<!-- CREATE TABLE Micratable(
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Summary` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Startdate` date NOT NULL,
  `Enddate` date NOT NULL,
  PRIMARY KEY (`ID`));  -->


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
          <li class="nav-item active">
            <a class="nav-link" href="addEntry.php">Add Entry
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="deleteEntry.php">Delete Entry</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="updateEntry.php">Update Entry</a>
        </ul>
      </div>
    </div>
  </nav>

<!-- html form to take the details; inserted into the jumbotron for asthetics-->
  <div class="container">
    <div class="jumbotron">
      <h1>Add Appointment</h1>
      <br>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Summary: <input type="text" name="summary" required>
        <br><br>
        Location: <input type="text" name="location" required>
        <br><br>
        Start Date: <input type="date" name="startDate">
        <br><br>
        End Date: <input type="date" name="endDate">        
        <br><br>
        <input type="submit" name="submit" value="Submit">
      </form>
    </div>
  </div>


   <!-- footer -->
   <div class="footer">
     <p>Linux Bear</p>
   </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
include 'pdoconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //this takes the post data from the form and inserts it into variables
  $summary = $_POST["summary"];
  $location = $_POST["location"];
  $startDate = $_POST["startDate"];
  $endDate = $_POST["endDate"];

  //Including this variable tells the addPdo method to insert "created" into the echo confirmation
  $created = "created";

  //create new PdoAdd object
  $pdoAddObject = new Pdoconfig;

  //invoke the method to add the data to the database, including the post data from the form as arguments
  $pdoAddObject->addPdo($summary, $location, $startDate, $endDate);

  //this prints a confirmation to the screen that the entry has been added. 
  echo "<div style='color:navy;'><h2>The following appointment was added:</h2>";
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

  $pdoAddObject = null;
}
  
  ?>
