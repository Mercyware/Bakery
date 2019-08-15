$(document).ready(function () {
    if (navigator.geolocation) {
        var currgeocoder;

        //Set geo location lat and long

        navigator.geolocation.getCurrentPosition(function(position, html5Error) {

            geo_loc = processGeolocationResult(position);
            currLatLong = geo_loc.split(",");
            initializeCurrent(currLatLong[0], currLatLong[1]);

        });
    }
    else {
        // geolocation is not supported
    }

});





