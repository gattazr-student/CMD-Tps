# TP2 - Compte rendu
Ce TP a été effectué par Quentin GERRY et Rémi GATTAZ

## OpenStreetMap
- Contributions sous le nom gattazr
- 4 modifications :
    - Ajout d'une route secondaire (Beaulieu, 34 160)
    - Ajout de deux routes tertiaires (Beaulieu, 34 160)
    - Suppressions d'un batiment inexistant (Monbonnot, 38 330)

## Umap

La carte créé : http://u.osmfr.org/m/55836/<br>
Lien d'édition : http://umap.openstreetmap.fr/fr/map/anonymous-edit/55836%3Aq3DxC8npG24OoIpdYuYJNhO_OgA


## Overpass

**1.**
```js
(
way["name"="F (UFR IM2AG)"];
node(around:250) ["emergency"="fire_hydrant"];
);

// print results
out body;
>;
out skel qt;
```
Cette query permet d'afficher la position des bornes à incendie dans un rayon de 250m autour du batiment F de l'imag. Le mot clé "way" permet de réduire le champ de recherche de façon significative et donc d'améliorer les performances de la requete qui avait été proposé par le générateur.

**2.**
```js
(
way["name"="F (UFR IM2AG)"];
node(around:0) ["entrance"];
);

// print results
out body;
>;
out skel qt;
```

Avec cette requete, ce sont les entrées du batiment qui sont placé sur la carte. En utilisant la distance de 0, nous pouvons afficher les entrés qui sont connectées directement au batiment.

**3.**
En utlisant les propriétés du calque, il est possible de profiter de l'héritage. En modifiant les paramètres d'affichage des marqueurs du calce, nous avon pu modifier la façon dont sont affichés les marqueurs sans devoir le spécifier manuellement pour chaque marqueur.

Il serait intéressant de pouvoir visualiser l'emplacement des extincteurs au sein du batiments. Ces données ne sont malheuresement pas encore dans OpenStreetMap.

## Leaflet

**1.**
Le nombre de tuiles affiché varie selon la taille de la fenêtre puisque les tuilles ont une taille fixe  256*256 pixels. Puisque mon écran est en 1080p, il doit y avoir 8 tuilles sur la largeur. Puisqu'il y a problement 2 tuiles de hauteurs, il doit y avoir 16 tuiles à l'écran.

Cette estimation s'est vérifié par l'expérimentation.

**2.**
On modifie la taille de la division contenant la carte.
```css
#map {
    width: 1280px;
    height: 1024px;
}
```
On peut prévoir le nombre de tuiles affichés en faisant le même calcul que précedemment.

Dans une division de 1280*1024 pixels, il y aura 5 colonnes et 4 lignes. Il y aura donc 20 tuiles à l'écran.

**3.**
Nous avons ajouté à la carte un marqueur, un chemin ainsi que deux zones d'influences. La première est spécifié avec un cercle, la second avec un marqueur de type cercle. Voici le code que nous avons écrit :

```html
<script>
var urltiles = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
var attrib = '&copy; contributeurs <a href="http://osm.org/copyright">OpenStreetMap</a>';

// ajouter une carte dans la div "map" et fixer le centre et le zoom
var map = L.map('map').setView([45.19387, 5.76846], 18);

// Ajout d'un marker
L.marker([45.19383, 5.76826]).addTo(map);

// Ajout d'une zone d'influence (un cercle)
var influArea = L.circle([45.184359,5.753295],300, {
    color : 'red',
    fillColor : '#f03',
    fillOpacity : 0.5
}).addTo(map);

// Ajout d'une Marker cercle
var circleBerlioz = L.circleMarker([45.191117,5.758690],20, {
    color : '#DDA0DD',
    fillColor : '#f03',
    fillOpacity : 0.5
}).addTo(map);

// Création et ajout d'une chemin
var latlngs = [L.latLng(45.19393,5.76826),L.latLng(45.191117,5.758690),L.latLng(45.184308,5.753764)];
var line = L.polyline(latlngs,{color:'blue'}).addTo(map);

// Ajout d'une couche tuiles OpenStreetMap
L.tileLayer(urltiles, {
    attribution: attrib}
).addTo(map);
</script>
```

La zone d'influence apparait plus grand sur l'écran que le cercle de berlioz lorsque le zoom est fort. On observe l'inverse lorsque le zoom est faible. Cela est du à la difference au niveau de la representation des mesures. La zone d'influence est en mêtres. Sa taille va donc varier en fonction du zoom sur la carte afin d'être correcte. Le cercle de berlioz est quand à lui en pixel. Cela restera donc toujours 20px quelque soit le zoom.

Si l'on veux une mesure précise cartographiquement, il faut utiliser les mêtres. Si le but est de voir le point quelque soit le zoom, il vaut mieux utiliser les pixels.
