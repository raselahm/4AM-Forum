<!DOCTYPE html>
<html lang="en" style="
	background: linear-gradient(-135deg, #f0ffb1, #fdc689);

"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
   <header class = "main-header">

    <a href="../HTML/HomePage.html" class="logo">

        <img src="images/IconCSE4421.svg" width="150" height="75" fill-opacity=".5">

    </a>

    <div class="dropdown">

        <button class = "dropbtn">
            <img src = "images/heisenberg.svg" width = "50" height ="50">
            <a>Username Here</a>
        </button>

        <div class="dropdown-content">
            <a id=view_profile href="../HTML/profile.html">View Profile</a>
            <a href="#">Sign Out</a>
        </div>
    </div>
</header>

	<strong style="
	font-size: -webkit-xxx-large;">English 101
	</strong>
	<div>
        <form action="" method="post">
        <textarea input type="text" name="number1" cols="40" rows="5" style="margin-bottom:10px;width:1200px;height: 150px;border: 4px solid #e0b1b1;margin-top: 15px;background-color: white;"></textarea>

        
        
		<p><input type="submit"/></p>
		<ul class="post-OP">
			<li class="poster">
				<div class="media-body">
					<span class="text-muted pull-right">
						<small class="text-muted">55 min ago</small>
					</span>
					<strong class="text-success">Posted by: <a>
						<a href="will be profile link"> @Rasel Ahmed</strong>
					</a>
			</li>
		</ul>	
	<hr style="margin-top: 0px;">
	</div>
	

</body></html>
<?php
// 1. database credentials
$host = "tethys.cse.buffalo.edu";
$username = "mdrafsan";
$password = "50100208";
$dbname = "cse442_542_2020_spring_teamg_db";
// 2. connect to database
function testdb_connect ($host, $username, $password){
    $dbh = new PDO("mysql:host=$host;dbname=cse442_542_2020_spring_teamg_db", $username, $password);
    return $dbh;
}
try {
    $conn = new mysqli($host, $username, $password, $dbname);
    
    $sql = "SELECT id, subject, content, date FROM POSTS";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table><tr><th></th><th></th></tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["subject"]." - "." ".$row["content"]."</td></tr>";
            $postID = $row["id"];
            echo "<tr><td>"."<button onclick=\"location.href='/expandedPost.php?post_id=$postID'\" type=\"button\">Go To Post</button>"."<hr>"."</td></tr>";
            

        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    
} catch(PDOException $e) {
    echo $e->getMessage();
}

if (isset($_POST['number1'])) {
    $dbh = testdb_connect ($host, $username, $password);
    $description = addslashes ($_POST['number1']);
    $query = "INSERT INTO POSTS ". "(subject,content, date) "."VALUES ". "('->','$description','2014')"; 
    
    $stmt = $dbh->prepare( $query );
    $product_id=1;
    $stmt->bindParam(1, $product_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<meta http-equiv='refresh' content='0'>";
}
?>