<?php


$dispResult= "";


    include('includes/db_connect.php');
    
    $sql = "SELECT * FROM users WHERE MDA = 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY' ";
    $result = mysqli_query($conn, $sql);

    //by default
    $dispResult .= '<option selected > Select Officer .<strong style="color: red !important;">*</strong></option>';
    while( $row = mysqli_fetch_assoc($result)){

        $first = $row['firstName'];
        $mid = $row['middleName'];
        $last = $row['lastName'];
        $ictaUnits = $row['units'];
        $fullnames = $row['fullnames'];
        //get queried results
       
        $dispResult .= '<option value="'.$fullnames.'">'.$fullnames.' ('.$ictaUnits.')</option>';
    }

    echo $dispResult;



?>