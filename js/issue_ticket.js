
    $(document).ready(function(){ 
      
      $("#myForm").on('submit', function(e){
  
        e.preventDefault()
  
          //we create local variables to hold inputs from the form fields
 
          const title = $("#title").val();
                  const firstName = $("#firstName").val();
                  const lastName = $("#lastName").val();
                  const middleName = $("#middleName").val();
                  const job = $("#job").val();
                  const email = $("#email").val();
                  const MDA = $("#MDA").val();
                  const issues = $("#issues").val();
                  const files = $("#file").val();
                  const description = $("#description").val();
                  const priority = $("#priority").val();
                  const entry_date = $("#entry_date").val();
                  
               /*    if (title == ""){
                     $('#title').css('borderColor','red')
                  } */
              /*     if (firstName == "" || lastName == "" || middleName == "" || job =="" || email =="" 
                  || MDA=="" || issues== "" || description == "" || priority == "" || entry_date ==""){
                     $('#title,#firstName,#lastName,#job,#email,#issues,#description,#priority,#entry_date').css('borderColor','red')
                  } */
 
                
                     if (!email.match("@")){
                        // alert("Email Address Invalid.")
                         function toasterOptions() {
                          toastr.options = {
                              "closeButton": false,
                              "debug": false,
                              "newestOnTop": false,
                              "progressBar": true,
                              "positionClass": "toast-top-right",
                              "preventDuplicates": true,
                              "onclick": null,
                              "showDuration": "100",
                              "hideDuration": "1000",
                              "timeOut": "5000",
                              "extendedTimeOut": "1000",
                              "showEasing": "swing",
                              "hideEasing": "linear",
                              "showMethod": "show",
                              "hideMethod": "hide"
                          };
                      };
                      
                      
                      toasterOptions();
                           toastr.warning( "Email Address Invalid", "Invalid Email!" )
                 
                     
                     }//end of if !email.match()
                     else{
 
                          // creating an instance of the
                  const formObj = new FormData(this);
  
                  //here we append all form fields
                  formObj.append('title', title);
                  formObj.append('firstName', firstName);
                  formObj.append('lastName', lastName);
                  formObj.append('middleName', middleName);
                  formObj.append('job', job);
                  formObj.append('email', email);
                  formObj.append('MDA', MDA);
                  formObj.append('issues', issues);
                  formObj.append('files', files);
                  formObj.append('description', description);
                  formObj.append('priority', priority);
                  formObj.append('entry_date', entry_date);
                
          $.ajax({
          type: "POST",
          url:"process_ticket.php",
          data: formObj,
          dataType:'json',
          cache:false,
          contentType: false,
          processData: false,
          beforeSend: function(){
          
            $("#ticket").attr('disabled', 'disabled'); 
 
            swal({
                      title: '',
                      html: '<img src="img/icta_logo.png"><br><br><strong style="color:green; font-family:italic; font-weight:900">Creating Ticket Shortly...</strong>',
                      allowOutsideClick: true,
                      timer:2000
                     });
                     swal.showLoading();
          },
          success: function(response){
             
             $("#ticket").removeAttr('disabled'); 
            
 
            console.log(response.status,response.message)
             if (response.status == 1){
          $("#myForm")[0].reset();
          $(".alert").css({
             'font-size': '20px',
             'display':'block',
             'text-align':'center'
         });
              $('.alert').html('Ticket Number Created Successfully: '+response.ticketNo+'. Please copy it for ticket tracking!');
              function toasterOptions() {
                 toastr.options = {
                     "closeButton": false,
                     "debug": false,
                     "newestOnTop": false,
                     "progressBar": true,
                     "positionClass": "toast-top-right",
                     "preventDuplicates": true,
                     "onclick": null,
                     "showDuration": "100",
                     "hideDuration": "1000",
                     "timeOut": "5000",
                     "extendedTimeOut": "1000",
                     "showEasing": "swing",
                     "hideEasing": "linear",
                     "showMethod": "show",
                     "hideMethod": "hide"
                 };
             };
             
             
             toasterOptions();
                  toastr.success( response.message, "Successful!" )
        
              
            } //ende here
         else if (response.status == 0){
             function toasterOptions() {
                 toastr.options = {
                     "closeButton": false,
                     "debug": false,
                     "newestOnTop": false,
                     "progressBar": true,
                     "positionClass": "toast-top-right",
                     "preventDuplicates": true,
                     "onclick": null,
                     "showDuration": "100",
                     "hideDuration": "1000",
                     "timeOut": "5000",
                     "extendedTimeOut": "1000",
                     "showEasing": "swing",
                     "hideEasing": "linear",
                     "showMethod": "show",
                     "hideMethod": "hide"
                 };
             };
             
             
             toasterOptions();
                  toastr.warning( response.message, "ERROR DETECTED!" )
        
          } 
  
    
  
          }//end of success function
  
          })//end of ajax 
  
 
                     }// end of if !email.match else statement
  
                 
  
      })//end of $("myForm")onSubmit
  
          // file type validation
          var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg']       
           $("#file").change(function(){
             for(i=0; i<this.files.length; i++){
                      var file = this.files[i];
                      var fileType = file.type;
             }
      
             if (!( (fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3])
             || (fileType == match[4]) || (fileType == match[5]) 
             )) {
              function toasterOptions() {
          toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": true,
              "positionClass": "toast-top-right",
              "preventDuplicates": true,
              "onclick": null,
              "showDuration": "100",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "show",
              "hideMethod": "hide"
          };
      };
      
      
      toasterOptions();
           toastr.warning( "Ooops!!! System Can Only Accept PNG, JPEG, JPG, PDF and DOC File Format!", "ERROR DETECTED!" )
      
           $("#file").val("");
                   return false;
             }
      
           }) // end of change file  
  
  
  
  
  //hide the sub-category of issues
  const sub_cat = $(".hidMe").css('display', 'none');
  
        $(document).on('change', "#issues", function(){
          const issues = $("#issues").val();
          const hidden_issues_section = $("#hidden_issues_section").val();
  
  if (issues == "others") {
    sub_cat.fadeIn("slow");
    issues="others"
    hidden_issues_section = "others"
  }else if (issues != "OTHERS"){
    $(".hidMe").fadeOut("slow");
    //hidden_issues_section.val("");
  }
  
  })
  
  
       })/* end of ready state */
  
  
    
  
  
 