<?php

$file = $_GET['file'] ?? '';

$dirName = basename(dirname($file));
$baseName = basename($file);
$filePath = __DIR__ . '/geojson/' . $dirName . '/' . $baseName;
$data = file_get_contents($filePath);

header("Content-type: application/json");
header('Content-Encoding: gzip');

echo $data;