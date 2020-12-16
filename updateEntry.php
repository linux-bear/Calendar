
<?php
//this starts the session so I can pass variables between html type pages that are not in classes
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
    <div>
  <H1>Select an appointment to view or update:</H1>
  <!--This is the form for the dropdown menu that populates from db-->
    <form id="dropdownForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
        <!-- uses PDO to obtain data from db and stores it it $result-->
        <?php
          include 'pdoconfig.php';

              //create new PdoFetchAll object
              $pdoObject = new Pdoconfig;

              //invoke the method to add the data to the database, including the post data from the form as arguments
              $result = $pdoObject->fetchAllPdo();       
        ?>
 
<select name="dropdownResult" id="dropdownResult">
    <?php foreach($result as $user): ?>
        <option value="<?= $user['ID']; ?>"><?= $user['Startdate']; ?><?= $user['Summary']; ?></option>
    <?php endforeach; ?>
</select>
<input class="SubmitButton" type="submit" name="SUBMITBUTTON" value="Submit" style="font-size:20px; "/>
</form>
</div>

<?php

//this prevents the redirect to the landing page until after the rest of the code has executed.
$redirect = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // $pdoObject = new PdoClean;

    //invoke the method fetchPdo with sql statement and date string
    $id = $pdoObject->clean($_POST["dropdownResult"]);

    //stores the $id from the selected item in the dropdown menu in a session variable to pick up from the landing page
    $_SESSION["sessId"] = $id;

    //this triggers the redirect to the landing page
    $redirect = true;

}

//This redirects to the landing page after the above code has executed
  if ($redirect == true){
  header("Location: updatelanding.php");
  exit();
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



  
  
