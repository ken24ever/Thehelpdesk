<?php

include('includes/db_connect.php');
//fetch limit data code
$limit = 5;
$page = 0;
$table= " ";

if (isset($_POST['page'])){
    $page = $_POST['page'];
 
}
else{
    $page = 1;
}

$start_from = ($page-1)*$limit;

// SELECT DATA FROM DB
$sql = "SELECT * FROM ticket_details ORDER BY id DESC limit $start_from, $limit ";
$result = mysqli_query($conn, $sql);

//table goes here
$table .= '
<table class="table text-white table-borderless table-hover align-middle">
<thead>

<tr>

<th scope="col">Title</th>
  <th scope="col">Names</th>
  <th scope="col">Job Title</th>
  <th scope="col">Ticket Status</th>
  <th scope="col">MDAs</th>
  <th scope="col">Ticket No</th>
  <th scope="col">Issue</th>
  <th scope="col">Priority Level</th>
  <th scope="col">Date Issued</th>
  <th scope="col">Time</th>
  <th scope="col">Action</th>
  
</tr>
</thead>



';

if (mysqli_num_rows($result) > 0)
{
         // output data of each row
 while($row = mysqli_fetch_assoc($result)) {
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

            //set up  time
            include_once('agoTime.php');
            $agoTime = get_time_ago($timeOfIssue);

            //set up logic and condition for display of priority levels, action taken of tickets
            
        if ($actionOnTickets === "Opened" ){

            $actionOnTickets = '<button class="btn btn-primary">'. $actionOnTickets.'</button>';
        }

        if ($actionOnTickets === "Closed"){

            $actionOnTickets = '<button class="btn btn-success">'. $actionOnTickets.'</button>';
            $agoTime = '<strong style="color:whitesmoke !important; font-size:25px; font-family:open sans;"><span>-:-</span></strong>';
        }

        if ($priorityLevel === "High"){

            $priorityLevel = '<span class="badge badge-danger rounded-pill">'.$priorityLevel.'</span>';
        }

        if ($priorityLevel === "Medium"){

            $priorityLevel = '<span class="badge badge-warning rounded-pill">'.$priorityLevel.'</span>';
        }

        if ($priorityLevel === "Low"){

            $priorityLevel = '<span class="badge badge-primary rounded-pill">'.$priorityLevel.'</span>';
        }
        if ($ticket_status === "Pending"){

            $ticket_status = '<span class="badge badge-warning rounded-pill">'.$ticket_status.'</span>';
        }

        if ($ticket_status === "Attended"){

            $ticket_status = '<span class="badge badge-success rounded-pill">'.$ticket_status.'</span>';
        }

        
        

        $table .= '
         
            <tbody>
        <tr class="text-white">
        
        <td>
        <p class="fw-bold mb-1">'.$title.'</p>
        </td>
        
        <td>
        <div class="d-flex align-items-center">
        <div class="ms-3">
        <p class="fw-bold mb-1">'. $firstName.'  '.$middle_name.'  '.$lastName.'</p>
        <p class="text-muted mb-0">'.$staff_email.'</p>
        </div>
        </div>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $job_title .'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $ticket_status .'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $MDAs .'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $ticket_no .'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $complaints .'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $priorityLevel .'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $date_issued .'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $agoTime .'</p>
        </td>
        
        <td id='.$ticket_no.' class="editButton" title="Click to edit ticket no: '.$ticket_no.'" >
        <p class="fw-bold mb-1">'. $actionOnTickets .'</p>
        </td>
        
        </tr>
        </tbody>
         ';
        

 }// end of while($row = mysqli_fetch_assoc($result))


}// if (mysqli_num_rows($result) > 0)
else{
    $table .= "
    <tr>
    <td>Records Not Available</td>
    </tr>
    ";
}

$table .= '
            </table>

';
// pagination code 
$query = mysqli_query($conn, "SELECT * FROM ticket_details ");
$total_records = mysqli_num_rows($query);
$total_pages = ceil($total_records/$limit);
$table .= '
<ul class="pagination pagination-md pagination-circle">';

// now conditions for previous and next
if ($page > 1){
    $previous = $page-1;
    $table .= '<li class="page-item" id="1"><span class="page-link">First Page</span></li>';
    $table .= '<li class="page-item" id="'.$previous.'"><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
}

//iteration for th number of pages to be seen 
for ($i=1; $i<=$total_pages; $i++){
        $active_class = "";
        if ($i == $page){
            $active_class = "active" ;
        }
        $table .= '<li class="page-item '.$active_class.'" id="'.$i.'"  ><span class="page-link">'.$i.'</span></li>';
}

if ($page < $total_pages){
        $page++;
        $table .= '<li class="page-item" id="'.$page.'"><span class="page-link"><i  class="fa fa-arrow-right" >
        </i></span></li>';
        $table .= '<li class="page-item" id="'.$total_pages.'"><span class="page-link">Last Page</span></li>';

}


$table .= '</ul>';





echo $table;
?>