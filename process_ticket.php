<?php
$errMessages = "";
$valid = 1;


         //file directory
         $target_dir = 'uploads/'; 
            // response messages
            $response = array (
                'status' => 0,
                'message' => "Form submission failed, please try again!",
                'ticketNo' => " "
            );

   //file type formats the program can allow
   $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg');

if (isset($_POST['title']) || isset($_POST['firstName']) || isset($_POST['middleName']) || isset($_POST['lastName'])|| isset($_POST['job'])
|| isset($_POST['email'])|| isset($_POST['MDA']) || isset($_POST['job']) || isset($_POST['issues'])
|| isset($_POST['description'])|| isset($_POST['files'])|| isset($_POST['priority'])|| isset($_POST['entry_date'])
 ){

    
    

         //now we validate data from javascript lastName
 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

    // set up a local variable to grab the posted data from the form
    $personalityTitle =  test_input($_POST['title']);
    $firstName =  test_input($_POST['firstName']);
    $middleName =  test_input($_POST['middleName']);
    $lastName =  test_input($_POST['lastName']);
    $email =  test_input($_POST['email']);
    $job_title = test_input($_POST['job']);
    $MDA =  test_input($_POST['MDA']);
    $issues =  test_input($_POST['issues']);
    //$hidden_issues_section =  test_input($_POST['hidden_issues_section']);
    $description =  test_input($_POST['description']);
    $file =  $_FILES["files"];
    $priority =  test_input($_POST['priority']);
    $entry_date =  test_input($_POST['entry_date']);
    $actionOnTicket = test_input("Opened");
    $ticketStatus = test_input("Pending");
    $timeOfIssue = time();  
  

    if (empty( $personalityTitle)){
        $valid = 0;
        $errMessages .= "<br> Please Enter Your Title!";
        //return false;

    }//end of if empty
  else  if (empty( $firstName)){
       $valid = 0;
       $errMessages .= "<br> Please Enter Your First Name!";
       //return false;
   }//end of if empty
   else if (empty( $middleName)){
       $valid = 0;
       $errMessages .= "<br> Please Enter Your Middle Name!";
       //return false;
   }//end of if empty
   else if (empty( $lastName)){
       $valid = 0;
       $errMessages .= "<br> Please Enter Your Last Name!";
      // return false;
   }//end of if empty
   else if (empty( $email)){
       $valid = 0;
       $errMessages .= "<br> Please Enter Your Official Email!";
      // return false;
   }//end of if empty
   else if (empty( $MDA)){
       $valid = 0;
       $errMessages .= "<br> Please Enter Your Ministry, Department and Agency!";
      // return false;
   }//end of if empty
   else if (empty( $issues)){
       $valid = 0;
       $errMessages .= "<br> Please Select An Issues To Address!";
      // return false;
   }//end of if empty
   else if (empty( $description)){
       $valid = 0;
       $errMessages .= "<br> Please Enter Your Description!";
      // return false;
   }//end of if empty
   else if (empty( $priority)){
       $valid = 0;
       $errMessages .= "<br> Select A Priority Level For This Ticket!";
       //return false;
   }//end of if empty
   else if (empty( $entry_date)){
       $valid = 0;
       $errMessages .= "<br> Please Enter Date Of Entry!";
       //return false;
   }//end of if empty
   
     //validate Email field 

     else if (filter_var($email, FILTER_VALIDATE_EMAIL)===false){

        $valid = 0;
        $errMessages .= "<br>Please Enter A Valid Email!.";
       // return false;
}//end of (filter_var($email, FILTER_VALIDATE_EMAIL)===false)
else{
            //when valid == 1 the upload files 
            if ($valid == 1){

             // generate a random ticket number each time a form is submitted using Mersenne Twister
                $generateRandomNum =  '#'.mt_rand(1000000,9000000);

       

                    $uploadStatus = 1;
                    $fileNames = array_filter($file['name']);

                    //upload file(s) now
                    $uploadedFile = "";
                    if (!empty($fileNames)) {

                            foreach($file['name'] as $key => $var){

                                $file_name = basename($file['name'][$key]);

                                //filepath
                                $targetedFilePath = $target_dir . $file_name;

                                //check whether file type is valid
                                $fileType = pathinfo($targetedFilePath, PATHINFO_EXTENSION);

                                if (in_array($fileType, $allowTypes)){

                                    if (move_uploaded_file($file['tmp_name'][$key], $targetedFilePath)){

                                        $uploadedFile .= $file_name.',';

                                    }//end of (move_uploaded_file($file['tmp_name'][$key], $targetedFilePath))
                                        
                                    else{

                                        $uploadStatus = 0;
                                        $response['message'] = "Oops! There was an error uploading your file!";

                                        }//end of else for move_upload

                                }//end of (in_array($fileType, $allowTypes))
                                else{

                                    $uploadStatus = 0;
                                    $response['message'] = "Sorry! System can only accept 'pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg' ";
                               
                                }// end of (in_array($fileType, $allowTypes)

                            }//end of foreach

                    }//end of if (!empty($fileNames))

            }//end of if valid == 1

                if ($uploadStatus == 1){ 

                    // Now we include database connect script
            include("includes/db_connect.php");

            //here we use validate function to trim the file

            $uploadFileStr = trim($uploadedFile, ',');

               //here we insert into the database table of all posted data using prepared stmt
 $stmt = $conn->prepare("INSERT INTO ticket_details (title,firstName,middle_name,lastName,staff_email,job_title,
 ticket_status,MDAs,ticket_no,complaints,comments,files,priorityLevel,date_issued,timeOfIssue,actionOnTickets) 
               VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");;;;;;;
     $stmt->bind_param("ssssssssssssssss", $personalityTitle, $firstName, $middleName, $lastName,$email,
     $job_title,$ticketStatus,$MDA,$generateRandomNum,$issues,$description, $uploadFileStr, $priority,
      $entry_date, $timeOfIssue, $actionOnTicket);
     $stmt->execute(); 

     if ($stmt){
        $response['status'] = 1;
        $response['ticketNo'] = $generateRandomNum;
        $response['message'] = 'Form Data Successfully Submitted!';
    }//end of if $stmt

                }//end of if $uploadStatus == 1

              else {
                error_log('Could not create a statement:' . $conn->error);
                        $response['message'] = "Please, Fill All Mandatory Fields!".$errMessages;
                      return false;  
                }// else for if ($uploadStatus == 1) 

                //return response

                
 }//end of isset function

}// if error else  

// header('Content-Type: application/json');
echo json_encode($response);
?>