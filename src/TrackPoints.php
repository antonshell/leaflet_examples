<?php

namespace src;

/**
 * Class TrackPoints
 * @package src
 */
class TrackPoints{

    /**
     * @param $gpx
     * @return array
     */
    public function parseGpxTrackPoints($gpx){
        $parsedGpx = $this->parseGpx($gpx);


        $a = 0;

        $trackPoints = [];
        return $trackPoints;
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
}