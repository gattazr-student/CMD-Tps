<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>CMD - TP1 : Exercice 3</title>
		<style>
		td{text-align:center;}
		</style>
	</head>
    <body>
		<h1>CMD - TP1 : Exercice 3</h1>
		<?php
		if(isset($_GET['words'])){
			require_once('libunicodega.php');
            echo '<h2>Resultat</h2>';
			$array = explode(' ', $_GET['words']);
			echo '<ul>';
			foreach($array as $ligne){
				echo '<li>';
				echo unidecode_char($ligne[0]);
				echo '</li>';
			}
			echo '</ul>';


			echo '<table>';
			echo '<tr>';
			echo '<th>Prefix</th>';
			for($i = 0; $i < 16; $i++){
				echo '<th>'.dechex($i).'</th>';
			}
			echo '</tr>';
			foreach($array as $ligne){
				echo '<tr>';
				$code_prefix = substr(uni_ord($ligne[0]), 0, -1);
				$code_int = substr($code_prefix, -3);

				echo '<td>'.$code_prefix.'</td>';
				for($i = 0; $i < 16; $i++){
					$hex = $code_int.dechex($i);
					$char = utf8_chr($hex);
					$urls = reference_url($hex);
					// echo '<td><a href='.$urls['charbase'].'>'.$char.'</a></td>';
					echo '<td>';
					echo $char.'<br/>';
					echo '<span style="font-size:10px"><a href='.$urls['charbase'].'>U+'.$hex.'</a></span>';
					echo '</td>';
				}
				echo '</tr>';
			}
			echo '</table>';

        }
		?>
		<h2>Formulaire</h2>
		<form action='.' >
            <textarea name='words'>Deux mots</textarea><br/>
			<input type='submit' value="Envoyer"/>
        </form>
        <a href='..'>Retour</a>
    </body>
</html>
