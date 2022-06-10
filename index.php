<?php
  session_start(); 

 if (isset($_SESSION['email'])){
  header("location: dashboard.php");

  } 



?>



<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ICTA | Help-Desk</title>
        
        <!-- MDB icon -->
    <link rel="icon" href="img/icta_logo.png" type="image/x-icon" />
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  
     <!-- Font Awesome -->
     <link rel="stylesheet" href="font_awe_6/css/all.css">
   <style>
       body{
           margin: 0 auto;
           font-family: open san;

       }
       .logo{
            height: 50px;
            width: 50px;
            
           
       }
     /*   #description{
           width:100% !important;
           height: 40% !important;
       } */
       .footer{
           border:1px solid grey;
           height: 100px;
           width: auto !important;
           background-color: lightgray;
           margin:315px 0px 0px 0px;
           font-family: Calibri, 'Trebuchet MS';
       }
   </style>
   <script src="jquery/jquery-3.6.0.min.js"></script>
   <link rel="stylesheet" href="toastr/build/toastr.min.css">
   <link rel="stylesheet" href="package/dist/sweetalert2.min.css">
   <script src="package/dist/sweetalert2.min.js"></script>
 <script src="js/login.js"></script>
    </head>
    <body>
    <script src="js/issue_ticket.js"></script>  
      <!-- toast js  -->
      <script src="toastr/build/toastr.min.js"></script>
        <!-- navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="images/edologo1.png"class="logo" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About App</a>
        </li>
        
      </ul>
    </div> 
  </div>
</nav>

<br><br>
<!-- Alert/Notification area -->
<div class="container">
  <div class="row">
    <div class="alert alert-success alert-dismissible fade show" style="display:none ;">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
