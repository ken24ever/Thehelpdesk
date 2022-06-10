<?php
  session_start(); 

   if (!isset($_SESSION['email'])){
  header("location: index.php");

  } 



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>ICTA | Help-Desk</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/icta_logo.png" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
    
    

    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />

    <style>

body{
        background-color: hsl(218,41%,15%);
        background-image: radial-gradient(
          650px circle at 0% 0%,
        hsl(218, 41%, 35%) 15%,
        hsl(218, 41%, 30%) 35%,
        hsl(218, 41%, 20%) 75%,
        hsl(218, 41%, 19%) 80%,
        transparent 100%
        ),
        radial-gradient(
        1250px circle at 100% 100%,
        hsl(218, 41%, 35%) 15%,
        hsl(218, 41%, 30%) 35%,
        hsl(218, 41%, 20%) 75%,
        hsl(218, 41%, 19%) 80%,
        transparent 100%

        );
        height:100vh;
        color:whitesmoke;
      }
      @media screen and (max-height: 991.98px) {
  body{
    height: 100%;
  }
}
      
      
      .bg-glass {
        background: hsla(0, 0%, 100%, 0.15);
        backdrop-filter: blur(30px);
     
      }

      .bg-glass:hover{
        background: hsla(21, 21%, 33%, 0.17);
        backdrop-filter: blur(40px);
}
      .bg-theme {
        background-color: hsla(218, 41%, 25%);
      }
      .text-muted {
        color:hsl(0, 0%, 80%) !important
      }
      .text-success{
        color: hsl(144, 100%, 40%) !important;
      }
      .text-danger{
        color: hsl(350, 94.3%, 68.4%) !important;
      }
    .mb-5 {
      margin-top: 20px;
    }
    td{
      color:whitesmoke !important;
    }

    /* searched tickets */
    .lead{
      color: whitesmoke !important;
      text-align: center;
    }

    /***pagination style */
