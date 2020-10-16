function initialize(){

var hlat = parseFloat(helper.lat);
var hlng = parseFloat(helper.lng);
//var h_street_number = parseFloat(helper.street_number);
var h_street_number = helper.street_number;
var h_route = helper.route;
var h_unit = helper.unit;
var h_locality = helper.locality;
var h_administrative_area_level_1 = helper.administrative_area_level_1;
var h_postal_code = parseFloat(helper.postal_code);
var h_country = helper.country;

var mainLatLng, myLatLng, newLatLng;
myLatLng = new google.maps.LatLng(hlat, hlng);
mainLatLng = new google.maps.LatLng(39.8283, -98.5795);

var mapOptions = {
	gestureHandling: 'cooperative'
};

if ( hlat && hlng ) {
	newLatLng = myLatLng;
	mapOptions.center = myLatLng;
	mapOptions.zoom = 17;
} else {
	newLatLng = mainLatLng;
	mapOptions.center = mainLatLng;
	mapOptions.zoom = 3;
}

var componentForm = {
	street_number: 'short_name',
	route: 'short_name',
	locality: 'long_name',
	administrative_area_level_1: 'short_name',
	postal_code: 'short_name',
	country: 'long_name'
};

var map = new google.maps.Map(document.getElementById('map'), mapOptions);

//var markers = [];
var marker = new google.maps.Marker({
	map: map,
	position: newLatLng,
	draggable: true,
	anchorPoint: new google.maps.Point(0, -43)
});
marker.setMap(map);

var infowindow = new google.maps.InfoWindow();
if ( hlat && hlng ) {
	var contentString = '<div class="infowindow-content">';
	contentString += '<div class="infowindow-address"><span class="place-number">'+h_street_number+'</span> <span class="place-address-1">'+h_route+'</span><span class="place-address-2"> '+h_unit+'</span></div>';
	contentString += '<div class="infowindow-location"><span class="place-city">'+h_locality+'</span>, <span class="place-state">'+h_administrative_area_level_1+'</span> <span class="place-zip">'+h_postal_code+'</span></div>';
	contentString += '<div class="infowindow-country"><span class="place-country">'+h_country+'</span></div>';
	contentString += '</div>';
	infowindow.setContent(contentString);
	infowindow.open(map, marker);
}

var input = document.getElementById('pac-input');

google.maps.event.trigger(input, 'focus', {});
google.maps.event.trigger(input, 'keydown', {
keyCode: 13
});

var autocomplete = new google.maps.places.Autocomplete(input, {types: ['geocode']});
//autocomplete.setFields(['address_component', 'adr_address', 'formatted_address', 'geometry']);
autocomplete.setFields(['address_component', 'geometry']);
autocomplete.addListener('place_changed', fillInAddress);

function fillInAddress(){
	// Get the place details from the autocomplete object.
	var place = autocomplete.getPlace();
	console.log(place);

	document.getElementById("latitude").value = place.geometry.location.lat();
	document.getElementById("longitude").value = place.geometry.location.lng();
	document.getElementById("unit").value = '';
	for ( var component in componentForm ) {
		document.getElementById(component).value = '';
		document.getElementById(component).disabled = false;
	}

	// Get each component of the address from the place details,
	// and then fill-in the corresponding field on the form.
	for ( var i = 0; i < place.address_components.length; i++ ) {
		var addressType = place.address_components[i].types[0];
		if ( componentForm[addressType] ) {
			if ( addressType === 'route' ) {
				document.getElementById('street_number').value += ' ' + place.address_components[i][componentForm[addressType]];
			} else {
				var val = place.address_components[i][componentForm[addressType]];
				document.getElementById(addressType).value = val;
			}
			if ( addressType === 'street_number' ) { var n_street_number = place.address_components[i][componentForm[addressType]]; }
			if ( addressType === 'route' ) { var n_route = place.address_components[i][componentForm[addressType]]; }
			if ( addressType === 'locality' ) { var n_locality = place.address_components[i][componentForm[addressType]]; }
			if ( addressType === 'administrative_area_level_1' ) { var n_administrative_area_level_1 = place.address_components[i][componentForm[addressType]]; }
			if ( addressType === 'postal_code' ) { var n_postal_code = place.address_components[i][componentForm[addressType]]; }
			if ( addressType === 'country' ) { var n_country = place.address_components[i][componentForm[addressType]]; }
		}
	}

	var marker = new google.maps.Marker({
		map: map,
		position: place.geometry.location,
		draggable: true,
		anchorPoint: new google.maps.Point(0, -43)
	});
	var contentString = '<div class="infowindow-content">';
	contentString += '<div class="infowindow-address"><span class="place-number">'+n_street_number+'</span> <span class="place-address">'+n_route+'</span></div>';
	contentString += '<div class="infowindow-location"><span class="place-city">'+n_locality+'</span>, <span class="place-state">'+n_administrative_area_level_1+'</span> <span class="place-zip">'+n_postal_code+'</span></div>';
	contentString += '<div class="infowindow-country"><span class="place-country">'+n_country+'</span></div>';
	contentString += '</div>';
	//var contentString = '<div class="infowindow-content"><div class="infowindow-name"><span class="place-name">'+place.formatted_address+'</span></div>';
	infowindow.setContent(contentString);
	infowindow.open(map, marker);
	marker.setMap(map);

	// drag response
	google.maps.event.addListener(marker, 'dragend', function(e) {
		displayPosition(this.getPosition());
	});

	// click response
	google.maps.event.addListener(marker, 'click', function(e) {
		displayPosition(this.getPosition());
	});

	var bounds = new google.maps.LatLngBounds();
	bounds.extend(place.geometry.location);

	map.fitBounds(bounds);
	map.setZoom(17);
}

google.maps.event.addListener(map, 'bounds_changed', function() {
	var bounds = map.getBounds();
	autocomplete.setBounds(bounds);
});

function displayPosition(pos) {
	document.getElementById('latitude').value = pos.lat();
	document.getElementById('longitude').value = pos.lng();
}

google.maps.event.addListener(marker, 'dragend', function(event) {
	placeMarker(event.latLng);
});

function placeMarker(location) {
	if (marker == undefined){
		marker = new google.maps.Marker({
			map: map,
			position: location,
			animation: google.maps.Animation.DROP
		});
	}
	else {
		marker.setPosition(location);
	}
	map.setCenter(location);
	console.log(location.lat()+" "+location.lng()); // click debug
	document.getElementById("latitude").value = location.lat();
	document.getElementById("longitude").value = location.lng();
}

}
google.maps.event.addDomListener(window, 'load', initialize);
