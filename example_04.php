<?php

use src\GpxBounds;

require '_bootstrap.php';

$boundsService = new GpxBounds();

$gpxArray = [
    __DIR__ . '/gpx/austria-2016/full.gpx',
    __DIR__ . '/gpx/greece-2018/full.gpx',
    __DIR__ . '/gpx/italy-coast-to-coast-2017/full.gpx',
    __DIR__ . '/gpx/italy-dolomity-2017/full-2016.gpx',
    __DIR__ . '/gpx/italy-dolomity-2017/full-2017.gpx',
    __DIR__ . '/gpx/italy-dolomity-2017/laguna.gpx',
    __DIR__ . '/gpx/sardegna-2017/full.gpx'
];

$bounds = $boundsService->getLatLngBoundsArray($gpxArray);
print_r($gpxArray);
print_r($bounds);