

//here we script for Closing and Adding comment
$(document).on("click", '.editButton1', function (e){
    e.preventDefault()
    var ticketNo = $(this).attr("id");
    Swal.fire({
       title: 'Take Action On Ticket no:'+ ticketNo,
       html:
         '<textarea id="message" name="message" rows="10" cols="30" placeholder="Add a comment..."></textarea>' ,
       focusConfirm: false,
       showCancelButton: true,
        confirmButtonColor: 'darkGreen',
        cancelButtonColor: 'darkRed',
        confirmButtonText: 'Update Ticket!',   
       showLoaderOnConfirm:true,
       preConfirm: () => [
         document.querySelector('#message').value, 
         
       ],
       
      }).then((result) => {
        
        if (result.value==""){
          Swal.fire({
            title: "Empty Entry!",
            icon:"error",
            html: '<b style="color:red !important">Empty Inputs!</b>',
            timer: 4000
  
             })
       
        }
        else{
          var inputValue = $("#message").val(); 
          var ticketNo = $(this).attr("id");
         // alert(getId)
       
          $.ajax({
            method: 'post',
            url: 'updateTicket.php',
            data: {inputValue:inputValue, ticketNo:ticketNo },
            beforeSend:function(){
              Swal.showLoading()
              
            },
            success: function(feedback){
              //console.log(inputValue+' '+ticketNo)
              Swal.fire({
                icon:"success",
                html: '<b style="color:green !important">'+feedback+'</b>',
              
            })  
  
            
            }//end of success func
  
  
        }) // end of ajax
  
        }//end of else stmt
  
      })//end of then()
       
  
  
  })//end of on click
  
  

//here we script for Closing and Adding comment
$(document).on("click", '.commentOnly', function (e){
  e.preventDefault()
  var ticketNo = $(this).attr("id");
  Swal.fire({
     title: 'Add Comment To This Ticket no:'+ ticketNo,
     html:
       '<textarea id="message1" name="message1" rows="10" cols="30" placeholder="Add a comment..."></textarea>' ,
     focusConfirm: false,
     showCancelButton: true,
      confirmButtonColor: 'darkGreen',
      cancelButtonColor: 'darkRed',
      confirmButtonText: 'Send Comment',   
     showLoaderOnConfirm:true,
     preConfirm: () => [
       document.querySelector('#message1').value, 
       
     ],
     
    }).then((result) => {
      
      if (result.value==""){
        Swal.fire({
          title: "Empty Entry!",
          icon:"error",
          html: '<b style="color:red !important">Empty Inputs!</b>',
          timer: 4000

           })
     
      }
      else{
        var inputValue = $("#message1").val(); 
        var ticketNo = $(this).attr("id");
       // alert(getId)
     
        $.ajax({
          method: 'post',
          url: 'commentOnly.php',
          data: {inputValue:inputValue, ticketNo:ticketNo },
          beforeSend:function(){
            Swal.showLoading()
            
          },
          success: function(feedback){
            //console.log(inputValue+' '+ticketNo)
            Swal.fire({
              icon:"success",
              html: '<b style="color:green !important">'+feedback+'</b>',
            
          })  

          
          }//end of success func


      }) // end of ajax

      }//end of else stmt

    })//end of then()
     


})//end of on click

