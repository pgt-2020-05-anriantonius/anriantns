<?php include('config.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>kalkulator</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
if(isset($_POST['hitung'])){
	
$bil1 = $_POST['bil1'];
$bil2 = $_POST['bil2'];
$hasil = $bil1+$bil2;
// $hasil = $_GET['hasil'];

if($hasil >= 0 && $hasil <= 10){
	$keterangan = "A";
}
elseif($hasil > 10 && $hasil <= 20){
	$keterangan = "B";
}
elseif($hasil > 20 && $hasil <= 30){
	$keterangan = "C";
}
elseif($hasil > 30 && $hasil <= 40){
	$keterangan = "D";
}
elseif($hasil > 40 && $hasil <= 50){
	$keterangan = "E";
}

/* $cek = mysqli_query($koneksi, "SELECT * FROM ngitung WHERE
id='$id'") or die(mysqli_error($koneksi));*/

$sql = mysqli_query($koneksi, "INSERT INTO ngitung (bil1, bil2, hasil, keterangan) VALUES ('$bil1', '$bil2', '$hasil', '$keterangan')") 
or die(mysqli_error($koneksi));
if($sql){
echo '<script>alert("Berhasil menambahkan data.");
document.location="aplikasi_hitung.php";</script>';
}
else{
echo '<div class="alert alert-warning">Gagal melakukan
proses tambah data.</div>';
}
}


?>
	<?php 
	if(isset($_POST['hitung'])){
		$bil1 = $_POST['bil1'];
		$bil2 = $_POST['bil2'];
		$hasil = $bil1+$bil2;

		if($hasil >= 0 && $hasil <= 10){
			$keterangan = "A";
		}
		elseif($hasil > 10 && $hasil <= 20){		
			$keterangan = "B";
		}
		elseif($hasil > 20 && $hasil <= 30){
			$keterangan = "C";
		}
		elseif($hasil > 30 && $hasil <= 40){
			$keterangan = "D";
		}
		elseif($hasil > 40 && $hasil <= 50){
			$keterangan = "E";
		}
/*		$operasi = $_POST['operasi'];
		switch ($operasi) {
			case 'tambah':
				$hasil = $bil1+$bil2;
			break;
			case 'kurang':
				$hasil = $bil1-$bil2;
			break;
			case 'kali':
				$hasil = $bil1*$bil2;
			break;
			case 'bagi':
				$hasil = $bil1/$bil2;
			break;		*/
		}


		

	
	?>
	<div class="kalkulator">
		<h2 class="judul">PENJUMLAHAN</h2>
		<form method="post" action="aplikasi_hitung.php">			
			<input type="text" name="bil1" class="bil" autocomplete="off" placeholder="Masukkan Bilangan Pertama">
			<input type="text" name="bil2" class="bil" autocomplete="off" placeholder="Masukkan Bilangan Kedua">
			<select class="opt" name="">
				<option value="tambah">+</option>
			<!--	<option value="kurang">-</option>
				<option value="kali">x</option>
				<option value="bagi">/</option> -->
			</select>
			<input type="submit" name="hitung" value="Hitung" class="tombol">											
		</form>
		<?php if(isset($_POST['hitung'])){ ?>
			<input type="text" name="hitung" value="<?php echo $hasil; ?>" class="bil">
			<input type="text" name="hitung" value="<?php if($hasil >= 0 && $hasil <= 10){echo "anda mendapat A";}
		elseif($hasil > 10 && $hasil <= 20){echo "anda mendapat B";}
		elseif($hasil > 20 && $hasil <= 30){echo "anda mendapat C";}
		elseif($hasil > 30 && $hasil <= 40){echo "anda mendapat D";}
		elseif($hasil > 40 && $hasil <= 50){echo "anda mendapat E";} ?>" class="bil"><?php }
			
			else{ ?>
			<input type="text" value="" class="bil">
		<?php } ?>

	</div>
</body>
</html>