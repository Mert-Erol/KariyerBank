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
  	.yeniIlan{
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

        if(isset($_SESSION['firmaIsim'])){
          echo '<li class="nav-item">
                <a class="nav-link" href="cikis.php">Hoşgeldin '.$_SESSION["firmaIsim"].' Çıkış Yap</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="yeniIlan.php">Yeni İlan</a>
                </li>
                <li class="nav-item">
        		<a class="nav-link" href="iletisim.php">İletişim</a>
    	  		</li>
	 		   </ul>
		  	</div>
			</nav>
			<!--/.Navbar -->

			<div class="yeniIlan">
			<form action="" method="post">
			<div class="form-group green-border-focus">
			<label for="exampleFormControlTextarea5">Firma Adı</label>
			<textarea class="form-control" name="firmaAdi" rows="3" disabled>'.$_SESSION["firmaIsim"].'</textarea>
			</div>


			<div class="form-group green-border-focus">
	    	 <label for="exampleFormControlTextarea5">Departman</label>
	    	 <textarea class="form-control" name="departman" rows="3"></textarea>
			</div>

			<div class="form-group">
  			<label for="exampleFormControlTextarea3">İlan Detay</label>
  			<textarea class="form-control" name="ilanDetay" rows="7"></textarea>
			</div>
			<input type="submit" value="Gönder">
			</form>
			</div>
			';
        }
		else{
			echo '</ul>
		  	</div>
			</nav>
			<!--/.Navbar -->
			<p>Sadece firma yetkilileri ilan verebilir...</p>';
			header("Refresh: 3; url=index.php");
		}
	?>

</body>

</html>

<?php 

	if($_POST){

		$departman = $_POST['departman'];
		$ilanDetay = $_POST['ilanDetay'];
		$firmaIsim = $_SESSION['firmaIsim'];

		$kaydet = mysqli_query($db,"insert into ilanlar (f_adi,i_detay,i_departman) values('$firmaIsim','$ilanDetay','$departman')") or die("İlan veritabanına eklenemedi...");

		if($kaydet){
			echo "İlan başarıyla kayıt edildi...";
			header("Refresh: 3; url=index.php");
		}
	}

?>