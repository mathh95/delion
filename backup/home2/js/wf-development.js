$(document).ready(function () {
    $('.bxslider').bxSlider({
        auto: true,
        pause: 5000,
        pager: false,
        mode:'fade'

    });
});

$(document).ready(function(){
    $('.slider4').bxSlider({
        slideWidth: 300,
        auto: true,
        pause: 3000,
        minSlides: 2,
        maxSlides: 3,
        moveSlides: 1,
        slideMargin: 10
    });
});



/*======================= MENU MOBILE ======================*/

$(document).ready(function () {

    $('#btn-toggle').click(function () {
        $('.nav-left').toggle('fast');
    });
    
    $('#btn-toggle').click(function () {
        $('.nav-right').toggle('fast');
    });
    //    $('#novos').click(function () {
    //        $('.menu-top-list li>ul').toggle('fasts');
    //    });
    //    $('#seminovos').click(function () {
    //        $('li #sub-seminovos').toggle('fasts');
    //    });

});


/************************ Maps ****************************/


var map;
var wfdeveloper = new google.maps.LatLng(-25.5430858,-54.5842119);

var MY_MAPTYPE_ID = 'custom_style';

function initialize() {

    var featureOpts = [
        {
            "stylers": [
                {
                    "hue": "#ff1a00"
                },
                {
                    "invert_lightness": true
                },
                {
                    "saturation": -100
                },
                {
                    "lightness": 33
                },
                {
                    "gamma": 0.5
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#2D333C"
                }
            ]
        }
    ];

    var mapOptions = {
        zoom: 15,
        center: wfdeveloper,
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
        },
        mapTypeId: MY_MAPTYPE_ID
    };

    map = new google.maps.Map(document.getElementById('map-canvas'),
                              mapOptions);

    var styledMapOptions = {
        name: 'Custom Style'
    };

    var marker = new google.maps.Marker({
        map: map,
        icon: 'img/logo-map.png',
        position: map.getCenter(wfdeveloper)
    });

    //    var marker = new google.maps.Marker({
    //        position: new google.maps.LatLng(-25.512523, -54.610873),
    //        map: map,
    //        icon: 'img/marker-2.png'
    //    });

    var infowindow = new google.maps.InfoWindow();
    infowindow.setContent('');
    google.maps.event.addListener(marker, 'click', function () {
        infowindow.open(map, marker);
    });

    var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

    map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
}

google.maps.event.addDomListener(window, 'load', initialize);