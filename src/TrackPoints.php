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
        $data = ['bounds' => [], 'points' => []];

        if(isset($parsedGpx['metadata']['bounds']['@attributes'])){
            $data['bounds'] = $parsedGpx['metadata']['bounds']['@attributes'];
        }

        $points = [];
        foreach ($parsedGpx['wpt'] as $item){
            $points[] = [
                'lat' => $item['@attributes']['lat'],
                'lon' => $item['@attributes']['lon'],
                'elevation' => $item['ele'] ?? '',
                'time' => $item['time'] ?? '',
                'name' => $item['name'] ?? 'No name',
            ];
        }

        $data['points'] = $points;
        return $data;
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