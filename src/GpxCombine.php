<?php

namespace src;

/**
 * Class GpxCombine
 * @package src
 */
class GpxCombine{
    /**
     * @param $gpxArray
     * @return string
     */
    public function combineGpxArray($gpxArray)
    {
        $trkSegments = [];
        foreach ($gpxArray as $gpx) {
            $parsedGpx = $this->parseGpx($gpx);

            if(is_array($parsedGpx['trk']['trkseg']) && count($parsedGpx['trk']['trkseg'])){
                $trkSegments = array_merge($trkSegments, $parsedGpx['trk']['trkseg']);
            }
        }

        $content = '';
        foreach ($trkSegments as $i1 => $trkSegment){
            $segmentContent = '';
            $segmentContent .= "\t<trkseg>\n";

            foreach ($trkSegment['trkpt'] as $i2 => $trkpt){
                if(!isset($trkpt['@attributes'])){
                    continue;
                }

                $lat = $trkpt['@attributes']['lat'];
                $lon = $trkpt['@attributes']['lon'];
                $elevation = $trkpt['ele'];
                $time = $trkpt['time'];

                $trkptContent = '';
                $trkptContent .= "\t\t" . '<trkpt lat="' . $lat . '" lon="' . $lon . '">' . "\n";
                $trkptContent .= "\t\t\t" . '<ele>' . $elevation . '</ele>' . "\n";
                $trkptContent .= "\t\t\t" . '<time>' . $time . '</time>' . "\n";
                $trkptContent .= "\t\t" . '</trkpt>' . "\n";

                /*$trkptContent = "\t" . '<trkpt lat="' . $lat . '" lon="' . $lon . '">
                                    <ele>' . $elevation . '</ele>
                                    <time>' . $time . '</time>
                                  </trkpt>';*/

                $segmentContent .= $trkptContent;
            }

            $segmentContent .= "\t</trkseg>\n";
            $content .= $segmentContent;
        }

        $gpxTemplate = file_get_contents(__DIR__ . '/gpx_template.gpx');
        $gpxTemplate = str_replace('{{{content}}}', $content, $gpxTemplate);

        return $gpxTemplate;
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