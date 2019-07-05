<?php 

	require_once("baglanti.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Üye Ol</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">

  <style type="text/css">
  	.uyelik{
  		width: 60%;
  		margin: auto;
  		margin-top: 50px;
  	}
  </style>
</head>

<body>

  <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>

<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color">
  <a class="navbar-brand" href="index.php">KariyerBank</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="isilanlari.php">İş İlanları
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <?php
        session_start();

        if(isset($_SESSION['isim'])){
          echo '<li class="nav-item">
                <a class="nav-link" href="cikis.php">Hoşgeldin '.$_SESSION["isim"].' Çıkış Yap</a>
                </li>';
        }
        else if(isset($_SESSION['firmaIsim'])){
          echo '<li class="nav-item">
                <a class="nav-link" href="cikis.php">Hoşgeldin '.$_SESSION["firmaIsim"].' Çıkış Yap</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="yeniIlan.php">Yeni İlan</a>
                </li>';
        }
        else{
          echo '<li class="nav-item">
                <a class="nav-link" href="giris.php">Giriş</a>
               </li>
              <li class="nav-item">
              <a class="nav-link" href="uyeol.php">Üye Ol</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="firmaGiris.php">Firma Giriş</a>
               </li>
              <li class="nav-item">
              <a class="nav-link" href="firmaUyeOl.php">Firma Üye Ol</a>
              </li>';
        }
      
      ?>
      
      <li class="nav-item">
        <a class="nav-link" href="iletisim.php">İletişim</a>
      </li>

    </ul>
  </div>
</nav>
<!--/.Navbar -->

<div class="uyelik">
<form action="" method="post">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">İsim</label>
      <input type="text" class="form-control"  placeholder="İsim" name="isim" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Soyisim</label>
      <input type="text" class="form-control" placeholder="Soyisim" name="soyisim" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Şifre</label>
      <input type="text" class="form-control" placeholder="Sifre" name="sifre" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Şifre Tekrar</label>
      <input type="text" class="form-control" placeholder="Sifre Tekrar" name="sifreTekrar" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01">E-Mail</label>
      <input type="text" class="form-control" placeholder="E-Mail" name="mail" required>
    </div>
    
  </div>
  <button class="btn btn-primary btn-sm" type="submit">Kayıt Ol</button>
</form>
</div>

</body>

<?php 

	if($_POST){

		$isim = $_POST["isim"];
		$soyisim = $_POST["soyisim"];
		$mail = $_POST["mail"];
		$sifre = $_POST["sifre"];
		$sifreTekrar = $_POST["sifreTekrar"];

		if($sifre == $sifreTekrar){
			$mailSorgu = mysqli_query($db,"SELECT * FROM calisanlar WHERE c_mail='$mail'");

			if (mysqli_num_rows($mailSorgu)>0) {
				echo "Bu mail adresi ile daha önce kayıt yapılmış..."."<br>";
				header("Refresh: 3; url=uyeol.php");
			}
			else{
				$kaydet = mysqli_query($db,"insert into calisanlar (c_adi,c_soyadi,c_mail,c_sifre) values('$isim','$soyisim','$mail','$sifre')") or die("Çalışan veritabanına eklenemedi...");

				if($kaydet){
					echo "Çalışan veritabanına başarıyla kayıt edildi...";
					header("Refresh: 3; url=index.php");
				}
			}
		}
		else{
			echo "Girilen şifreler aynı olmalı...";
			header("Refresh: 3; url=index.php");
		}

	}


?>



