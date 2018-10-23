<?php

use src\GeoJson;

require '_bootstrap.php';

$geoJsonService = new GeoJson();

$gpx = __DIR__ . '/gpx/poland-2018/full.gpx';

$geoJson = $geoJsonService->convertGpxToGeoJson($gpx, true, true, true);
$geoJson = json_encode($geoJson, JSON_UNESCAPED_UNICODE);
$geoJsonGz = gzencode($geoJson);

$dirPath = __DIR__ . '/output/geojson/poland-2018';
if(!is_dir($dirPath)){
    mkdir($dirPath);
}

file_put_contents($dirPath . '/full.geoJson', $geoJson);
file_put_contents($dirPath . '/full.geoJson.gz', $geoJsonGz);

echo "Job is done\n";
