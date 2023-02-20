<?php
session_start();
//session variable  for the user that's assigning

$Accslevel4Email = $_SESSION['email'];

$report = array(
    'fullNames' => null,
    'tick_no' => null,
    'mailNotice' => '',
);

if (!isset($_POST['id'], $_POST['dept'], $_POST['officerName'], $_POST['priorityL'])) {
    $report['mailNotice'] = 'Missing required fields.';
    echo json_encode($report);
    exit();
}

else{

$id = $_POST['id'];
$dept = $_POST['dept'];
$officerName = $_POST['officerName'];
$priorityL = $_POST['priorityL'];
$Nowtime = time();

if (empty($id) || empty($dept) || empty($priorityL) || empty($Nowtime)) {
    $report['mailNotice'] = 'Empty field detected.';
    echo json_encode($report);
    exit();
}

include('includes/db_connect.php');
$updateTicketRecord1 = "UPDATE ticket_details SET  assign_unit  ='$dept', priorityLevel ='$priorityL', assigned_to ='$officerName',  assigned_time  ='$Nowtime'  WHERE ticket_no = '$id' LIMIT 1";
$getResult1 = mysqli_query($conn, $updateTicketRecord1);

$stmt = "SELECT * FROM ticket_details WHERE ticket_no = '$id' LIMIT 1 ";
$query_stmt = mysqli_query($conn, $stmt);

if (!$query_stmt) {
    $report['mailNotice'] = 'Error querying database: ' . mysqli_error($conn);
    echo json_encode($report);
    exit();
}

// initialize variables before loop
$ticketId = array();
$comments = array();
$fullnames = array();
$complaints = array();
$job_title = array();
$MDAs = array();

// set up a foreach loop 
foreach ($query_stmt as $records) {
    $ticketId[] = $records['ticket_no'];
    $comments[] = $records['comments'];
    $fullnames[] = $records['fullNames'];
    $complaints[] = $records['complaints'];
    $job_title[] = $records['job_title'];
    $MDAs[] = $records['MDAs'];
}

// select users email address from icta notifying them of the assigned task
$sql = "SELECT email_address FROM users WHERE MDA = 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY' AND fullnames = '$officerName' ";
$result = mysqli_query($conn, $sql);

if (!$result) {
    $report['mailNotice'] = 'Error querying database: ' . mysqli_error($conn);
    echo json_encode($report);
    //exit();
}

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $userEmail = $row['email_address'];
        //send email
        $to = $userEmail;
        $subject = "ICTA HELPDESK TICKET ASSIGNMENT ";
        $message = '<html>
        <head>
            <title>ICTA HELPDESK | TICKET ASSIGNMENT</title>
            <style>
               body{
                   background-color: rgb(70, 70, 134);
                   font-size: 18px;
                   font-family:  Tahoma;
          }
          .holder{
               border: 4px #03718d solid;
               background-color: rgb(246, 246, 250);
               width: 300px auto;
               margin: 200px;
               height: auto !important;
               border-radius: 8px;
               box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.6), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  
          }
          .ticket_details{
           background-color: rgb(235, 233, 229);
           font-weight: bold;
          }
            </style>
        </head>
        <body>
                   <center>
                       <div class="holder">
                           <center><u><h2>ALERT</h2></u></center>
                         <p class="greetings"> Hello <b>'.$officerName.'</b>.</p> 
                         <p class="mail_body"> 
                            This mail is to notify you that ticket <u>'.$records['ticket_no'].'</u> has been assigned to you.
                            Kindly see below the ticket details. To take action on ticket, kindly login to your account 
                            by clicking this link <a href="https://edoictaservices.com.ng/helpdesk">login</a>.
                            Thank you and have a good day. 
                           </p>
                           <center><h2>Ticket details</h2></center>
                           <hr>
                           <p class="ticket_details">
                           ISSUER NAME : <u>'.$records['fullNames'].'</u>
                           </p>
                           <hr>
                            <p class="ticket_details">
                             OFFICE TITLE   : <u>'.$records['job_title'].'</u>
                           </p>
                           <hr>
                            <p class="ticket_details">
                               DEPARTMENT CONCERNED : <u>'.$dept.'</u>
                            </p>
                            <hr>
                            <p class="ticket_details">
                               PRIORITY LEVEL : '.$priorityL.'
                            </p>
                            <hr>
                            <p class="ticket_details">
                               ISSUE RAISED : '.$records['complaints'].'
                            </p>
                            <hr>
                            <p>&copy; <?php echo date(Y); ?> ICTA HELP DESK  Email:<b>icta.helpdesk@edostate.gov.ng</b></p> 
  
  
                       </div>
                   </center> 
    
    
        </body>
    </html>';
        $headers = "From: ictahelpdesk@edoictaservices.com.ng\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'Cc:icta.helpdesk@edostate.gov.ng' . "\r\n";
        $headers .= 'Cc:'.$Accslevel4Email."\r\n";
              $email_box = mail($to, $subject, $message, $headers);
  
                if ($email_box == true){
  
                }
                else{
                  $report['mailNotice'] = "could not send mail!"; 
                }  
    }//end of while loop
} else {
    $report['mailNotice'] = 'No email found for the given officer name.';
    echo json_encode($report);
   // exit();
}

$report['fullNames'] = $officerName;
$report['tick_no'] = $ticketId;
}//end of else
echo json_encode($report);

mysqli_close($conn);
?>
