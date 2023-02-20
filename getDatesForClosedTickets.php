<?php
if (isset($_POST['ActionClosed1']) || isset($_POST['ActionClosed2']) || isset($_POST['chooseMda'] )){
    $startDate = $_POST['ActionClosed1'];
    $endDate = $_POST['ActionClosed2'];
    $chooseMda = $_POST['chooseMda'];
    $actionTaken = 'Closed';
    include('includes/db_connect.php');

    $stmt = "SELECT *, COUNT(complaints) AS closedData  FROM ticket_details WHERE actionOnTickets = '$actionTaken'  AND MDAs LIKE '%$chooseMda%' AND date_issued BETWEEN '$startDate' AND '$endDate' GROUP BY complaints";

    $stmtResults = mysqli_query($conn, $stmt);

    $issues_raised = array();
    $noOfOccurence = array();
    $getDates = array();

    if (mysqli_num_rows($stmtResults) > 0) {
        // Rows were returned by the query
        while ($record = mysqli_fetch_assoc($stmtResults)) {
            $issues_raised[] = $record['complaints'];
            $noOfOccurence[] = $record['closedData'];
            $getDates[] = $record['date_issued'];
        }

        $info['issuesUpdated1'] = $issues_raised;
        $info['occurenceUpdated1'] = $noOfOccurence;
        $info['datesUpdated'] = $getDates;
    } else {
        // No rows were returned by the query
        $error = "No records found based on the specified criteria.";
        $info['error'] = $error;
    }
    
    mysqli_close($conn);
}

echo json_encode($info);
?>
