<?php
 $table ="";


if (isset($_POST['selectStart']) && isset($_POST['selectEnd']) && isset($_POST['action'])  ) {

  
  header("Content-Type: application/xls");
  header("Content-Disposition: attachment; filename= ".$action." Tickets Reports.xls");
  

    include('includes/db_connect.php');

   $startDate = $_POST['selectStart'];
   $endDate = $_POST['selectEnd'];
   $action = $_POST['action'];

   if (!empty($startDate) && !empty($endDate) && !empty($action)  )
   {

  //table goes here
  $table .= '
   <h2 >'.$action.' Tickets! </h2>
  <table class="table" bordered = "1">
  <thead>
  
  <tr>
  <th scope="col">Title</th>
  <th scope="col">Full Name</th>
  <th scope="col">First Name</th>
  <th scope="col">Middle Name</th>
  <th scope="col">Last Name</th>
  <th scope="col">Official Email</th>
  <th scope="col">Access Level</th>
  <th scope="col">Job Title</th>
  <th scope="col">Ticket Status</th>
  <th scope="col">MDAs</th>
  <th scope="col">Assigned Unit</th>
  <th scope="col">Ticket No.</th>
  <th scope="col">Ticket Created By</th>
  <th scope="col">Ticket Category</th>
  <th scope="col">Complaints</th>
  <th scope="col">Description</th>
  <th scope="col">File Attached</th>
  <th scope="col">Date Issued E.G(2023-01-23)</th>
  <th scope="col">Time of Issue</th>
  <th scope="col">Ticket State</th>
  <th scope="col">Assigned Officer</th>
  <th scope="col">Reassigned Officer</th>
  <th scope="col">Priority Level</th>
  <th scope="col">No. Of Occurence</th>
   
  </tr>
  </thead>
  
  ';
  
// SELECT OPENED DATA FROM DB 
$sql = "SELECT *, COUNT(actionOnTickets) AS occurence FROM ticket_details WHERE actionOnTickets ='$action' AND date_issued  BETWEEN  '$startDate' AND '$endDate' GROUP BY complaints ORDER BY id";
$result = mysqli_query($conn, $sql);

//here we check for any matching data
if (mysqli_num_rows($result) > 0)
      {
            


         // output data of each row
     while($row = mysqli_fetch_assoc($result)) {
       
      $title = $row['title'];
      $fullName = $row['fullNames'];
      $firstName = $row['firstName'];
      $middle_name = $row['middle_name'];
      $lastName = $row['lastName'];
      $units = $row['assign_unit'];
      $staff_email = $row['staff_email'];
      $job_title = $row['job_title'];
      $ticket_status = $row['ticket_status']; 
      $assign_unit = $row['assign_unit'];
      $MDAs = $row['MDAs'];
      $access_level = $row['access_level'];
      $ticket_no = $row['ticket_no'];
      $complaints = $row['complaints'];
      $comments = $row['comments'];
      $ticketCat = $row['ticketCat'];
      $ticketCreatedBy = $row['ticketCreatedBy'];
      $files = $row['files'];
      $priorityLevel = $row['priorityLevel'];
      $date_issued = $row['date_issued'];
      $timeOfIssue = $row['timeOfIssue'];
      $actionOnTickets = $row['actionOnTickets'];
      $assigned_time = $row['assigned_time']; 
      $assigned_to = $row['assigned_to']; 
      $newOfficer = $row['newOfficer']; 
      $date_issued = strtotime($date_issued);
      $date_issued = date('M d Y', $date_issued); 
      $occurence = $row['occurence'];
     
       //set up ago time
       include_once('agoTime.php');
       $agoTime = get_time_ago($timeOfIssue);
       
  
        $table .= ' 
         
        <tbody>
    <tr class="text-dark">
      <td>
      '.$title.'
      </td>
      <td>
      '.$fullName.'
      </td>
      <td>
      '.$firstName.'
      </td>
      <td>
      '.$middle_name.'
      </td>
      <td>
      '.$lastName.'
      </td>
      <td>
      '.$staff_email.'
      </td>
      <td>
      '.$access_level.'
      </td>
      <td>
      '.$job_title.'
      </td>
      <td>
      '.$ticket_status.'
      </td>
      <td>
      '.$MDAs.'
      </td>
      <td>
      '.$assign_unit.'
      </td>
      <td>
      '.$ticket_no.'
      </td>
      <td>
      '.$ticketCreatedBy.'
      </td>
      <td>
      '.$ticketCat.'
      </td>
      <td>
      '.$complaints.'
      </td>
      <td>
      '.$comments.'
      </td>
      <td>
      '.$files.'
      </td>
      <td>
      '.$date_issued.'
      </td>
      <td>
      '.$agoTime.'
      </td>
      <td>
      '.$actionOnTickets.'
      </td>
      <td>
      '.$assigned_to.'
      </td>
      <td>
      '.$newOfficer.'
      </td>
      <td>
      '.$priorityLevel.'
      </td>
      <td>
      '.$occurence.'
      </td>
    
    </tr>
    </tbody>
     ';



     }//end of while loop



 
      }//end of if (mysqli_num_rows($result) > 0)


      else{
        $table .= "
        <tr>
        <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td><p class='lead' style='color:red !important'>Records Not Available</p></td> <td></td> <td></td> <td></td> <td></td>
        </tr>
        ";
    }
    

       
}//end of if (isset($_SESSION['email']) && isset($_SESSION['access_level']) == 1) 

$table .= '
            </table>

';
}//end of (!empty($startDate) && !empty($endDate) && !empty($action)  )
else{
    header("location:dashboard.php");
}




echo $table;


?>