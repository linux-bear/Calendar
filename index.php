<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Linux Bear Calendar</title>

  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

 <style>
  body{font-family: Lato;}
  caption{font-size: 14pt; margin: 10px 0 20px 0; font-weight: 700; position:relative; top: 2px; left: 10px;}
  table.calendar{width:100%; border:1px solid #000;}
  td.day{width: 14%; height: 140px; border: 1px solid #000; vertical-align: top;}
  td.day span.day-date{font-size: 14pt; font-weight: 700;}
  th.header{background-color: #003972; color: #fff; font-size: 14pt; padding: 5px;}
  .not-month{background-color: #a6c3df;}
  td.today {background-color:#efefef;}
  td.day span.today-date{font-size: 16pt;}
  /* td.day span.appoint{font-size: 10pt; font-weight: 700; }  */
  /* border:1px; vertical-align: center; doesn't change it's position*/
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
            <a class="nav-link" href="deleteEntry.php">Delete Entry</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="updateEntry.php">Update Entry</a>
        </ul>
      </div>
    </div>
  </nav>

<?php
;

include 'calendar.php';

$myCalendar = new Calendar();
$m = "";
   parse_str($_SERVER['QUERY_STRING']);  
 
   if ($m == ""){
    
    $dateComponents = getdate();
    $month = $dateComponents['mon'];
    $year = $dateComponents['year'];
   } else {
   
     $month = $m;
     $year = $y;
   
   }
 

 echo $myCalendar->build_previousMonth($month, $year, $monthString);
 echo $myCalendar->build_nextMonth($month,$year,$monthString);
 echo $myCalendar->build_calendar($month,$year,$dateArray);



?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
