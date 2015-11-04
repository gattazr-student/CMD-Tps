# TP3 - Compte rendu
Ce TP a été effectué par Quentin GERRY et Rémi GATTAZ

## Leaflet, le retour
1.

Pour rajouer un comportement lors d'un clic sur la carte, il faut enregistrer une fonction listener sur l'évènement ``click``. Cela se fait de la façon suivante :
```js
function onMapClick(e) {
    alert("You clicked the map at " + e.latlng);
}

map.on('click', onMapClick);
```

Pour faire apparaitre un popup au cours de cet évènement, voici une façon de procéder :
```js
function onMapClick(e) {
    var popup = L.popup()
    .setLatLng(e.latlng) // Position du popup
    .setContent("Les coordonnées de ce point sont : " + e.latlng) // Conteenu
    .openOn(map);// Carte à laquelle associer le popup
}
```
**2.**

Pour ajouter un zoom définit par deux click sur la carte, voici le code que nous avons alors mis en place dans la fonction lié à l'évènement click.
```js
var point = null;
var layer = L.layerGroup([])
function onMapClick(e) {
    if(point == null){
        point = e.latlng;
        layer.clearLayers();
    }else{
        var bounds = [point, e.latlng];
        layer.addLayer(L.rectangle(bounds, {color: "#ff7800", weight: 1}))
            .addTo(map);
        map.fitBounds(bounds);
        point = null;
    }

    var popup = L.popup()
        .setLatLng(e.latlng)
        .setContent("Les coordonnées de ce point sont : " + e.latlng)
        .openOn(map);
}
```

**3.**

Ajouter un minimap à la carte est très simple. Il suffit de créer une couche pour celle-ci et de la rajouter à la carte.
```js
/* Minimap */
var layerMinimap = new L.TileLayer(urltiles, {attribution: attrib});
var miniMap = new L.Control.MiniMap(layerMinimap).addTo(map);
```

## Mashup

### Exemple simple

**1.**
Voici la carte uMap sur laquelle une couche contenant les antennes de Grenoble ont été ajoutés : http://umap.openstreetmap.fr/fr/map/carte-sans-nom_57492.

**2.**

Pour compter le nombre d'antenne, le CVS semble parfait puisqu'il suffit de compter le nombre de ligne du document. Pour détecter le nombre d'opérateurs, utiliser le CSV est en revanche plus compliqué. En effet, avant de pouvoir traiter les données dans le CSV, il faut écrire un parseur qui va créer des structures d'objets contenant toutes les inforamtions. Mais lorsque la donnée est au format JSON, ce parseur existe déja. Utiliser ce type de donnée est donc plus simple.

3.

Ajouter toutes les antennes à une carte Leaflet se fait de la façon suivante :
```js
var antennes = {...<donnée_geoJson>...};
/* Antennes de Grenoble */
L.geoJson(antennes)
    .addTo(map);
```

Le script suivant permet de récupérer au format geojson toutes les antennes de Grenoble et de créer pour chaque opérateur un fichier text.
```php
<?php
// Read the antenne.geojson file
$wGeoJSON_text = file_get_contents("antennes.geojson");
// decode the file
$wGesoJSON = json_decode($wGeoJSON_text);

$wOperateurs; // Tableau associatif de tableau
/*
* Les clés de ce tableau sont les opérateurs.
* Les valeurs des tableaux contenants toutes les antennes
*/
foreach($wGesoJSON->features as $wFeature){
    $wKey = $wFeature->properties->OPERATEUR; // Récupère la clé
    $wOperateurs[$wKey][] = $wFeature; // Ajoute l'antenne en dernier élément du bon tableau
}

foreach($wOperateurs as $wOperateur => $wFeatures){
    /* Création d'un fichier pour chaque élément du tableau associatif */
    $wJSON =
    "{
        \"name\":\"DSPE_ANT_GSM_EPSG4326\", \"type\":\"FeatureCollection\"
        ,\"features\":".json_encode($wFeatures)."
    }";
    file_put_contents("antenne_$wOperateur.json", $wJSON);
}
?>
```

Ajouter toutes les antennes sur des couches spécifique peut alors se faire avec un traitement javascript simple. Nous ne l'avons donc pas fait pour passer aux question suivantes.

### Exemple plus complet

Nous n'avons pas eu le temps de traiter cette partie.

## Analyse statistique

Tout d'abord, voici le code utiliser pour effectuer les requetes GET et POST.
```php
<?php
function GET($aUrl){
	// initialisation de la session
	$wSession = curl_init($aUrl);

	// configuration des options
	curl_setopt($wSession, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($wSession, CURLOPT_BINARYTRANSFER, true);

	// exÃ©cution de la session
	$wRes = curl_exec($wSession);

	// fermeture de la session
	curl_close($wSession);

	return $wRes;
}
function POST($aUrl, $aPostParams){
    // TODO: make function
}
?>
```
**1.**

Voici alors différents appels utilisé pour récupérer des cartes à patir de l'API.
```php
<?php
$API_OSM = 'http://api.openstreetmap.org/api/0.6/';
$API_XAPI = 'http://api.openstreetmap.fr/xapi';
$API_OVERPASS = 'http://overpass-turbo.eu/';

/* Open street map */
$API_OSM = 'http://api.openstreetmap.org/api/0.6/';
$wCall = "map?bbox=5.76721,45.19351,5.76928,45.19425";
$wData = GET($API_OSM.$wCall);


$API_XAPI = 'http://api.openstreetmap.fr/xapi';
$wCall2 = "?node[bbox=5.76721,45.19351,5.76928,45.19425]";
$wData2 = GET($API_XAPI.$wCall2);

// TODO: appel POST pour overpast
/* OverPass */
$API_OVERPASS = 'http://overpass-turbo.eu/';
// $wPostParams[];
// $wData3 = ¨POST($API_OVERPASS, $wPostParams);
?>
```

Nous n'avons pas eu le temps de traiter la fin de cette partie.
