 <?php
include('dbconfig.php');

if(isset($_POST["action_name"]))
{
 
 if($_POST["action_name"] == "Create")
 {
  $sql = "INSERT INTO student(sname, semail, saddress, smobile, sgender,shobbies,sdob)values(:sname, :semail, :saddress, :smobile, :sgender, :shobbies, :sdob)";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([
      ':sname'=> $_POST['name'],
      ':semail' => $_POST['email'],
      ':saddress' => $_POST['address'],
      ':smobile' => $_POST['mobile'],
      ':sgender'=> (isset($_POST['gender'])) ? $_POST['gender']:"",
      ':shobbies' => (isset($_POST['check1'][0])) ? $_POST['check1'][0]: "",
      ':sdob' => $_POST['date']
    ]);


    if(!empty($result))
    {
                                
        echo ("Succesfully Registered");
    }
    
    else{
      echo ('Error record not inserted successfully');

     }
 }
}
if($_POST["action_name"] == "Select")
 {

  $userid = intval($_POST['id']);
  $sql = "SELECT sname, semail, saddress, smobile, sgender, shobbies, sdob,  id from student where id = :id";
  $stmt = $conn->prepare($sql);
  $result = $stmt->execute([
    ':id' => $userid
  ]);
  $result = $stmt->fetch();
    
  echo json_encode($result);
 }

 if($_POST["action_name"] == "Update")
 { 
  $userid = intval($_POST['id']);
  $fname = $_POST['name'];
  $emailid = $_POST['email'];
  $address= $_POST['address'];
  $mobile= $_POST['mobile'];
  $gender= $_POST['gender'];

  $hobbies = implode(',', $_POST['check1']);
  //print_r($hobbies);
  $date= $_POST['date'];
  $sql = "UPDATE student set sname = :name, semail = :email, saddress = :address, smobile = :mobile, sgender = :gender, shobbies = :hobbies, sdob = :dob where id = :id";
  $stmt = $conn->prepare($sql);
  $result =$stmt->execute([
        ':name' => $fname, 
        ':email' => $emailid,
        ':address' => $address,
        ':mobile' => $mobile,
        ':gender' => $gender,
        ':hobbies' => $hobbies,
        ':dob' => $date,
        ':id' => $userid
   ]
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }


if($_POST["action_name"] == "Delete")
 {
  $statement = $conn->prepare(
   "DELETE FROM student WHERE id = :id"
  );
  $result = $statement->execute(
   array(
    ':id' => $_POST["id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Deleted';
  }
 }


 

?>
 