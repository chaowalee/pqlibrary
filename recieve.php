<?php
$method = $_SERVER["REQUEST_METHOD"];//ประกาศตัวแปร method 
if($method == "POST")//เป็นการเลือกวิธีส่งข้อมูลแบบ post เท่านั้น ถ้าส่งเป็น post ให้ทำตามด้านล่าง
{
	$server = "us-cdbr-iron-east-01.cleardb.net";
    $username = "b21e535520af4b";
    $password = "402bbf1f";
    $db = "heroku_821969a41e3a17e";
    $conn = new mysqli($server, $username, $password, $db);
	mysqli_query($conn, "SET NAMES utf8");// ให้กระทำใน server ที่เก็บตัวแปรconn เป็นภาษาไทยได้ เพราะ utf8
	$doc_no = $_POST["doc_no"];
	$keyword = $_POST["keyword"];// เป็นการเอาตัวแปรใน method post มาใส่ในตัวแปรที่เราต้องการ $keyword
	$type = $_POST["type"];
	$link = $_POST["link"];
	//echo $keyword." ".$type." ".$link;
	$sql = "INSERT INTO librarypq(doc_no,keyword,type,link) VALUES('$doc_no','$keyword','$type','$link')";//ประกาศตัวแปร sql เพื่อดึงข้อมูลที่ตัวแปร  $keyword บรรทัดที่ 12 มาใส่่ใน insert to library
	$result = mysqli_query($conn, $sql) or trigger_error($conn->error."[$sql_insert]");//ประกาศตัวแปร result เพื่อให้ข้อมูลส่งไปที่ server เอาข้อมูลตัว $sql มาใส่
	echo '<script type="text/javascript">';//เป็นการเปิด คำสั่ง javascript
	echo 'window.location.href="Insert.php";'; //เป็น การเรียกหน้าเวปที่เราต้องการมาโชว์หลังการใส่ข้อมูลไปแล้ว
	echo '</script>';//เป็นการปิด คำสั่ง javascript
}
else
{
	echo "Method Not Allow!!!!";
}
?>