$(document).ready(function(){

    // $("#ictaUnits").css("display", "none")
     //here fetch all MDAs from the DB for ticket issuing
     getMDAs = () => {
       $.ajax({
                 type: "Post",
                 url: "getMDAs.php",
                 success:function(MDAs){
                     $("#MDA").html(MDAs)
                 
                 }// end of success
 
 
         })//end of ajax
 
 
     }// end of getMDAs()
 
     //here we call the function to execute
     getMDAs()
 
     //here fetch all MDAs for registration purpose
        //here fetch all MDAs from the DB
        getMDAsForRegistration = () => {
       $.ajax({
                 type: "Post",
                 url: "getMDAs.php",
                 success:function(MDAs){
                     $("#ministry").html(MDAs)
                 
                 }// end of success
 
 
         })//end of ajax
 
 
     }// end of getMDAsForRegistration()
 
     getMDAsForRegistration()

   
 
     //selecting MDAs

        function getMdaForChart () {
      $.ajax({
                type: "Post",
                url: "getMDAs.php",
                success:function(feed){
                    $("#chooseMda").html(feed)
                
                }// end of success


        })//end of ajax


    }// end of getMdaForChart()
    getMdaForChart ()

    function getMdaForChart1 () {
        $.ajax({
                  type: "Post",
                  url: "getMDAs.php",
                  success:function(feed){
                      $("#chooseMda1").html(feed)
                  
                  }// end of success
  
  
          })//end of ajax
  
  
      }// end of getMdaForChart()
      getMdaForChart1 ()
 

 
     
 
   })// end of ready state
 