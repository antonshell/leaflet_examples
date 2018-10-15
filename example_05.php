<?php

use src\GpxCombine;

require '_bootstrap.php';

$combineService = new GpxCombine();

$gpxArray = [
    __DIR__ . '/gpx/5-capitals/2014-08-08_20-35-01_Day.gpx',
    __DIR__ . '/gpx/5-capitals/2014-08-09_10-24-16_Day.gpx',
    __DIR__ . '/gpx/5-capitals/2014-08-10_09-37-39_Day.gpx',
    __DIR__ . '/gpx/5-capitals/2014-08-11_00-01-24_Day.gpx',
    __DIR__ . '/gpx/5-capitals/2014-08-12_09-50-25_Day.gpx',
    __DIR__ . '/gpx/5-capitals/2014-08-13_00-00-39_Day.gpx',
    __DIR__ . '/gpx/5-capitals/2014-08-15_08-53-16_Day.gpx',
    __DIR__ . '/gpx/5-capitals/2014-08-16_13-45-55_Day.gpx',
    __DIR__ . '/gpx/5-capitals/2014-08-17_08-25-25_Day.gpx',
    __DIR__ . '/gpx/5-capitals/2014-08-18_17-49-08_Day.gpx',
    __DIR__ . '/gpx/5-capitals/2014-08-19_14-46-34_Day.gpx',
    __DIR__ . '/gpx/5-capitals/2014-08-20_09-38-14_Day.gpx',
    __DIR__ . '/gpx/5-capitals/2014-08-21_12-50-30_Day.gpx',
    __DIR__ . '/gpx/5-capitals/2014-08-24_08-21-12_Day.gpx',
    __DIR__ . '/gpx/5-capitals/2014-08-25_08-38-40_Day.gpx',
    __DIR__ . '/gpx/5-capitals/2014-08-26_11-45-51_Day.gpx',
    __DIR__ . '/gpx/5-capitals/2014-08-27_09-13-32_Day.gpx',
];

$gpxContent = $combineService->combineGpxArray($gpxArray);
file_put_contents(__DIR__ . '/output/combined.gpx', $gpxContent);

echo "Job is done";
