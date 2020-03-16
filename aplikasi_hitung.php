<?php include('config.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>kalkulator</title>
	<link rel="stylesheet" href="bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
	crossorigin="anonymous">
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
elseif($hasil > 20){
	$keterangan = "C";
}
elseif($hasil < 0){
	$keterangan = "D";
}

/* $cek = mysqli_query($koneksi, "SELECT * FROM ngitung WHERE
id='$id'") or die(mysqli_error($koneksi));*/

$sql = mysqli_query($koneksi, "INSERT INTO ngitung (bil1, bil2, hasil, keterangan) VALUES ('$bil1', '$bil2', '$hasil', '$keterangan')") 
or die(mysqli_error($koneksi));
if($sql){
echo '<script>alert("Berhasil menambahkan data.");</script>';
}
else{
echo '<div class="alert alert-warning">Gagal melakukan
proses tambah data.</div>';
}
}


?>

<?php
if(isset($_POST['hitungruntun'])){
	
$bil1 = $_POST['bil1'];
$bil2 = $_POST['bil2'];
for($i=1; $i<=10; $i++) {
	$hasil = $bil1+$bil2;

// $hasil = $_GET['hasil'];

if($hasil >= 0 && $hasil <= 10){
	$keterangan = "A";
}
elseif($hasil > 10 && $hasil <= 20){		
	$keterangan = "B";
}
elseif($hasil > 20){
	$keterangan = "C";
}
elseif($hasil < 0){
	$keterangan = "D";
}

/* $cek = mysqli_query($koneksi, "SELECT * FROM ngitung WHERE
id='$id'") or die(mysqli_error($koneksi));*/

$sql = mysqli_query($koneksi, "INSERT INTO hitungruntun (bil1, bil2, hasil, keterangan) VALUES ('$bil1', '$bil2', '$hasil', '$keterangan')") 
or die(mysqli_error($koneksi));

$bil1 = $bil2;
$bil2 = $hasil;
}

if($sql){
echo '<script>alert("Berhasil menambahkan data.");</script>';
}
else{
echo '<div class="alert alert-warning">Gagal melakukan
proses tambah data.</div>';
}
}


?>


<!--	?php 
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
		elseif($hasil > 20){
			$keterangan = "C";
		}
		elseif($hasil < 0){
			$keterangan = "D";
		}
		$operasi = $_POST['operasi'];
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
			break;		
		}	
	?> -->


	<div class="kalkulator">
		<h2 class="judul">PENJUMLAHAN</h2>
		<form method="post" action="aplikasi_hitung.php">			
			<input type="text" name="bil1" class="bil" autocomplete="off" placeholder="Masukkan Bilangan Pertama">
			<input type="text" name="bil2" class="bil" autocomplete="off" placeholder="Masukkan Bilangan Kedua">
			<select class="bil" name="">
				<option value="tambah">+</option>
			<!--	<option value="kurang">-</option>
				<option value="kali">x</option>
				<option value="bagi">/</option> -->
			</select>
			<br>
			<input type="submit" name="hitung" value="Hitung" class="tombol">
			<input type="submit" name="hitungruntun" value="Hitung Runtun" class="tombol">												
		</form>
		<?php if(isset($_POST['hitung'])){ ?>
			<input type="text" name="hitung" value="<?php echo $hasil; ?>" class="bil">
			<input type="text" name="hitung" value="<?php if($hasil >= 0 && $hasil <= 10){echo "anda mendapat A";}
		elseif($hasil > 10 && $hasil <= 20){echo "anda mendapat B";}
		elseif($hasil > 20){echo "anda mendapat C";}
		elseif($hasil < 0){echo "anda mendapat D";} ?>" class="bil"><?php }
			
			else{ ?>
			<input type="text" value="" class="bil">
		<?php } ?>

	</div>
<div>
	<h2 align="center">Data Hitung</h2>
<hr>
<table class="table table-striped table-hover table-sm table-bordered">
<thead class="thead-dark">
<tr>
<th>ID</th>
<th>Bilangan 1</th>
<th>Bilangan 2</th>
<th>Hasil</th>
<th>Keterangan</th>
</tr>
</thead>

<tbody>
<?php
//query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
$sql = mysqli_query($koneksi, "SELECT id, bil1, bil2, hasil, keterangan
FROM ngitung ") or die(mysqli_error($koneksi));
//jika query diatas menghasilkan nilai > 0 maka menjalankan script dibawah if...
if(mysqli_num_rows($sql) > 0){
//membuat variabel $no untuk menyimpan nomor urut
$no = 1;
//melakukan perulangan while dengan dari dari query $sql
while($data = mysqli_fetch_assoc($sql)){
//menampilkan data perulangan
echo '
<tr>
<td>'.$no.'</td>
<td>'.$data['bil1'].'</td>
<td>'.$data['bil2'].'</td>
<td>'.$data['hasil'].'</td>
<td>'.$data['keterangan'].'</td>
</tr>
';
$no++;
}
//jika query menghasilkan nilai 0
}else{
echo '
<tr>
<td colspan="6">Tidak ada data.</td>
</tr>
';
}
?>
<tbody>
</table>
</div>
<br>
<div>
	<h2 align="center">Data Hitung Runtun</h2>
<hr>
<table class="table table-striped table-hover table-sm table-bordered">
<thead class="thead-dark">
<tr>
<th>ID</th>
<th>Bilangan 1</th>
<th>Bilangan 2</th>
<th>Hasil</th>
<th>Keterangan</th>
</tr>
</thead>

<tbody>
<?php
//query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
$sql = mysqli_query($koneksi, "SELECT id, bil1, bil2, hasil, keterangan
FROM hitungruntun ") or die(mysqli_error($koneksi));
//jika query diatas menghasilkan nilai > 0 maka menjalankan script dibawah if...
if(mysqli_num_rows($sql) > 0){
//membuat variabel $no untuk menyimpan nomor urut
$no = 1;
//melakukan perulangan while dengan dari dari query $sql
while($data = mysqli_fetch_assoc($sql)){
//menampilkan data perulangan
echo '
<tr>
<td>'.$no.'</td>
<td>'.$data['bil1'].'</td>
<td>'.$data['bil2'].'</td>
<td>'.$data['hasil'].'</td>
<td>'.$data['keterangan'].'</td>
</tr>
';
$no++;
}
//jika query menghasilkan nilai 0
}else{
echo '
<tr>
<td colspan="6">Tidak ada data.</td>
</tr>
';
}
?>
<tbody>
</table>
<form method="get" action="">
<input type="submit" name="hapus" value="Hapus" class="tombol">
</form>
<?php
if(isset($_GET['hapus'])) {
	$sql = mysqli_query($koneksi, "DELETE FROM hitungruntun");
	if($sql){
		echo '<script>alert("berhasil hapus data."); document.location="aplikasi_hitung.php"; </script>';
	}
	else{
		echo '<div class="alert alert-warning">Gagal melakukan proses hapus data.</div>';
	}
}
?>
</div>

</body>
</html>