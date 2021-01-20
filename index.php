<!DOCTYPE html>
<html>
<head>
	<title>Datatable</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>




</head> 
<body>
<br />  
           <div class="container"  style="width:500px;">  
                  
                <h3 align="">Form</h3><br /> 
                <p><span class="error">* All fields are required</span></p>
                <form method="post" id='form' enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="name">Enter your name</label>
                    <input type="text" name="name" id='searchByName' class="form-control">
                  </div>
                    <div class="form-group">
                        <label for="email">Enter your email</label>
                        <input type="email" name="email" id='searchbyemail' class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Enter your address</label>
                        <input type="text" name="address" id='searchbyaddress' class="form-control">
                        
                    </div>
                    <div class="form-group">
                        <label for="mobile">Enter your mobile</label>
                        <input type="text" name="mobile" id='searchbymobile' class="form-control">
                        
                    </div>
                    <div class="form-group">
                        <label>Gender</label><br>
                        <select id='searchByGender' class="form-control">
                        <option value=''>-- Select Gender--</option>
                        <option value='Male'>Male</option>
                        <option value='Female'>Female</option>
                        <option value="Others">Others</option>
                      </select>

                        
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="date">Enter your Date of birth</label>
                        <input type="date" name="date" id='searchbydate' class="form-control">
                    </div>
                  
                    <input type="submit" name="form" class="btn btn-danger">
                   <input type="reset" name="reset" class="btn btn-primary">

</form>
</div>
</body>
<div class="container-fluid">
<br>
<div align="right">
    <button type="button" id="modal_button" class="btn btn-info">Add Records</button>
    <!-- It will show Modal for Create new Records !-->
   </div>
   <br />
   <div id="result" class="table-responsive"> <!-- Data will load under this tag!-->

   </div>
  </div>
 </body>
</html>

<!-- This is Customer Modal. It will be use for Create new Records and Update Existing Records!-->
<div id="customerModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">Add New Records</h4>
   </div>
   <div class="modal-body">
    <br>      <form method="post" id="submit_form">
                    
                    <label for="name">Enter your name</label>
                    <input type="text" name="name" id='name' class="form-control">
                  
                    
                    
                    <label for="email">Enter your email</label>
                    <input type="email" name="email" id='email' class="form-control">
                     

                     
                    <label for="address">Enter your address</label>
                    <input type="text" name="address" id='address' class="form-control">
                  

                      
                    <label for="mobile">Enter your mobile</label>
                    <input type="text" name="mobile"  id='mobile' class="form-control">
                  

                    
                    <label>Gender</label><br>
                        <select id='gender' name="gender" class="form-control">
                        <option value=''>-- Select Gender--</option>
                        <option value='Male'>Male</option>
                        <option value='Female'>Female</option>
                        <option value="Others">Others</option>
                      </select>
              

      
                    <label for="checkbox">Enter your Hobbie</label><br>
                    <input type="checkbox" name="check1[]" class="hobbie" value="Cricket">Cricket
                    <input type="checkbox" name="check1[]" class="hobbie" value="Football">Football
                    <input type="checkbox" name="check1[]" class="hobbie" value="Carrom">Carrom
                    
             
                  
                    <label for="date">Enter your Date of birth</label>
                    <input type="date" name="date" id='dob' class="form-control">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="action_name" id="action-id" />
                </form>
                 
                        
   </div>
   <div class="modal-footer">
  

    <input type="button" name="action" id="action" class="btn btn-success"  value="Submit" />
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>
<script>
$(document).ready(function(){
 //fetchUser(); //This function will load all data on web page when page load
 //function fetchUser() // This function will fetch data from table and display under <div id="result">
 //{
  var action = "Load";
  $.ajax({
   url : "ajax.php", //Request send to "action.php page"
   method:"POST", //Using of Post method for send data
   data:{action_name:action}, //action variable data has been send to server
   success:function(data){
    $('#result').html(data); //It will display data under div tag with id result
   }
  });
 //}

 //This JQuery code will Reset value of Modal item when modal will load for create new records
 $('#modal_button').click(function(){
  $('#customerModal').modal('show'); //It will load modal on web page
  $('#name').val(''); //This will clear Modal first name textbox
  $('#email').val(''); //This will clear Modal last name textbox
  $('#address').val('');
  $('#mobile').val('');
  $("#gender").val('');
  //$('input[type=checkbox]').prop('checked', false);
  $('.hobbie').prop('checked', false);
  $('#dob').val('');
  $('.modal-title').text("Add New Records"); //It will change Modal title to Create new Records
  $('#action-id').val('Create'); //This will reset Button value to Create
  $('#action').val('Create'); //This will reset Button value to Create
 });

 
 
 
});
</script>
 

 <table id='table' class='table table-bordered table-striped'>

        <thead>
            <tr>
                <th>id</th>
                <th>sname</th>
                <th>semail</th>
                <th>saddress</th>
                <th>smobile</th>
                <th>sgender</th>
                <th>shobbies</th>
                <th>sdob</th>
                <th>Update</th>
                <th>Delete</th>
                
                
            </tr>
        </thead>
        <tfoot>
                <th>id</th>
                <th>sname</th>
                <th>semail</th>
                <th>saddress</th>
                <th>smobile</th>
                <th>sgender</th>
                <th>shobbies</th>
                <th>sdob</th>
                

                

                
          
        </tfoot>
    </table>
