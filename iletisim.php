<?php 

  require_once("baglanti.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>İletişim</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">

  <style type="text/css">
  	.iletisim{
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

<!-- Default form contact -->
<div class="iletisim">
<form class="text-center border border-light p-5" method="post" action="">

    <p class="h4 mb-4">Bizimle İletişime Geçin</p>

    <!-- Name -->
    <input type="text" name="isim" class="form-control mb-4" placeholder="Name">

    <!-- Email -->
    <input type="email" name="mail" class="form-control mb-4" placeholder="E-mail">

    <!-- Subject -->
    <label>Konu</label>
    <select class="browser-default custom-select mb-4" name="secenek">
        <option value="" disabled>Size uygun seçeneği seçin</option>
        <option value="1" selected>Geri bildirim</option>
        <option value="2">Hatayı rapor edin</option>
        <option value="3">Eklenmesini istediğiniz özellikler</option>
    </select>

    <!-- Message -->
    <div class="form-group">
        <textarea class="form-control rounded-0" name="mesaj" rows="3" placeholder="Mesajınız"></textarea>
    </div>

    <!-- Send button -->
    <button class="btn btn-info btn-block" type="submit">Gönder</button>

</form>
<!-- Default form contact -->
</div>

</body>

<?php 

  if($_POST){

    $isim = $_POST['isim'];
    $mail = $_POST['mail'];
    $mesaj = $_POST['mesaj'];
    $secenek = $_POST['secenek'];

    if($secenek == 1){
      $secenek = "Geri Bildirim";
    }
    else if($secenek == 2){
      $secenek = "Hatayı Rapor Edin";
    }
    else if($secenek == 3){
      $secenek = "Eklenmesini istediğiniz yeni özellikler";
    }

    $kaydet = mysqli_query($db,"insert into iletisim (iletisim_isim,iletisim_mail,iletisim_mesaj,iletisim_secenek) values('$isim','$mail','$mesaj','$secenek')") or die("Mesajınız veritabanına eklenemedi...");

    if($kaydet){
          echo "Mesajınız veritabanına başarıyla kayıt edildi...";
          header("Refresh: 3; url=index.php");
        }
  }

?>