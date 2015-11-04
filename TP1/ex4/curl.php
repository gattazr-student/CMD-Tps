<?php

function getPage($url){
	// initialisation de la session
	$ch = curl_init($url);

	// configuration des options
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);

	// exécution de la session
	$result = curl_exec($ch);

	// fermeture des ressources
	curl_close($ch);

	return $result;
}

function getTags($html, $tag){
    $dom = new DOMDocument;
    $dom->loadHTML($html);
    return $dom->getElementsByTagName($tag);
}
?>
