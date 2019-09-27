var placeSearch, autocomplete;

var componentForm = {
    administrative_area_level_1: 'short_name',
    administrative_area_level_2: 'short_name',
    postal_code: 'short_name',
    sublocality_level_1: 'short_name',
    route: 'long_name',
    street_number: 'short_name'
};

function initAutocomplete() {
    // Create the autocomplete object, restricting the search predictions to
    // geographical location types.
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('autocomplete'), { 
            types: ['geocode', 'establishment']
        });

    geolocate();
    
    // Avoid paying for data that you don't need by restricting the set of
    // place fields that are returned to just the address components.
    autocomplete.setFields(['address_component']);

    // When the user selects an address from the drop-down, populate the
    // address fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    for (var component in componentForm) {
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
    }

    // Get each component of the address from the place details,
    // and then fill-in the corresponding field on the form.
    
    //console.log(place.address_components);

    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
        }
    }
    
}

//Fixo em Delion Café
function geolocate() {

    // navigator.geolocation.getCurrentPosition(function(position) {
    //     console.log(position.coords.accuracy);
    // }); 

    //Delion café -25.54086,-54.581167
    var geolocation = {
        lat: -25.54086,
        lng: -54.581167
    };
    
    var radiusMeters = 10000; //10km apartir da Delion Café

    var circle = new google.maps.Circle({
        center: geolocation,
        radius: radiusMeters
    });

    autocomplete.setBounds(circle.getBounds());
}