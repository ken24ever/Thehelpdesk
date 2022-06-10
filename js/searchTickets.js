
    function searchTickets () {
        $('#searchedTickets').css('display','display')
     $('.chartDisplay').css('display','display')
         $(".loader").css('display','none') 
        const ticketNo = $('#searchTick').val()
        if (!ticketNo == ""){
        $.ajax({
                type: "Post",
                url: "searchedTickets.php",
                data: {ticketNo:ticketNo},
                beforeSend:function(){
                    $(".loader").css('display','block') 
                    //$('.chartDisplay').fadeOut("slow")
                } ,
                success:function(searchTicket){

                    

                    $("#searchedTickets ").html(searchTicket);
                    $('.chartDisplay').fadeOut("slow")
                    $("#searchedTickets ").fadeIn(4000);
                   
                }// end of success


        })//end of ajax

    }// end of if (!ticketNo == "")

}//end of searchTickets


searchTickets()

$(document).on('click', '.backToChart', function(){
    $('.chartDisplay').fadeIn("slow")
    $("#searchedTickets ").fadeOut("slow");
    $('#searchTick').val("")
  })//end of document onChange event 