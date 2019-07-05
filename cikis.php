<?php 

	session_start();
	session_destroy();

	echo "Başarıyla çıkış yapıldı ana sayfaya yönlendiriliyorsunuz...";
	header("Refresh: 3; url=index.php");

?>