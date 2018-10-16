var fs = require('fs');
const DOMParser = require('xmldom').DOMParser;
var toGeoJSON = require ('@mapbox/togeojson');

var absolutePath = __dirname + '/output/combined.gpx';
var gpx = new DOMParser().parseFromString(fs.readFileSync(absolutePath, 'utf8'));
var geoJson = toGeoJSON.gpx(gpx)

delete geoJson['features'][0]['properties'];
var geoJsonStr = JSON.stringify(geoJson);

var outPath = __dirname + '/output/full.geoJson';
fs.writeFile(outPath, geoJsonStr, function(err) {
    if(err) {
        return console.log(err);
    }

    console.log("The file was saved!");
});