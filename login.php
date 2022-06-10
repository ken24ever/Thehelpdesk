<?php

 
// Define variables and initialize with empty values
$email= $password=$output_msg="";
 
// Processing form data when form is submitted
if( isset($_POST['email']) && isset($_POST['password']) && $_SERVER["REQUEST_METHOD"] == "POST"){
     
   


    //connect to db
     include("includes/db_connect.php");

      //now we validate data from javascript
      function test_input($data) {
        $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
        return $data;
          } //end of test_input

          //now assign variables locally
          $email = test_input($_POST["email"]); 
          $password = test_input($_POST["password"]);

    
        // Prepare a select statement
        $sql = "SELECT * FROM admin WHERE email = ? AND pass_Word = ?";

          $stmt = mysqli_stmt_init($conn);
         $get_stmt_prepared= mysqli_stmt_prepare($stmt, $sql);

        if(!$get_stmt_prepared){
            $output_msg .= "SQL statement failed!";
           // return false;
        }
        else{
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $email,$password);
            // execute query
            mysqli_stmt_execute($stmt) ; 
            //here get results from query          
            $result = mysqli_stmt_get_result($stmt);
          
            //loop
           while($row = mysqli_fetch_assoc($result)){
             
                    $usrID = $row['id'];
                    $Email = $row['email'];
                    $passWd = $row['pass_Word'];
                    

                         //here we assign the local variables to session super global variable 
                         session_start(); 
                $_SESSION['email'] = $Email;
                $_SESSION['password'] = $passWd;
              
             
            } //end of while loop

                    if (mysqli_num_rows($result)  > 0){
             
             /*      header("location:dashboard.php"); */
               $output_msg .= 1 ;  
                    
                    } else if (mysqli_num_rows($result) < 1 ){
                        $output_msg .= 0 ;
                        /* header("location:index.php"); */
                    }

                
                    echo $output_msg;
                   
                    
         

           
            
         }// end of  else stmt
            
    
     

            // Close connection
            mysqli_close($conn);

        }// end of if isset  





   


?>