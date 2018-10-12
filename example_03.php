<?php

use src\GpxBounds;

require '_bootstrap.php';

$boundsService = new GpxBounds();

$gpx = __DIR__ . '/gpx/greece-2018/full.gpx';
$bounds = $boundsService->getLatLngBounds($gpx);

echo $gpx . "\n";
print_r($bounds);