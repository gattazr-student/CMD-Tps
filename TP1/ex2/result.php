<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>CMD - TP1 : Exercice 2 (Result)</title>
	</head>
    <body>
		<h1>CMD - TP1 : Exercice 2 (Result)</h1>
		<?php
		require_once("calcul.php");
		echo 'SOMME : '.$_POST['somme'].'<br/>';
		echo 'TAUX : '.$_POST['taux'].'<br/>';
		echo 'DUREE : '.$_POST['duree'].'<br/>';
		echo '<br>';
		echo 'Resultat : '.doTheMath($_POST['somme'], $_POST['taux'], $_POST['duree']).'<br/>';
		?>
		<a href='index.html'>Retour à la page Calcul</a>
    </body>
</html>
