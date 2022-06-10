<?php
$msg = "";

if (isset($_POST['ticketNo'])){
    $ticketNo = $_POST['ticketNo'];
    include('includes/db_connect.php');

            // SELECT DATA FROM DB
$sql = "SELECT * FROM ticket_details  WHERE ticket_no = '$ticketNo' ";
$result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)){
            $title = $row['title'];
            $firstName = $row['firstName'];
            $middle_name = $row['middle_name'];
            $lastName = $row['lastName'];
            $staff_email = $row['staff_email'];
            $job_title = $row['job_title'];
            $ticket_status = $row['ticket_status'];
            $MDAs = $row['MDAs'];
            $ticket_no = $row['ticket_no'];
            $complaints = $row['complaints'];
            $comments = $row['comments'];
            $files = $row['files'];
            $priorityLevel = $row['priorityLevel'];
            $date_issued = $row['date_issued'];
            $timeOfIssue = $row['timeOfIssue'];
            $actionOnTickets = $row['actionOnTickets'];

        }//end of while loop

        $updateTicketRecord = "UPDATE ticket_details SET ticket_status = 'Attended', actionOnTickets= 'Closed'  WHERE ticket_no = '$ticket_no'";
        $getResult = mysqli_query($conn, $updateTicketRecord);

        if ($actionOnTickets == 'Closed' && $ticket_status == 'Attended' ){
            $msg .= "<b>Ticket Number: <b style='color:green'>" .$ticket_no."</b> Closed Already!</b>";

        }else{
            $msg .= "<b>Ticket Number: <b style='color:green'>" .$ticket_no."</b> Has Been Updated</b>";
        }

       
        echo $msg;

}// end of isset condition



?>