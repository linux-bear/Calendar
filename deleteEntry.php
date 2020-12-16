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
          <li class="nav-item active">
            <a class="nav-link" href="deleteEntry.php">Delete Entry
            <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="updateEntry.php">Update Entry</a>
        </ul>
      </div>
    </div>
  </nav>


  <div class="container">
    <div class="jumbotron">
    <div>
  <H1>Select an appointment to delete:</H1>
  <!--form to display the appointments, to select the appointment to delete -->
    <form id="dropdownForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
        <?php
          include 'pdoconfig.php';

              //create new PdoFetchAll object
              $pdoObject = new Pdoconfig;

              //invoke the method to add the data to the database, including the post data from the form as arguments
              $result = $pdoObject->fetchAllPdo();     
        ?>

 <!--this is the dropdown box displaying the appointments -->
<select name="dropdownResult" id="dropdownResult">
    <?php foreach($result as $entry): ?>
        <option value="<?= $entry['ID']; ?>"><?= $entry['Startdate']; ?><?= $entry['Summary']; ?></option>
    <?php endforeach; ?>
</select>

<input class="SubmitButton" type="submit" name="SUBMITBUTTON" value="Submit" style="font-size:20px; "/>
</form>
</div>

<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //assign the selected item from the dropdown menu to a variable
    $id = $_POST["dropdownResult"];

    //run the function that deletes the entry with that id from the database
    $pdoObject->deletePdo($id);

    echo "<br>";
    echo "<div style='color:navy;'><h2>The appointment was deleted</h2>";
    echo "<br>";
    $pdoObject = null;
  }

?>
    </div>
  </div>
   
   <!--footer -->
  <div class="footer">
     <p>Linux Bear</p>
   </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>




  
  
