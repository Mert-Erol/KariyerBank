<?php 

	require_once("baglanti.php");

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Firma Giriş</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">

  <style type="text/css">
  	.giris{
  		width: 50%;
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


  <!-- Default form login -->
<div class="giris">
<form class="text-center border border-light p-5" method="POST" action="">

    <p class="h4 mb-4">Giriş Yap</p>

    <!-- İsim -->
    <input type="text" name="isim" class="form-control mb-4" placeholder="Firma Adı">

    <!-- Password -->
    <input type="password" name="sifre" class="form-control mb-4" placeholder="Şifre">

    <!-- Sign in button -->
    <button class="btn btn-info btn-block my-4" type="submit">Giriş Yap</button>

    <!-- Register -->
    <p>Üye Değil Misin?
        <a href="firmaUyeol.php">Üye Ol</a>
    </p>

</form>
<!-- Default form login -->
</div>

</body>

<?php 

	if($_POST){

	$isim = $_POST["isim"];
	$sifre = $_POST["sifre"];

	$sorgu = "select * from firmalar where f_adi = '$isim'";

	$sonuc = $db->query($sorgu);

	if ($sonuc->num_rows > 0) {
    
        while($row = $sonuc->fetch_assoc()) {
        	if($sifre == $row["f_sifre"]){
        		echo "Başarıyla giriş yaptınız...";
        		
            
        		$_SESSION["firmaIsim"] = $isim;

        		header("Refresh: 3; url=index.php");
        	}
          else{
            echo "Hatalı şifre...";
          }
    	}
    }
    else{
    	echo "Hatalı giriş...";
    }
}
?>