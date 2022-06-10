
            
     
    function loadTable (page) {
        $.ajax({
                type: "Post",
                url: "table_display.php",
                data: {page:page},
                success:function(table_info){

                    $(".ticket_records ").html(table_info);
                   
                }


        })//end of ajax

}//end of loadTable

//setInterval(loadTable, 3000)

$(document).on("click", ".page-item", function(){
var page = $(this).attr("id");
console.log(page)
loadTable(page)

})//end of onclick event
loadTable()

$(document).on("click", '.editButton', function (){

    /* alert(id) */
    
    Swal.fire({
      title: 'Are you sure you want to close this ticket?',
      html: "<h3 style='color:red;'>You won't be able to reverse this if you proceed!</h3>",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: 'darkGreen',
      cancelButtonColor: 'darkRed',
      confirmButtonText: 'Yes, Close ticket!',  
    }).then((result) => {
      if (result.value) {
        var ticketNo = $(this).attr("id");
    
       // console.log(ticketNo);
        //alert(ticketNo)
         $.ajax({
                method: 'post',
                beforeSend: function(){
                  swal.fire({
                    title: '',
                    html: '<strong style="color:green">Closing Ticket...</strong>',
                    allowOutsideClick: false,
                   });
                   swal.showLoading();
                               },
                url: 'updateTicket.php',
                data: {ticketNo:ticketNo},
                beforeSend:function(){
                  Swal.isLoading()
                },
                success: function(updatedData){
                  Swal.fire(
                    'TICKET UPDATED!',
                     updatedData,
                    'success'
                  ) 

                  loadTable()
                }
    
    
            }) // end of ajax
     
      }else{
    
        swal("Cancelled", "No Action Was Taken! :)", "info");
      
      }
    
    })
    
    })