span.page-link{
  cursor: pointer !important;
 color:whitesmoke;
}
 .pagination{
   justify-content:center !important ;
  
 }

 /*loader style */
 .loader {
  border: 2px solid #f3f3f3;
  border-radius: 50%;
  border-top: 2px solid lightblue;
  border-bottom: 2px solid lightblue;
  width: 25px;
  height: 25px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* sideBar styling */

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: hsl(218,41%,15%);
        background-image: radial-gradient(
          650px circle at 0% 0%,
        hsl(218, 41%, 35%) 15%,
        hsl(218, 41%, 30%) 35%,
        hsl(218, 41%, 20%) 75%,
        hsl(218, 41%, 19%) 80%,
        transparent 100%
        ),
        radial-gradient(
        1250px circle at 100% 100%,
        hsl(218, 41%, 35%) 15%,
        hsl(218, 41%, 30%) 35%,
        hsl(218, 41%, 20%) 75%,
        hsl(218, 41%, 19%) 80%,
        transparent 100%

        );
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 20px;
  font-family: open san !important;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
    </style>
<link rel="stylesheet" href="toastr/build/toastr.min.css">
    <script src="jquery/jquery-3.6.0.min.js"></script>
   <link rel="stylesheet" href="toastr/build/toastr.min.css">
   <link rel="stylesheet" href="package/dist/sweetalert2.min.css">
   <link rel="stylesheet" href="animate.css-master/animate.min.css">
   <script src="package/dist/sweetalert2.min.js"></script>
  
 
       <link rel="stylesheet" href="font_awe_6/css/all.css">  
       
       <script src="js/countTickets.js"></script>
       <script src="js/inactive_page.js"></script>
  </head>
  <body>
  <script src="toastr/build/toastr.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  
<!-- sidebar -->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#"> <i class="bg-theme fas fa-user fa-lg text-white fa-fw"></i> Profile</a>
  <a href="#"><i class="bg-theme fas fa-envelope fa-lg text-white fa-fw"></i> Notification</a>
  <a href="#"><i class="bg-theme fas fa-portrait fa-lg text-white fa-fw"></i> About ICTA</a>
  <a href="#"><i class="bg-theme fas fa-gears fa-lg text-white fa-fw"></i> Services</a>
  <a href="logout.php"><i class="bg-theme fas fa-right-from-bracket fa-lg text-white fa-fw"></i> Logout</a>
 
</div>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
<!-- end of side bar -->
   <!-- Project Development Begins here! -->
    <div class="container pt-5">
        <!-- start of summary section  -->
          <section class="">
            <div class="row gx-lg-5">
              
              <div class="hoverEffect col-lg-3 col-md-6 mb-4 mb-lg-0">
                  <!-- card section -->
                <a href="#" class="
                bg-glass
                d-flex
                 align-items-center
                 p-4
                  shadow-4-strong 
                  rounded-6
                  ripple
                  text-reset
                  "
                  data-ripple-color= "hsl(0 , 0% , 75%)"
                  >
                <div class=" bg-theme p-3 rounded-4" >
                  <i class="fas fa-ticket fa-lg text-white fa-fw"></i>
                </div> 
                <div class="ms-4">
                  <p class="text-muted mb-2">
                    Opened Complaints
                  </p>
                  <p class="mb-0">
                    <span class="h5 me-2 opened"></span>
                     <small class="text-danger text-sm percentage">
                       
                      </small>
                  </p>
                </div> 
                </a>
               <!-- card section -->

              </div><!-- col-lg-3 col-md-6 mb-4 mb-lg-0 -->

              <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <!-- card section -->
                <a href="#" class="
                bg-glass 
                d-flex
                 align-items-center
                 p-4
                  shadow-4-strong 
                  rounded-6
                  ripple 
                  text-reset
                  "
                  data-ripple-color = "hsl(0 , 0% , 75%)"
                  >
                <div class="bg-theme p-3 rounded-4" >
                  <i class="fas fa-ticket fa-lg text-white fa-fw"></i>
                </div> 
                <div class="ms-4">
                  <p class="text-muted mb-2">
                    Closed Complaints
                  </p>
                  <p class="mb-0">
                    <span class="h5 me-2 closed"></span>
                     <small class="text-success text-sm percentage1">
                       
                      </small>
                  </p>
                </div> 
                </a>
               <!-- card section -->

              </div><!-- col-lg-3 col-md-6 mb-4 mb-lg-0 -->

              <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                  <!-- card section -->
                <a href="#" class="
                bg-glass 
                d-flex
                 align-items-center
                 p-4
                  shadow-4-strong 
                  rounded-6
                  ripple 
                  text-reset
                  "
                  data-ripple-color = "hsl(0 , 0% , 75%)"
                  >
                <div class="bg-theme p-3 rounded-4" >
                  <i class="fas fa-clock fa-lg text-white fa-fw"></i> 
                </div> 
                <div class="ms-4">
                  <p class="text-muted mb-2">
                   Average Time
                  </p>
                  <p class="mb-0">
                    <span class="h5 me-2"> 00:03:45</span>
                     <small class="text-danger text-sm">
                      
                      </small>
                  </p>
                </div> 
                </a>
               <!-- card section -->

              </div><!-- col-lg-3 col-md-6 mb-4 mb-lg-0 -->

              <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                  <!-- card section -->
                <a href="#" class="
                bg-glass 
                d-flex
                 align-items-center
                 p-4
                  shadow-4-strong 
                  rounded-6
                  ripple 
                  text-reset
                  "
                  data-ripple-color = "hsl(0 , 0% , 75%)"
                  >
                <div class="bg-theme p-3 rounded-4" >
                  <i class="fas fa-sign-out-alt fa-lg text-white fa-fw"></i>
                </div> 
                <div class="ms-4">
                  <p class="text-muted mb-2">
                    Upcoming 
                  </p>
                  <p class="mb-0">
                    <span class="h5 me-2"></span>
                     <small class="text-success text-sm">
                       <!-- <i class="fas fa-arrow-up fa-sm me-1"></i>43,12% -->
                      </small>
                  </p>
                </div> 
                </a>
               <!-- card section -->

              </div><!-- col-lg-3 col-md-6 mb-4 mb-lg-0 -->

            </div><!-- row -->
          </section><!-- end of summary section -->

    </div><!-- end of container pt-5 -->

    <!-- section table -->

      <div class="container mb-5">
        <div class="table-responsive ticket_records bg-glass shadow-4-strong rounded-6">
          <!-- table goes here! -->
          <script src="js/table_display.js"></script>
         
        </div>
      </div>

    <!-- End of section table -->

    <!-- section: visualization -->
        <section class="container">

          <div class="row gx-lg-5 ">

              <div class="col-lg-6 mb-4 mb-lg-0">
                    <!-- card -->
                <div class=" bg-glass shadow-4-strong rounded-6">

                    <!-- card header -->

                        <div class="p-4 border-bottom">

                              <div class="row align-items-center">
                                    <div class="col-6">
                                      <p class="text-muted mb-2">Opened Tickets</p>
                                      <p class="mb-0">
                                        <span class="h4 me-2 opened"></span>
                                        <small class="text-danger text-sm percentage">
                                         
                                        </small>
                                      </p>
                                    </div><!-- end of 1st col-6 -->
                                    <div class="col-6 text-end">
                                          <form action="" class="myForm" onSubmit="return false">
                                            <div class="form-outline m-2">
                                              <input type="date" id="startDate" name="startDate" class="form-control text-white" />
                                              <label class="form-label text-white" for="form12">Choose Date</label>
                                            </div>
                                            <div class="form-outline m-2">
                                              <input type="date" id="endDate" name="endDate" class="form-control text-white" />
                                              <label class="form-label text-white" for="form12">Choose Date</label>
                                            </div>
                                         
              
                                             <div class=" m-2">
                                      <button class="btn btn-success text-white text-lg"  id='resetChart'>Refresh Chart</button>
                                    </div>
                                          </form>

                                    </div><!-- end of 2nd col-6 -->
                              </div><!-- end of row -->

                        </div><!-- p-4 border-boottom -->

                    <!-- end of card header -->

                    <!-- card body -->
                          <div class="p-4">
                              <canvas id="bar-chart" height="200px" class="text-white">

                              </canvas>
                          </div><!-- end of p-4 -->
                    <!-- end of card body -->

                </div><!-- end of bg-glass shadow-4-strong rounded-6 -->

              </div><!-- end of col-lg-6 mb-4 mb-lg-0 -->

              <!-- second column col-lg-6 begins here -->
              <div class="col-lg-6 mb-4 mb-lg-0">
                <!-- card -->
            <div class=" bg-glass shadow-4-strong rounded-6">

                <!-- card header -->

                    <div class="p-4 border-bottom">

                          <div class="row align-items-center">
                                <div class="col-12">
                                 <!--  <p class="text-muted mb-2">Search For Ticket</p>
                                  <p class="mb-0">
                                    <span class="h4 me-2">Edo State</span>
                                  </p>  -->

                                  <form action="" class="myForm" onSubmit="return false">
                                    <div class="form-outline">
                                      <input type="text" id="searchTick" class="form-control text-white" />
                                      <label class="form-label text-white" for="form12">Enter Ticket Number</label>
                                    </div>

                                    <div class="form-outline m-2">
                                              <input type="date" id="ActionClosed1" name="ActionClosed1" class="form-control text-white" />
                                              <label class="form-label text-white" for="form12">Choose Date</label>
                                            </div>
                                            <div class="form-outline m-2">
                                              <input type="date" id="ActionClosed2" name="ActionClosed2" class="form-control text-white" />
                                              <label class="form-label text-white" for="form12">Choose Date</label>
                                            </div>

                                    <div class="form-outline m-2">
                                      <button class="btn btn-success text-white text-lg" onclick="searchTickets()">Search Now!</button>
                                    </div>
                                     
                                  </form>

                      
                                  
                                </div><!-- end of 1st col-6 -->
                               
                          </div><!-- end of row -->

                    </div><!-- p-4 border-boottom -->

                <!-- end of card header -->

                <!-- card body -->
                      <div class="p-0 m-4">

                      <p class="mb-0">
                      <p class="text-muted mb-2">
                    Closed Complaints
                  </p>
                    <span class="h5 me-2 closed"></span>
                     <small class="text-success text-sm percentage1">
                       
                      </small>
                  </p><!-- end of <div class="p-0"> -->
                    
                        <!-- searched ticket details goes here! -->
                        <div class="container">
                          <div id="searchedTickets" class="table-responsive striped"></div>
                        <div class="chartDisplay p-2"><canvas id="closedChart" height="200px" class="text-white"></div>
                        </div>
                        
                       
                        <script src="js/searchTickets.js"></script>
                        <!-- end of searched tickets -->
                      </div><!-- end of p-4 -->
                <!-- end of card body -->

            </div><!-- end of bg-glass shadow-4-strong rounded-6 -->

          </div><!-- end of col-lg-6 mb-4 mb-lg-0 -->

              <!-- end of second column col-lg-6 -->

          </div><!-- end of row gx-lg-5 -->

          

        </section><!-- End of section: visualization -->

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="chart.js/dist/chart.js"></script> 
    <!-- Custom scripts -->
    <script type="text/javascript">
 $(document).ready(function(){ 

   getChartAnalysis = () => {
                  $.ajax({
          type: "POST",
          url:"chart.php",
          dataType:'json',
          cache:false,
          /* contentType: false,
          processData: false, */
          success: function(response){
           
                 //chart script starts here!

                  // var ctx = document.getElementById("barChart")
 const ctx = document.getElementById("bar-chart").getContext("2d")// added '.getContext("2d")'

const myChart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: response.issues,  
    datasets: [
      {
      label: "Tickets Opened Breakdown",
      backgroundColor: [
          'rgba(255, 26, 104, 0.5)',
          'rgba(54, 162, 235, 0.5)',
          'rgba(255, 206, 86, 0.5)',
          'rgba(75, 192, 192, 0.5)',
          'rgba(153, 102, 255, 0.5)',
          'rgba(255, 159, 64, 0.5)',
          'rgba(0, 0, 0, 0.5)',
          'rgba(104, 102, 34, 0.5)',
          'rgba(111, 89, 68, 0.5)',
          'rgba(244, 183, 50, 0.5)'
        ], 
        
      borderWidth: 1,
      hoverBackgroundColor: "white",
      hoverBorderColor: "orange",
      scaleStepWidth: 1,
      data: response.occurence, 
    }
    
  
  ]
  },

  options: {
    plugins: {  // 'legend' now within object 'plugins {}'
      legend: {
        labels: {
          color: "whitesmoke",  // not 'fontColor:' anymore
          // fontSize: 18  // not 'fontSize:' anymore
          font: {
            size: 18 // 'size' now within object 'font {}'
          }
        }
      }
    },
    scales: {
      y: {  // not 'yAxes: [{' anymore (not an array anymore)
        ticks: {
          color: "whiteSmoke", // not 'fontColor:' anymore
          // fontSize: 18,
          font: {
            size: 14, // 'size' now within object 'font {}'
          },
          stepSize: 1,
          beginAtZero: true
        }
      },
      x: {  // not 'xAxes: [{' anymore (not an array anymore)
        ticks: {
          color: "whiteSmoke",  // not 'fontColor:' anymore
          //fontSize: 14,
          font: {
            size: 10 // 'size' now within object 'font {}'
          },
          stepSize: 1,
          beginAtZero: true
        }
      }
    }
  }
}); 


$(document).on('change', '#startDate,#endDate', function(){

            const startDate = $('#startDate').val();
            const endDate = $('#endDate').val();
            $.ajax({
          type: "post",
          url:"getDates.php",
          data: {startDate:startDate, endDate:endDate},
          dataType:'json',
          cache:false,
          success: function(info){
           //console.log(info.datesUpdated,info.issuesUpdated,info.occurenceUpdated)
            myChart.data.labels = info.issuesUpdated;
            myChart.data.datasets[0].data = info.occurenceUpdated;
            myChart.update(); 
            
          }//end of success
          
          })//end of ajax 

})//end of document onChange event
$(document).on('click', '#resetChart', function(){
            myChart.data.labels = response.issues;
            myChart.data.datasets[0].data = response.occurence;
            myChart.update(); 
            })
                 //chart script ends here!
                
          }//end of success 


        })//end of ajax request

      }//end of getChartAnalysis()



      
     setInterval( getChartAnalysis(), 3000);
      })//end of ready state    
             
          
   

    </script>
     
     <script src="js/action.js"></script>

<!-- side bar -->
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>

  </body>
</html>
