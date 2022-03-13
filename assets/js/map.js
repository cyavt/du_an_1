var map;

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: new google.maps.LatLng(-33.91722, 151.23064),
        mapTypeId: 'roadmap'
    });

    // defines custom icons
    var icons = {
        parking: {
            icon: 'https://www.calibrepress.com/wp-content/themes/calibre/images/icon_facebook.png'
        },
        library: {
            icon: 'https://maps.google.com/mapfiles/kml/shapes/library_maps.png'
        },
        info: {
            icon: 'https://www.worldremit.com/images/mish/icon-apple.svg'
        }
    };

    function addMarker(feature) {
        var marker = new google.maps.Marker({
            position: feature.position,
            icon: icons[feature.type].icon,
            map: map
        });
    }

    // I wrote this - don't know if it works...
    function addInfoWindow(feature) {
        // this part is from https://developers.google.com/maps/documentation/javascript/infowindows
        var infowindow = new google.maps.InfoWindow({
            content: features.content
        });
    }

    // defines locations
    var features = [{
        position: new google.maps.LatLng(-33.91721, 151.22630),
        type: 'info',
        content: 'Info 1'
    }, {
        position: new google.maps.LatLng(-33.91539, 151.22820),
        type: 'info',
        content: 'Info 2'
    }, {
        position: new google.maps.LatLng(-33.91747, 151.22912),
        type: 'info',
        content: 'Info 3'
    }, {
        position: new google.maps.LatLng(-33.91910, 151.22907),
        type: 'info',
        content: 'Info 3'
    }, {
        position: new google.maps.LatLng(-33.91725, 151.23011),
        type: 'info',
        content: 'Info 4'
    }, {
        position: new google.maps.LatLng(-33.91872, 151.23089),
        type: 'info',
        content: 'Info 5'
    }, {
        position: new google.maps.LatLng(-33.91784, 151.23094),
        type: 'info',
        content: 'Info 6'
    }, {
        position: new google.maps.LatLng(-33.91682, 151.23149),
        type: 'info',
        content: 'Info 7'
    }, {
        position: new google.maps.LatLng(-33.91790, 151.23463),
        type: 'info'
    }, {
        position: new google.maps.LatLng(-33.91666, 151.23468),
        type: 'info',
        content: 'Info 8'
    }, {
        position: new google.maps.LatLng(-33.916988, 151.233640),
        type: 'info',
        content: 'Info 9'
    }, {
        position: new google.maps.LatLng(-33.91662347903106, 151.22879464019775),
        type: 'parking',
        content: 'Pkng 1'
    }, {
        position: new google.maps.LatLng(-33.916365282092855, 151.22937399734496),
        type: 'parking',
        content: 'Pkng 2'
    }, {
        position: new google.maps.LatLng(-33.91665018901448, 151.2282474695587),
        type: 'parking',
        content: 'Pkng 3'
    }, {
        position: new google.maps.LatLng(-33.919543720969806, 151.23112279762267),
        type: 'parking',
        content: 'Pkng 4'
    }, {
        position: new google.maps.LatLng(-33.91608037421864, 151.23288232673644),
        type: 'parking',
        content: 'Pkng 5'
    }, {
        position: new google.maps.LatLng(-33.91851096391805, 151.2344058214569),
        type: 'parking',
        content: 'Pkng 6'
    }, {
        position: new google.maps.LatLng(-33.91818154739766, 151.2346203981781),
        type: 'parking',
        content: 'Pkng 7'
    }, {
        position: new google.maps.LatLng(-33.91727341958453, 151.23348314155578),
        type: 'library',
        content: 'La Biblioteca'
    }];

    // adds markers via the features table
    for (var i = 0, feature; feature = features[i]; i++) {
        addMarker(feature);
        addInfoWindow(feature);
    }

    // marker variable is only defined within the addMarker function
    /* marker.addListener('click', function() {
       infowindow.open(map, marker);
    });*/
}