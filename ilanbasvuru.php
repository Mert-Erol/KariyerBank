<?php 

	require_once("baglanti.php");
	session_start();
	$id = $_GET['ilanId'];
	$firmaAdi = $_GET['firmaAdi'];
	

	if(isset($_SESSION['isim'])){
		$kadi = $_SESSION['isim'];

		$sorgu = "select * from basvurular where k_adi = '$kadi' && i_id = '$id'";

		$sonuc = $db->query($sorgu);

		if ($sonuc->num_rows > 0) {
			echo "Bu ilana daha önce başvuru yapmışsınız...";
			header("Refresh:3 ; url=index.php");
		}
		else{
			$kaydet = mysqli_query($db,"insert into basvurular(i_id,f_adi,k_adi) values ('$id','$firmaAdi','$kadi')") or die("Başvurunuz veritabanına kaydedilemedi...");

		if($kaydet){
			echo "Başvurunuz alınmıştır...";
			header("Refresh: 3; url=index.php");
		}
		}

		
	}
	else if(isset($_SESSION['firmaIsim'])){
		echo "İş ilanlarına firmalar başvuramaz...";
		header("Refresh: 3; url=index.php");
	}
	else{
		echo "Başvuru yapabilmek için önce giriş yapmalısınız...";
		header("Refresh: 3; url=index.php");
	}

?>