
<?php 

	require_once("baglanti.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Firma Üye Ol</title>
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
      <label for="validationDefault01">Firma Adı</label>
      <input type="text" class="form-control"  placeholder="Firma Adı" name="firmaAdi" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Firma Sektör</label>
      <input type="text" class="form-control" placeholder="Firma Sektör" name="firmaSektor" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Şifre</label>
      <input type="text" class="form-control" placeholder="Sifre" name="firmaSifre" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Şifre Tekrar</label>
      <input type="text" class="form-control" placeholder="Sifre Tekrar" name="firmaSifreTekrar" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Firma Hakkında</label>
      <input type="text" class="form-control" placeholder="Firma Hakkında" name="firmaHakkinda" required>
    </div>
    
  </div>
  <button class="btn btn-primary btn-sm" type="submit">Kayıt Ol</button>
</form>
</div>

</body>

<?php 

	if($_POST){

		$firmaAdi = $_POST["firmaAdi"];
		$firmaSektor = $_POST["firmaSektor"];
		$firmaHakkinda = $_POST["firmaHakkinda"];
		$sifre = $_POST["firmaSifre"];
		$sifreTekrar = $_POST["firmaSifreTekrar"];

		if($sifre == $sifreTekrar){
			$isimSorgu = mysqli_query($db,"SELECT * FROM firmalar WHERE f_adi='$firmaAdi'");

			if (mysqli_num_rows($isimSorgu)>0) {
				echo "Bu firma daha önce kayıt yapmış..."."<br>";
				header("Refresh: 3; url=firmaUyeol.php");
			}
			else{
				$kaydet = mysqli_query($db,"INSERT INTO firmalar (f_adi, f_sifre, f_sektor, f_hakkinda) VALUES ('$firmaAdi', '$sifre', '$firmaSektor', '$firmaHakkinda')") or die("Firma veritabanına kaydedilemedi...");

				if($kaydet){
					echo "Firma veritabanına başarıyla kayıt edildi...";
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



