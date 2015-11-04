<?php
function GET($aUrl){
	// initialisation de la session
	$wSession = curl_init($aUrl);

	// configuration des options
	curl_setopt($wSession, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($wSession, CURLOPT_BINARYTRANSFER, true);

	// exécution de la session
	$wRes = curl_exec($wSession);

	// fermeture de la session
	curl_close($wSession);

	return $wRes;
}
$API_OSM = 'http://api.openstreetmap.org/api/0.6/';
$API_XAPI = 'http://api.openstreetmap.fr/xapi';
$API_OVERPASS = 'http://overpass-turbo.eu/';

$wCall = "map?bbox=5.76721,45.19351,5.76928,45.19425";
$page = GET($API_OSM.$wCall);
echo "<h2>OSM API 0/6</h2>";
echo "<p>$wCall</p>";
echo "<p>".htmlentities($page)."</p>";

$wCall = "?node[bbox=5.76721,45.19351,5.76928,45.19425]";
$page = GET($API_XAPI.$wCall);
echo "<h2>XAPI</h2>";
echo "<p>$wCall</p>";
echo "<p>".htmlentities($page)."</p>";


/* DO POST pour OVERPASS */
// $wCall = "?Q=(node(45.19351,5.76721,45.19425,5.76928);<;);out;";
// $page = GET($API_OVERPASS.$wCall);
// echo "<h2>Overpass API</h2>";
// echo "<p>$wCall</p>";
// echo $page;

?>
