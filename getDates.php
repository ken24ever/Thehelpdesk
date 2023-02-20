<?php


if (isset($_POST['startDate']) || isset($_POST['endDate']) || isset($_POST['chooseMda1'])  ){
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $chooseMda1 = $_POST['chooseMda1'];
    include('includes/db_connect.php');
    
    $sql = "SELECT *, COUNT(complaints) AS openedData  FROM ticket_details WHERE actionOnTickets = 'Opened'  AND MDAs LIKE '%$chooseMda1%' AND date_issued BETWEEN '$startDate' AND '$endDate' GROUP BY complaints";

    $countRecresult = mysqli_query($conn, $sql);


    $issues_raised = array();
    $noOfOccurence = array();
    $getDates = array();

    if (mysqli_num_rows($countRecresult) > 0) {
        // Rows were returned by the query
        while ($record = mysqli_fetch_assoc($countRecresult)) {
            $issues_raised[] = $record['complaints'];
            $noOfOccurence[] = $record['openedData'];
            $getDates[] = $record['date_issued'];
        }

        $info['issuesUpdated'] = $issues_raised;
        $info['occurenceUpdated'] = $noOfOccurence;
        $info['datesUpdated'] = $getDates;
    } else {
        // No rows were returned by the query
        $error = "No records found based on the specified criteria.";
        $info['error'] = $error;
    }

    mysqli_close($conn);



}//end of isset

echo json_encode($info);
?>