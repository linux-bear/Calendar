<?php
include 'DisplaySummary.php';

class Calendar
{
     private $myMonth = "";

public function build_calendar($month,$year,$dateArray) {

     // Create array containing abbreviations of days of week.
     $daysOfWeek = array('Sun','Mon','Tues','Wed','Thurs','Fri','Sat');

     // What is the first day of the month in question?
     $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

     // How many days does this month contain?
     $numberDays = date('t',$firstDayOfMonth);

     // Retrieve some information about the first day of the
     // month in question.
     $dateComponents = getdate($firstDayOfMonth);

     // What is the name of the month in question?
     $monthName = $dateComponents['month'];
     $myMonth = $monthName;

     // What is the index value (0-6) of the first day of the
     // month in question.
     $dayOfWeek = $dateComponents['wday'];

     // Create the table tag opener and day headers
     $calendar = "<table class='calendar'>";
     $calendar .= "<caption>$monthName $year</caption>";
     $calendar .= "<tr>";

     // Create the calendar headers

     foreach($daysOfWeek as $day) {
          $calendar .= "<th class='header'>$day</th>";
     } 

     // Create the rest of the calendar

     // Initiate the day counter, starting with the 1st.

     $currentDay = 1;

     $calendar .= "</tr><tr>";

     // The variable $dayOfWeek is used to
     // ensure that the calendar
     // display consists of exactly 7 columns.

     if ($dayOfWeek > 0) { 
          $calendar .= "<td colspan='$dayOfWeek' class='not-month'>&nbsp;</td>"; 
     }
     
     $month = str_pad($month, 2, "0", STR_PAD_LEFT);
  
     while ($currentDay <= $numberDays) {

          // Seventh column (Saturday) reached. Start a new row.

          if ($dayOfWeek == 7) {

               $dayOfWeek = 0;
               $calendar .= "</tr><tr>";

          }
          
          $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
          
          $date = "$year-$month-$currentDayRel";
          
          //create new DisplaySummary object
          $dispSum = new DisplaySummary;

          //call the method insertSummary with the given arguments and put the result in $summary
          $summary = $dispSum->insertSummary($year, $myMonth, $currentDay);

          if ($date == date("Y-m-d")){
           $calendar .= "<td class='day today' rel='$date'><span class='today-date'>$currentDay</span><span class='appoint'>$summary</span></td>";
          }
          else{
           $calendar .= "<td class='day' rel='$date'><span class='day-date'>$currentDay</span><span class='appoint'>$summary</span></td>";
          }         

          // Increment counters
          $currentDay++;
          $dayOfWeek++;

     }
     
     

     // Complete the row of the last week in month, if necessary

     if ($dayOfWeek != 7) { 
     
          $remainingDays = 7 - $dayOfWeek;
          $calendar .= "<td colspan='$remainingDays' class='not-month'>&nbsp;</td>"; 

     }
     
     $calendar .= "</tr>";

     $calendar .= "</table>";

     return $calendar;

}

public function build_previousMonth($month,$year,$monthString){
 
 $prevMonth = $month - 1;
  
  if ($prevMonth == 0) {
   $prevMonth = 12;
  }
  
 if ($prevMonth == 12){  
  $prevYear = $year - 1;
 } else {
  $prevYear = $year;
 }
 
 $dateObj = DateTime::createFromFormat('!m', $prevMonth);
 $monthName = $dateObj->format('F'); 
 
 return "<div style='width: 33%; display:inline-block; position:relative; top: 2px; left: 10px;'><a href='?m=" . $prevMonth . "&y=". $prevYear ."'><- " . $monthName . "</a></div>";
}

public function build_nextMonth($month,$year,$monthString){
 
 $nextMonth = $month + 1;
  
  if ($nextMonth == 13) {
   $nextMonth = 1;
  }
 
 if ($nextMonth == 1){  
  $nextYear = $year + 1;
 } else {
  $nextYear = $year;
 }
 
 $dateObj = DateTime::createFromFormat('!m', $nextMonth);
 $monthName = $dateObj->format('F'); 
 
 return "<div style='width: 33%; display:inline-block;'>&nbsp;</div><div style='width: 33%; display:inline-block; position:relative; right: 10px; top: 2px;text-align:right;'><a href='?m=" . $nextMonth . "&y=". $nextYear ."'>" . $monthName . " -></a></div>";
}

}