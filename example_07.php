<?php

use src\GeoJson;

require '_bootstrap.php';

$geoJsonService = new GeoJson();

$gpxArray = [
    __DIR__ . '/gpx/austria-2016/full.gpx',
    __DIR__ . '/gpx/greece-2018/full.gpx',
    __DIR__ . '/gpx/italy-coast-to-coast-2017/full.gpx',
    __DIR__ . '/gpx/italy-dolomity-2017/full-2016.gpx',
    __DIR__ . '/gpx/italy-dolomity-2017/full-2017.gpx',
    __DIR__ . '/gpx/italy-dolomity-2017/laguna.gpx',
    __DIR__ . '/gpx/sardegna-2017/full.gpx'
];

foreach ($gpxArray as $gpx){
    echo "Process gpx: " . $gpx . "\n";

    $geoJson = $geoJsonService->convertGpxToGeoJson($gpx, true, true, true);
    $geoJson = json_encode($geoJson, JSON_UNESCAPED_UNICODE);
    $geoJsonGz = gzencode($geoJson);

    $dirName = basename(dirname($gpx));
    $baseName = basename($gpx);
    $fileName = str_replace('.gpx','.geoJson',$baseName);
    $fileNameGz = str_replace('.gpx','.geoJson.gz',$baseName);

    $dirPath = __DIR__ . '/output/geojson/' . $dirName;
    if(!is_dir($dirPath)){
        mkdir($dirPath);
    }

    file_put_contents($dirPath . '/' . $fileName, $geoJson);
    file_put_contents($dirPath . '/' . $fileNameGz, $geoJsonGz);
}

echo "Job is done\n";
