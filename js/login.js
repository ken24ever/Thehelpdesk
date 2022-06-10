$(document).ready(function(){
          
    $(document). on('click','#login',  function(event){
     event.preventDefault()
           var email = $("#email1").val();
           var password = $("#password").val();
   
  
           if (email==" " || password==" "){
  
            swal({
                title: "Ooops!",
                text: "Empty Fields Detected!",
                type: "error",
                confirmButtonText:"Exit",
                 allowOutsideClick: false,
      timer: 3000
                });

                return false;
  
           } 
   
          else{ 
  
        $.ajax({
            method:"POST",
            beforeSend: function(){
              swal({
                title: '',
                html: '<img src="img/icta_logo.png" height="80" width="80"><br><br><strong>logging In Shortly...</strong>',
                allowOutsideClick: false,
               });
               swal.showLoading();
                           },
            data: {email:email, password:password},
            url: 'login.php',
            /* dataType:'script',
            cache:false,
            contentType: false,
            processData: false, */
            success:function(data){ 
                console.log(data)
                if (data == 1  ){
                    
                    swal({
                        text:"Authentication Success!" ,
                        type: "success",
                        confirmButtonText:"Exit",
                         allowOutsideClick: false,
              timer: 3000
                        });
                        window.location.href = "http://localhost/help_desk_app/dashboard.php";      

                }else if (data == 0  ) {
                    swal({
                        text:"Authentication Failed!",
                        type: "danger",
                        confirmButtonText:"Exit",
                         allowOutsideClick: false,
              timer: 3000
                        });

                }
            
                         
            }//end of success
           
          
        }) //end of ajax call 
  
       
  
    }//end of else control statement
    
    })//end of doc onClick
  
  })//end of doc ready
  
  
  