</div>
<!-- content area -->
<div class="container px-4">
  <div class="row gx-5">
    <div class="col">
     <div class="p-3 border bg-light">

     <div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
       <strong ><i class="fas fa-ticket fa-lg  text-white fa-fw m-2" style="color: rgb(7, 164, 216) !important; font-size: 40px !important;"></i> &nbsp; RAISE A TICKET</strong>
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <form id="myForm" enctype="multipart/form-data" > 
     
            <select class="form-select m-2" aria-label="Default select example" id="title" name="title" >
                <option selected value="">Title <strong style="color: red !important;">*</strong></option>
                <option value="Mr">Mr.</option>
                <option value="Dr">Dr.</option>
                <option value="Mrs">Mrs.</option>
                <option value="Miss">Miss.</option>
              </select>
      
              <div class="input-group m-2">
                <span class="input-group-text">First, Middle And Last Name <strong style="color: red !important;">*</strong></span>
                <input type="text" aria-label="First name" id="firstName" name="firstName" class="form-control" placeholder="Enter First Name" >
                <input type="text" aria-label="Middle name" id="middleName" name="middleName" class="form-control" placeholder="Enter Middle Name">
                <input type="text" aria-label="Last name" id="lastName" name="lastName" class="form-control" placeholder="Enter Last Name">
              </div>
              
              <div class="input-group mb-3 m-2">
                <span class="input-group-text" id="inputGroup-sizing-default">Job Title<strong style="color: red !important;">*</strong>:</span>
                <input type="text" class="form-control" id="job" name="job" placeholder="Enter Your Job Title" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
              </div>
              <div class="input-group mb-3 m-2">
                <span class="input-group-text" id="inputGroup-sizing-default">Email<strong style="color: red !important;">*</strong>:</span>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Your Official Email" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
              </div>
              <div class="input-group mb-3 m-2">
                <span class="input-group-text" id="inputGroup-sizing-default">MDA<strong style="color: red !important;">*</strong>:</span>
                <input type="text" class="form-control" id="MDA" name="MDA" placeholder="Ministry Department and Agency" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
              </div>
              
            <select class="form-select m-2" aria-label="Default select example" id="issues" name="issues" >
              <option selected value="">Select The Issues<strong style="color: red !important;">*</strong></option>
              <option value="NETWORK">Network.</option>
              <option value="OFFICE 365">Office 365.</option>
              <option value="3CX">3CX.</option>
              <option value="SCANNER">Scanner.</option>
              <option value="EDOGOV PASSWORD">EdoGov Password</option>
              <option value="FAULTY LAPTOP">Faulty Laptop</option>
              <option value="EMAIL">Email.</option>
              <option value="APPLICATION SUPPORT">Application Support</option>
              <option value="NO LAPTOP">No laptop</option>
              <option value="OTHERS" style="color:red !important; font-weight: 900 !important;">Couldn't find yours in the list?</option>
            </select>

           <div class="hidMe input-group mb-3 m-2" >
              <span class="input-group-text" id="inputGroup-sizing-default">Please Enter Your Complaint:</span>
              <input type="text" class="form-control" id="hidden_issues_section" name="hidden_issues_section" maxlength="25" 
              placeholder="Type The Issue " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
              <div class="form-helper"></div>
            </div> 

            <div class="input-group mb-3 m-2">
              <span class="input-group-text" >Your Description<strong style="color: red !important;">*</strong>:</span>
              <textarea class="form-control" id="description" name="description" aria-label="Your Description" ></textarea>
            </div>

              <div class="input-group mb-3 m-2">
                <input class="form-control" type="file" id="file" name="files[]" multiple>
              </div>
            <select class="form-select m-2" aria-label="Default select example" id="priority" name="priority" >
              <option selected value="">Priority Level<strong style="color: red !important;">*</strong>:</option>
              <option value="High">High.</option>
              <option value="Medium"> Medium</option>
              <option value="Low">Low</option>
            </select> 

            <div class="input-group mb-3 m-2">
              <span class="input-group-text" id="inputGroup-sizing-default">Pick A Date<strong style="color: red !important;">*</strong>:</span>
              <input type="date" class="form-control" id="entry_date" name="entry_date" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
            </div>
            <div class="container">
              <div class="row">
                    <div class="col-md-12">
                      <div class="input-group mb-3 m-2">
                        <input type="submit" class="form-control btn btn-success p-2" id="ticket" value="Submit Ticket" aria-describedby="inputGroup-sizing-default">
                      </div>
                    
                    </div>
                </div>
            </div>
        </form>
        </div><!-- endo fo accordion body -->
    </div>
  </div>
  
  <div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseOne">
          <strong ><i class="fas fa-user-gear fa-lg  text-white fa-fw m-2" style="color: rgb(7, 164, 216) !important; font-size: 40px !important;"></i> &nbsp; OUR SERVICES</strong>
        </button>
      </h2>
      <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
        </div><!-- endo fo accordion body -->
      </div>
    </div>

    <div class="accordion accordion-flush" id="accordionFlushExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseOne">
            <strong ><i class="fas fa-sign-in fa-lg  text-white fa-fw m-2" style="color: rgb(7, 164, 216)  !important; font-size: 40px !important;"></i> &nbsp; LOGIN</strong>
          </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">

          <form id="myForm2" > 
          <div class="input-group mb-3 m-2">
                <span class="input-group-text" id="inputGroup-sizing-default">Email<strong style="color: red !important;">*</strong>:</span>
                <input type="text" class="form-control" id="email1" name="email1" placeholder="Enter Your Official Email" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
              </div>

              <div class="input-group mb-3 m-2">
                <span class="input-group-text" id="inputGroup-sizing-default">Password<strong style="color: red !important;">*</strong>:</span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
              </div>

              <div class="input-group mb-3 m-2">
                <button type="submit" class="form-control  btn btn-success p-2" id="login"   >LOGIN TO YOUR DASHBOARD </button>
              </div>
      </form>

          </div><!-- endo fo accordion body -->
        </div>
      </div>


     </div><!-- end of p-3  -->
    </div><!-- end of col -->
  
  </div><!-- end of row gx-5 -->
</div><!-- end of container px-4 -->
    </body>
</html>