<!DOCTYPE html>
<html lang="en">
<head>
	<title>4-A.M. - Get your education right!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../CSS/util.css">
	<link rel="stylesheet" type="text/css" href="../CSS/expandedPost.css">
<!--===============================================================================================-->
</head>
<?php include('header.php');?>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                <center>
                    <img src="../images/IconCSE442.png" alt="Girl in a jacket" style="width:30%;">
                </center>
                <span class="login100-form-title">
						Discussion Board 
                </span>
                <div>
                    
                    <p>
                        <?php
// 1. database credentials
$host = "tethys.cse.buffalo.edu";
$username = "mdrafsan";
$password = "50100208";
$dbname = "cse442_542_2020_spring_teamg_db";
// 2. connect to database
try {
    
    $conn = new mysqli($host, $username, $password, $dbname);
    $post_id = $_GET['post_id'];
    $sql = "SELECT id, subject, content, date FROM POSTS where id=$post_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table><tr><th></th><th></th></tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>"." ".""." ".$row["content"]."</td></tr>";
            echo "<tr><td>"."<hr>"."</td></tr>";
            

        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    
} catch(PDOException $e) {
    echo $e->getMessage();
}
?>
                    </p>
                </div>
                
                <form action="" method="post">
                <textarea input type="text" name="number1" cols="40" rows="5" style="margin-bottom:10px;width:700px;height: 150px;border: 4px solid #e0b1b1;margin-top: 15px;background-color: coral;"></textarea>
		        <p><input type="submit"/></p>
			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="../js/main.js"></script>

</body>
</html>
<?php
function testdb_connect ($host, $username, $password){
    $dbh = new PDO("mysql:host=$host;dbname=cse442_542_2020_spring_teamg_db", $username, $password);
    return $dbh;
}
if (isset($_POST['number1'])) {
    $dbh = testdb_connect ($host, $username, $password);
    $description = addslashes ($_POST['number1']);
    $postid = $_GET['post_id'];
    $query = "INSERT INTO comments ". "(post_id,content) "."VALUES ". "('$postid','$description')"; 
    
    $stmt = $dbh->prepare( $query );
    $product_id=1;
    $stmt->bindParam(1, $product_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<meta http-equiv='refresh' content='0'>";
}
    
try {
    $conn = new mysqli($host, $username, $password, $dbname);
    $postid = $_GET['post_id'];
    $sql = "SELECT post_id, content FROM comments WHERE post_id='$postid'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table><tr><th></th><th></th></tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["content"]."</td></tr>";
            $postID = $row["post_id"];
            echo "<tr><td>"."<hr>"."</td></tr>";
        }
        echo "</table>";
    } else {
    }
    
} catch(PDOException $e) {
    echo $e->getMessage();
}
?>