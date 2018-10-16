<?php

namespace src;

/**
 * Class GeoJson
 * @package src
 */
class GeoJson{

    const COORDINATE_PRECISION = 5;

    /**
     * @param $gpx
     * @param bool $reduceCoordinate
     * @return array
     */
    public function convertGpxToGeoJson($gpx, $reduceCoordinate = false, $removeTime = false, $removeElevation = false)
    {
        $geoJson = $this->getGeoJsonTemplate();

        $coordinates = [];
        $coordTimes = [];

        $parsedGpx = $this->parseGpx($gpx);
        $trkSegments = $parsedGpx['trk']['trkseg'];
        foreach ($trkSegments as $segmentKey => $segment){
            $coordTimes[$segmentKey] = [];
            $coordinates[$segmentKey] = [];

            if(!isset($segment['trkpt'])){
                continue;
            }

            $trackPoints = $segment['trkpt'];
            foreach ($trackPoints as $trackPointKey => $trackPoint){
                $elevation = $trackPoint['ele'];
                $lat = $trackPoint['@attributes']['lat'];
                $lon = $trackPoint['@attributes']['lon'];
                $time = $trackPoint['time'];

                if($reduceCoordinate){
                    $lat = $this->reduceCoordinate($lat);
                    $lon = $this->reduceCoordinate($lon);
                }

                $coordTimes[$segmentKey][$trackPointKey] = $time;

                $geoJsonPoint = [
                    0 => $lon,
                    1 => $lat,
                    2 => $elevation,
                ];

                if($removeElevation){
                    unset($geoJsonPoint[2]);
                }

                $coordinates[$segmentKey][$trackPointKey] = $geoJsonPoint;
            }
        }

        $geoJson['features'][0]['geometry']['coordinates'] = $coordinates;
        $geoJson['features'][0]['properties']['coordTimes'] = $coordTimes;

        if($removeTime){
            unset($geoJson['features'][0]['properties']['coordTimes']);
        }

        return $geoJson;
    }

    /**
     * @param $gpx
     * @return mixed
     */
    private function parseGpx($gpx){
        $content = file_get_contents($gpx);
        $xml = simplexml_load_string($content);
        $json = json_encode($xml);
        $parsedGpx = json_decode($json,TRUE);
        return $parsedGpx;
    }

    /**
     * @return array
     */
    private function getGeoJsonTemplate(){
        $geoJson = [
            'type' => 'FeatureCollection',
            'features' => [
                0 => [
                    'type' => 'Feature',
                    'geometry' => [
                        'type' => 'MultiLineString',
                        'coordinates' => [],
                    ],
                    'properties' => [
                        'name' => '',
                        'time' => '',
                        'coordTimes' => [],
                    ],
                ]
            ]
        ];

        return $geoJson;
    }

    /**
     * @param $coordinate
     * @return string
     */
    private function reduceCoordinate($coordinate){
        $precision = self::COORDINATE_PRECISION;
        $coordinate = round($coordinate, $precision);
        $coordinate = (string)$coordinate;
        return $coordinate;
    }
}