<?php 
  require_once("baglanti.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>İş İlanları</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">

  <style type="text/css">
  	.isilanlari{
  		width: 20%;
  		float: left;
  		margin-left: 2%;
  		margin-top: 2%;
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


<?php 

  $sorgu = "select * from ilanlar";

  $sonuc = $db->query($sorgu);

  if ($sonuc->num_rows > 0) {
    
        while($row = $sonuc->fetch_assoc()) {
          echo '
            <!-- Card -->
            <div class="isilanlari">
            <div class="card">

            <!-- Card image -->
            <div class="view overlay">
            <img class="card-img-top" src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(67).jpg" alt="Card image cap">
            <a href="#!">
            <div class="mask rgba-white-slight"></div>
            </a>
            </div>

            <!-- Card content -->
            <div class="card-body">

            <!-- Title -->
            <h4 class="card-title">'.$row['f_adi'].'</h4>
            <!-- Subtitle -->
            <h5 class="card-title">'.$row['i_departman'].'</h5>
            <!-- Text -->
            <p class="card-text">'.$row['i_detay'].'</p>
            <!-- Button -->
            <a href="ilanbasvuru.php?ilanId='.$row['i_id'].'&firmaAdi='.$row['f_adi'].'" class="btn btn-primary">Başvur</a>

            </div>

            </div>
            <!-- Card -->
           </div>';
      }
    }

?>



</body>