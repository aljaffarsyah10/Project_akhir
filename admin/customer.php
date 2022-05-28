<?php 
session_start();
	if (!isset($_SESSION['username'])){
	$_SESSION['bool']="1"; 
	header("Location: temp_login.php"); 
	} 
?>

<!DOCTYPE html> <html lang='en-GB'> 
<head> 
<title>Customer | Admin Page</title> 
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="style2.css">

</head> 
<body id="main"> 
<?php
include 'temp_navbar.php'; 
?>

<div class="laman_article">
<h1>Databases Customer</h1>

<!-- <form action=""> 
		Name: <input type="text" id="txt1" onkeyup="showHint(this.value)"> 
</form> 
<p>Suggestions: <span id="txtHint"></span></p>
 -->

<?php 
$db_hostname = "localhost"; // Write your own db server here 
$db_database = "praktikum"; // Write your own db name here 
$db_username = "root"; // Write your own username here 
$db_password = ""; // Write your own password here 
// For the best practice, don’t use your “real” password when submitting your work 
$db_charset = "utf8mb4"; // Optional 
$dsn = "mysql:host=$db_hostname;dbname=$db_database;charset=$db_charset"; 
$opt = array( 
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
PDO::ATTR_EMULATE_PREPARES => false 
); 
try { 
$pdo = new PDO($dsn,$db_username,$db_password,$opt); 

$stmt = $pdo->query("select * from meetings order by slot asc"); 
?>



<form action="" method="post"  style="text-align: right;">
	<input  class="search" type="text" id="keyword" name="keyword" placeholder="Cari slot/nama/email anggota...">
	<button class="btn-log" type="submit" name="cari">Search</button>
</form>
<br>


<div id="tabel_anggota">

		<?php 
		if(isset($_POST["cari"])){
			$nama = $_POST['keyword'];
			$stmt = $pdo->query("select * from meetings WHERE name LIKE '%$nama%' order by slot asc"); 
		}
		echo "Rows retrieved: ".$stmt->rowcount()."<br><br>\n"; 
		?>
<form method="get" action="addcustomer.php">
  <button class="btn-dark">Tambah</button>
</form>
<br>

		<table>
			<tr>
				<th>Slot</th>
				<th>Name</th>
				<th>Email</th>
				<th colspan="2">Action</th>
			</tr>
			<?php 
				// echo json_encode($stmt)
				foreach($stmt as $row) { 
			?>
			<tr>
				<td><?php echo $row["slot"] ?></td>
				<td><?php echo $row["name"] ?></td> 
				<td><?php echo $row["email"] ?></td>
				<td><a href="updatecustomer.php? slot=<?php echo $row['slot'] ?>"><img src='./icon/edit.png' style='width:30px;height:30px;' alt="Ubah"></a></td>
				<td> <a href="deletecustomer.php? slot=<?php echo $row['slot'] ?>"><img src='./icon/remove.png' style='width:30px;height:30px;' alt="Hapus"></a></td>
			</tr>
			<?php } ?>
		</table>

</div>


<?php
$pdo = NULL; 
} 
catch (PDOException $e) { 
exit("PDO Error: ".$e->getMessage()."<br>"); 
} 
?> 


<script type="text/javascript" src="liveSearchCustomer.js"></script>
<!-- <script src="php11D_suggestion.js"></script> -->

</div>
</body> 
</html>
