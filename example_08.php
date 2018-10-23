<?php

use src\GeoJson;
use src\TrackPoints;

require '_bootstrap.php';

$geoJsonService = new GeoJson();
$trackpointsService = new TrackPoints();

// gpx to geojson
$gpx = __DIR__ . '/gpx/poland-2018/full.gpx';

$geoJson = $geoJsonService->convertGpxToGeoJson($gpx, true, true, false);
$geoJson = json_encode($geoJson, JSON_UNESCAPED_UNICODE);
$geoJsonGz = gzencode($geoJson);

$dirPath = __DIR__ . '/output/geojson/poland-2018';
if(!is_dir($dirPath)){
    mkdir($dirPath);
}

file_put_contents($dirPath . '/full.geoJson', $geoJson);
file_put_contents($dirPath . '/full.geoJson.gz', $geoJsonGz);

// trackPoints
$gpx = __DIR__ . '/gpx/poland-2018/points.gpx';
$trackPoints = $trackpointsService->parseGpxTrackPoints($gpx);
$trackPoints = json_encode($trackPoints, JSON_UNESCAPED_UNICODE);
$trackPointsGz = gzencode($trackPoints);

file_put_contents($dirPath . '/trackPoints.json', $trackPoints);
file_put_contents($dirPath . '/trackPoints.json.gz', $trackPointsGz);

echo "Job is done\n";
