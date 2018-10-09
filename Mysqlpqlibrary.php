<?php
  $server = "us-cdbr-iron-east-01.cleardb.net";
    $username = "b21e535520af4b";
    $password = "402bbf1f";
    $db = "heroku_821969a41e3a17e";
    $conn = new mysqli($server, $username, $password, $db);//ประกาศตัวแปร con เพื่อเชื่อมไปยังฐานข้อมูล เป็นมาตรฐานการเขียนเชื่อมต่อ
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    mysqli_query($conn, "SET NAMES utf8");
	echo "connected !!!!!!"; //ถ้าเชื่อมต่อสำเร็จให้แสดงผล connect
 ?>