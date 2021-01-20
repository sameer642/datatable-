
<?php
include('dbconfig.php');

$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; 
$columnIndex = $_POST['order'][0]['column'];
$columnName = $_POST['columns'][$columnIndex]['data']; 
$columnSortOrder = $_POST['order'][0]['dir']; 
$searchValue = $_POST['search']['value'];
$searchname = $_POST['columns'][0]['search']['value'];
$searchemail = $_POST['columns'][1]['search']['value'];
$searchaddress = $_POST['columns'][2]['search']['value'];
$searchmobile = $_POST['columns'][3]['search']['value'];
$searchgender = $_POST['columns'][4]['search']['value'];
$searchhobbies = $_POST['columns'][5]['search']['value'];
$searchdate = $_POST['columns'][6]['search']['value'];
$searchimg = $_POST['columns'][7]['search']['value'];


$searchByName = $_POST['searchByName'];
$searchbyemail = $_POST['searchbyemail'];
$searchbyaddress = $_POST['searchbyaddress'];
$searchbymobile = $_POST['searchbymobile'];
$searchByGender = $_POST['searchByGender'];
$searchbydate = $_POST['searchbydate'];




$searchArray = array();

$searchQuery = " ";




if($searchValue != ''){
	$searchQuery = " AND (id LIKE :id or
	                  sname LIKE :sname or
                      semail LIKE :semail or
                      saddress LIKE :saddress or
                      smobile LIKE :smobile or
                      sgender LIKE :sgender or
                      shobbies LIKE :shobbies or
                      sdob LIKE :sdob or
                      simg LIKE :simg)";
    $searchArray = array(
    	     'id' => "%$searchValue%",
             'sname' => "%$searchValue%",
             'semail' => "%$searchValue%",
             'saddress' => "%$searchValue%",
             'smobile' => "%$searchValue%",
             'sgender' => "%$searchValue%",
             'shobbies' => "%$searchValue%",
             'sdob' => "%$searchValue%",
             'simg' => "%$searchValue%"
         );

}


if($searchname != ''){
	$searchQuery = " AND (sname LIKE :sname)"; 
                      
    $searchArray = array(
             'sname' => "%$searchname%"   
         );
}
if($searchemail != ''){
	$searchQuery = " AND(semail LIKE :semail)";

	$searchArray = array(
	             'semail' => "%$searchemail%"
	         );
}
if($searchaddress != ''){
	$searchQuery = " AND(saddress LIKE :saddress)";

	$searchArray = array(
	             'saddress' => "%$searchaddress%"
	         );
}
if($searchmobile != ''){
	$searchQuery = " AND(smobile LIKE :smobile)";

	$searchArray = array(
	             'smobile' => "%$searchmobile%"
	         );
}
if($searchgender != ''){
	$searchQuery = " AND(sgender LIKE :sgender)";

	$searchArray = array(
	             'sgender' => "%$searchgender%"
	         );
}
if($searchhobbies != ''){
	$searchQuery = " AND(shobbies LIKE :shobbies)";

	$searchArray = array(
	             'shobbies' => "%$searchhobbies%"
	         );
}
if($searchdate != ''){
	$searchQuery = " AND(sdob LIKE :sdob)";

	$searchArray = array(
	             'sdob' => "%$searchdate%"
	         );
}
if($searchimg != ''){
	$searchQuery = " AND(simg LIKE :simg)";

	$searchArray = array(
	             'simg' => "%$searchimg%"
	         );
}

if($searchByName != ''){
	$searchQuery = " AND(sname LIKE :sname)";

	$searchArray = array(
	             'sname' => "%$searchByName%"
	         );
}

if($searchbyemail != ''){
	$searchQuery = "AND(semail LIKE :semail)";

	$searchArray = array(
		          'semail' => "%$searchbyemail%"
	);
}
if($searchbyaddress != ''){
	$searchQuery = "AND(saddress LIKE :saddress)";

	$searchArray = array(
		          'saddress' => "%$searchbyaddress%"
	);
}
if($searchbymobile != ''){
	$searchQuery = "AND(smobile LIKE :smobile)";

	$searchArray = array(
		          'smobile' => "%$searchbymobile%"
	);
}
if($searchByGender != ''){
	$searchQuery = "AND(sgender = :sgender)";

	$searchArray = array(
		          'sgender' => "$searchByGender"
	);
}

if($searchbydate != ''){
	$searchQuery = "AND(sdob LIKE :sdob)";

	$searchArray = array(
		          'sdob' => "%$searchbydate%"
	);
}





$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM student");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM student WHERE 1 ".$searchQuery);
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];


$stmt = $conn->prepare("SELECT * FROM student WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");


foreach($searchArray as $key=>$search){
   $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
$stmt->execute();
$stdRecords = $stmt->fetchAll();



$data = array();

	foreach($stdRecords as $row){
		$data[] = array(
			"id"=> $row['id'],
			"sname" => $row['sname'],
			"semail" => $row['semail'],
			"saddress" => $row['saddress'],
			"smobile" => $row['smobile'],
			"sgender" => $row['sgender'],
			"shobbies" => $row['shobbies'],
			"sdob" => $row['sdob'],
/*			"simg" => "<img src='student/".$row['simg']."' width='100' height='100'>",
*/			"update" => '<button type="button" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Update</button>',
			"delete" => '<button type="button" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>'

			          
		);
	}

$response = array(
	"draw" => intval($draw),
	"iTotalRecords" => $totalRecords,
	"iTotalDisplayRecords" => $totalRecordwithFilter,
	"aaData" => $data
);

echo json_encode($response);
?>












