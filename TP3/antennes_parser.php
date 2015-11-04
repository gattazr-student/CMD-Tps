<?php

$wGeoJSON_text = file_get_contents("antennes.geojson");

$wGesoJSON = json_decode($wGeoJSON_text);

$wOperateurs;
foreach($wGesoJSON->features as $wFeature){
    $wKey = $wFeature->properties->OPERATEUR;
    $wOperateurs[$wKey][] = $wFeature;
}


foreach($wOperateurs as $wOperateur => $wFeatures){
    $wJSON =
    "{
        \"name\":\"DSPE_ANT_GSM_EPSG4326\", \"type\":\"FeatureCollection\"
        ,\"features\":".json_encode($wFeatures)."
    }";
    file_put_contents("antennes_$wOperateur.json", $wJSON);
}
?>
