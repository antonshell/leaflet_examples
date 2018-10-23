# Leaflet Examples

Examples of usage Leaflet library. Based on http://velocrunch.ru project.
Related post: 

**Main features:** Implemented examples for map rendering, gpx tracks, 
performance optimization for large gpx files, markers rendering, track points rendering.

**Extra features:** combine(concatenate) gpx tracks, get bounds from gpx, 
convert gpx to geojson format. Convert Garmin gpx track points to json array.

Leaflet is a JavaScript library for mobile-friendly interactive maps.
https://github.com/Leaflet/Leaflet


## Install

1 . Clone repository

```
git clone ...
```

2 . Open in browser

```
http://127.0.0.1/leaflet_examples/
```

PHP 7.* is required.

## Examples

1 .  Map + Single GPX tracks

demo: example_01.html

2 . Map + multiple GPX tracks(simple) 

demo: example_02.html

3 . Get bounds for GPX tracks

```
php example_03.php
```

Results:

```
Array
(
    [neLat] => 36.79923084564507
    [neLng] => 21.265787724405527
    [swLat] => 38.496870584785938
    [swLng] => 24.058144837617874
)
```

4 . Get bounds for multiple GPX tracks.



```
php example_04.php
```

Results:

```
Array
(
    [0] => /Users/antonshell/Projects/leaflet_examples/gpx/austria-2016/full.gpx
    [1] => /Users/antonshell/Projects/leaflet_examples/gpx/greece-2018/full.gpx
    [2] => /Users/antonshell/Projects/leaflet_examples/gpx/italy-coast-to-coast-2017/full.gpx
    [3] => /Users/antonshell/Projects/leaflet_examples/gpx/italy-dolomity-2017/full-2016.gpx
    [4] => /Users/antonshell/Projects/leaflet_examples/gpx/italy-dolomity-2017/full-2017.gpx
    [5] => /Users/antonshell/Projects/leaflet_examples/gpx/italy-dolomity-2017/laguna.gpx
    [6] => /Users/antonshell/Projects/leaflet_examples/gpx/sardegna-2017/full.gpx
)
Array
(
    [neLat] => 36.79923084564507
    [neLng] => 8.3107243851
    [swLat] => 47.807752154767513
    [swLng] => 24.058144837617874
)
```

5 . Combine GPX tracks

```
php example_05.php
```

demo: example_05.html

6 . Markers 

demo: example_06.html

7 . Map + multiple GPX tracks(optimized) 

```
php example_07.php
```

demo: example_07.html

8 . Track Points(Garmin)

```
php example_08.php
```

demo: example_08.html