<html>  
      <head>  
           <title>Dynamically Add or Remove input fields in PHP with JQuery</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      </head>  
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <body>  
           <div class="container">  
                <br />  
                <br />  
                <h2 align="center">Dynamically Add or Remove input fields in PHP with JQuery</h2>  
                <div class="form-group">  
                     <form name="add_name" id="add_name" action="cadastra">  
                          <div class="table-responsive">  
                               <table class="table table-bordered" id="dynamic_field">  
                                    <tr>  
                                         <td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" autofocus maxlength="13" onkeyup="return(DoCheckLength(this));"/><span id="description"></span></td>  
                                         <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>

                                    </tr>  
                               </table>  
                               <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  
                          </div>  
                     </form>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>

 

function DoCheckLength(aTextBox) { 

      var i=1; 
      if (aTextBox.maxLength - aTextBox.value.length==0) { 
         //document.theForm.submit(); 
        console.log("chegk");
        i++; 

        $('#description').append('Test');


        $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" autofocus maxlength="13" onkeyup="return(DoCheckLength(this));" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');

        
      } 
    } 


 $(document).ready(function(){  



    window.onkeypress = function(e) {
    if ((e.which || e.keyCode) == 113) {
        alert("fresh");
    }
}
      var i=1;  


      

      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" autofocus maxlength="3" onkeyup="return(DoCheckLength(this));" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#submit').click(function(){            
           $.ajax({ 
           headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
                
                url:"cadastra",  
                method:"POST",  
                data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                     //alert(data);  
                     $('#add_name')[0].reset();  
                }  
           });  
      });  
 });  
 </script>