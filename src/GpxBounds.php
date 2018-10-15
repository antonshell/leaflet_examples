<?php

namespace src;

use SimpleXMLElement;

/**
 * Class GpxBounds
 * @package src
 */
class GpxBounds{

    /**
     * @param $gpx
     * @return array
     */
    public function getLatLngBounds($gpx){
        /*$content = file_get_contents($gpx);

        $parser = xml_parser_create();
        xml_parse_into_struct($parser,$content,$parsedGpx);*/

        $latArray = [];
        $lonArray = [];

        $parsedGpx = $this->parseGpx($gpx);
        foreach($parsedGpx as $line){
            if(isset($line['attributes']['LAT'])){
                $latArray[] = $line['attributes']['LAT'];
            }

            if(isset($line['attributes']['LAT'])){
                $lonArray[] = $line['attributes']['LON'];
            }
        }

        $bounds = [
            'neLat' => min($latArray),
            'neLng' => min($lonArray),
            'swLat' => max($latArray),
            'swLng' => max($lonArray),
        ];

        return $bounds;
    }

    /**
     * @param $gpxArray
     * @return array
     */
    public function getLatLngBoundsArray($gpxArray)
    {
        $latArray = [];
        $lonArray = [];

        foreach ($gpxArray as $gpx){
            //$itemBounds = $this->getLatLngBounds($gpx);

            /*$content = file_get_contents($gpx);

            $parser = xml_parser_create();
            xml_parse_into_struct($parser,$content,$parsedGpx);*/

            //$latArray = [];
            //$lonArray = [];

            $parsedGpx = $this->parseGpx($gpx);
            foreach($parsedGpx as $line){
                if(isset($line['attributes']['LAT'])){
                    $latArray[] = $line['attributes']['LAT'];
                }

                if(isset($line['attributes']['LAT'])){
                    $lonArray[] = $line['attributes']['LON'];
                }
            }
        }

        $bounds = [
            'neLat' => min($latArray),
            'neLng' => min($lonArray),
            'swLat' => max($latArray),
            'swLng' => max($lonArray),
        ];

        return $bounds;
    }

    /**
     * @param $gpx
     * @return mixed
     */
    private function parseGpx($gpx){
        $content = file_get_contents($gpx);
        $parser = xml_parser_create();
        xml_parse_into_struct($parser,$content,$parsedGpx);
        return $parsedGpx;
    }
}