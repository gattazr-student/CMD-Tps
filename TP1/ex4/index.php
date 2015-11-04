<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>CMD - TP1 : Exercice 4</title>
	</head>
    <body>
		<h1>CMD - TP1 : Exercice 4</h1>
		<?php
		require_once('curl.php');

		if(isset($_POST['url']) && $_POST['tag']){
			echo '<h2>Result</h2>';
			echo '<p>"'.$_POST['tag'].'" tags :</p>';
			$elements = getTags(getPage($_POST['url']), $_POST['tag']);

			foreach($elements as $element){
				echo '<li>';
				echo $element->nodeValue, PHP_EOL;
				echo '</li>';
			}
			echo '</ul>';
        }
		?>
		<h2>Formulaire</h2>
		<form action='.' method='post'>
            <input type='text' name='url' value='http://www.silecs.info/formations/polytech/tp1.md.html'/><br>
			<input type='text' name='tag' value='h2'/><br>
			<input type='submit' value="Envoyer"/>
        </form>
        <a href='..'>Retour</a>
    </body>
</html>
