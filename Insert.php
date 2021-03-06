<html>
	<head>
	<title>PQ PEAS1</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0," charset="utf-8">
		<title>PQ PEAS1</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Mali" rel="stylesheet">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
		<style type="text/css">
			.row-center
			{
				text-align:center;<!การสั่งให้ตัวแปร row-center มีข้อความข้างในอยู่กลางคอลัมน์>
			}
			body 
			{
				font-family: 'Mali', cursive;
			}
		</style>
		<?php
			$server = "us-cdbr-iron-east-01.cleardb.net";
			$username = "b21e535520af4b";
			$password = "402bbf1f";
			$db = "heroku_821969a41e3a17e";
			$conn = new mysqli($server, $username, $password, $db);
			mysqli_query($conn, "SET NAMES utf8");
		?>
	</head>
		<body>
			<div class ="container-fluid" style="background-color:purple;"><!container มันคือพารากราฟใน 1 กล่อง สามารถแบ่งแถวและคอลัมน์ได้>
				<div class="row row-center"><!เป็นคำสั่งของแถวแต่ละแถว ถ้าอยากเพิ่มแถวใช้บรรทัดที่ 16-18>
					<div class="col-lg-4 offset-lg-4" style="background-color:pink;"><!เป็นการแบ่งคอลัมน์ในแต่ละแถว>
						<h4>Data Record</h4>
					</div>
				</div>
			</div>
			<div class ="container"><!container ไม่มีคำว่า fluid คือสีจะไม่เต็ม row>
				<div class="row">
					<div class="col-lg-2" style="background-color:white;"><! lg คือ bootstrap ที่ใช้กับ laptop แต่ถ้าจะเขียน app ในมือถือ ใช้ xs>
						<form action="recieve.php" method="post"><!เป็นการเลือกให้ action สิ่งที่พิมพ์ในช่องว่างไปยัง recieve.php>
						<div class="row">
							<label for="name">Doc_no :</label>
							<input class="form-control" type="text" name="doc_no"  >
						</div>
						<div class="row">
							<label for="name">Category :</label>
							<input class="form-control" type="text" name="keyword"  >
						</div>
						<div class="row">
							<label for="name">Type :</label>
							<input class="form-control" type="text" name="type"  >
						</div>
						<div class="row">
							<label for="name">Link :</label>
							<input class="form-control" type="text" name="link"  >
						</div>
						<div class="mt-2 row"><! mt-2 คือ margin top เป็นการเว้นช่องด้านบน ได้มากสุด 5 >
							<input class="btn btn-success btn-block" type="submit" value="SAVE"><!btn success คือ code แสดงปุ่มกดสีเขียว ส่วน btn block คือช่องกดเต็มคอลัมน์ >
						</div>
						</form>
					</div>
					<div class="col-lg-10" style="background-color:white;">
						<div class="table-responsive"><!เป็นรุปแบบตารางในเวป w3>
						<table class="table">
							<thead>
								<tr>
									<th>Doc_no</th>
									<th>Category</th> <!หัวตาราง>
									<th>Type</th>
									<th>Link</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$sql = "SELECT * FROM librarypq";
									$query = mysqli_query($conn,$sql);
									while($obj = mysqli_fetch_array($query))
									{
										echo "<tr>";
										echo "<td>".$obj["doc_no"]."</td>";
										echo "<td>".$obj["keyword"]."</td>";
										echo "<td>".$obj["type"]."</td>";
										echo "<td>".$obj["link"]."</td>";
										echo "</tr>";
									}
								?>
							</tbody>
						</table>
					</div>
					</div>
				</div>
			</div>
		</body>
</html>