</div>

<script type="text/javascript">
  $(document).ready(function(){


    
   var dataTable = $('#table').DataTable({


      'processing': true,
      'serverSide': true,
      'searching': false,
      'serverMethod': 'post',
      'ajax': {
          'url':'student.php',
          'data':function(data){
            var name = $('#searchByName').val();
            var email = $('#searchbyemail').val();
            var address = $('#searchbyaddress').val();
            var mobile = $('#searchbymobile').val();
            var gender = $('#searchByGender').val();
            var date = $('#searchbydate').val();


            
            data.searchByName = name;
            data.searchbyemail = email;
            data.searchbyaddress = address;
            data.searchbymobile = mobile;
            data.searchByGender = gender;
            data.searchbydate = date;
            


          }
      },
      'columnDefs': [ {
        'targets': [8,9],

        'orderable': false
     }],

      'columns': [

         { data: 'id' },
         { data: 'sname' },
         { data: 'semail' },
         { data: 'saddress' },
         { data: 'smobile' },
         { data: 'sgender' },
         { data: 'shobbies' },
         { data: 'sdob'},
         { data: 'update'},
         { data: 'delete'},   

         ]  
   });
   $('#searchByName').keyup(function(){
    dataTable.draw();
   });
   $('#searchbyemail').keyup(function(){
    dataTable.draw();
   });
   $('#searchbyaddress').keyup(function(){
    dataTable.draw();
   });

   $('#searchbymobile').keyup(function(){
    dataTable.draw();
   });

   $('#searchByGender').change(function(){
    dataTable.draw();
  });

   $('#searchbydate').change(function(){
    dataTable.draw();
   });

   $('#action').click(function(){
  var data = $("#submit_form").serialize();

  var id = $('#id').val();
  var name = $('#name').val(); //Get the value of first name textbox.
  var email = $('#email').val(); //Get the value of last name textbox
  var address = $('#address').val();
  var mobile = $('#mobile').val();
  var gender =   $("#gender").val();
  //var hobbies =     $("input[type='checkbox']:checked").val();
  //var hobbies =  $("input[name='check1[]']:checked").val();
  //console.log(hobbies);
  var hobbies =  $(".hobbie:checked").val();

  var dob = $('#dob').val();
  var action = $('#action-id').val();  //Get the value of Modal Action button and stored into action variable
  if(name != '' && email != '' && address != '' && mobile != '' && gender != '' && hobbies != ''&& dob != '') //This condition will check both variable has some value
  {
   $.ajax({
    url : "ajax.php",    //Request send to "action.php page"
    method:"POST",     //Using of Post method for send data
    //data:{name:name, email:email, address:address, mobile:mobile, gender:gender, check1:hobbies, date:dob, id:id, action:action}, //Send data to server
    data: data,
    success:function(data){
     alert(data);    //It will pop up which data it was received from server side
    dataTable.draw();


     $('#customerModal').modal('hide'); //It will hide Customer Modal from webpage.
     /*fetchUser();*/    // Fetch User function has been called and it will load data under divison tag with id result
    }
   });
  }
  else
  {
   alert("All Fields are Required"); //If both or any one of the variable has no value them it will display this message
  }
 });

   $(document).on('click', '.update', function(){

  var id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
  var action = "Select";   //We have define action variable value is equal to select
  $.ajax({
   url:"ajax.php",   //Request send to "action.php page"
   method:"POST",    //Using of Post method for send data
   data:{id:id, action_name:action},//Send data to server
   dataType:"json",   //Here we have define json data type, so server will send data in json format.
   success:function(data){
    $('#customerModal').modal('show');  //It will display modal on webpage
    $('.modal-title').text("Update Records"); //This code will change this class text to Update records
    $('#action-id').val("Update");     //This code will change Button value to Update
    $('#action').val("Update");
    $('#id').val(id);     //It will define value of id variable to this customer id hidden field
    $('#name').val(data.sname);
    $('#email').val(data.semail);
    $('#address').val(data.saddress);
    $('#mobile').val(data.smobile);
    $("#gender").val(data.sgender);
    //$("input[type=checkbox]").prop('checked', false);
    $(".hobbie").prop('checked', false);
    $("input[type=checkbox][value="+data.shobbies+"]").prop('checked', true);
    //$("input[name='check1']:checked").val(data.shobbies);
    $('#dob').val(data.sdob);

   }
  });
 });

   $(document).on('click', '.delete', function(){
   var id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
   if(confirm("Are you sure you want to remove this data?")) //Confim Box if OK then
   {
   var action = "Delete"; //Define action variable value Delete
   $.ajax({
    url:"ajax.php",    //Request send to "action.php page"
    method:"POST",     //Using of Post method for send data
    data:{id:id, action_name:action}, //Data send to server from ajax method
    success:function(data)
    {
/*     fetchUser();    // fetchUser() function has been called and it will load data under divison tag with id result
*/     alert(data);    //It will pop up which data it was received from server side
     dataTable.draw();

    }
   })
  }
  else  //Confim Box if cancel then 
  {
   return false; //No action will perform
  }
 });


});

</script>

</html>







