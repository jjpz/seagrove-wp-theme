jQuery(document).ready(function($){

var map;
var markers = [];

function initialize(){

if ( typeof locations !== 'undefined' && locations !== '' ) {

var mapOptions = {
	gestureHandling: 'auto',
	zoomControl: true,
	mapTypeControl: false,
	streetViewControl: false,
	fullscreenControl: false
};

map = new google.maps.Map(document.getElementById('map'), mapOptions);
var infowindow = new google.maps.InfoWindow();
var bounds = new google.maps.LatLngBounds();

function clearMarkers(){ // Removes the markers from the map, but keeps them in the array.
	for ( var i = 0; i < markers.length; i++ ) {
		markers[i].setMap(null);
	}
}

function deleteMarkers(){ // Deletes all markers in the array by removing references to them.
	clearMarkers();
	markers = [];
}

// set map markers
function setMarkers(locations){
	var n = locations.length;
	bounds = new google.maps.LatLngBounds(null);
	if ( n < 1 ) {
		var lat = 25.761681;
		var lng = -80.191788;
		var position = new google.maps.LatLng(lat, lng);
		bounds.extend(position);
	} else {
		for ( var i = 0; i < n; i++ ) {
			var lat = locations[i].lat;
			var lng = locations[i].lng;
			var position = new google.maps.LatLng(lat, lng);
			if ( locations[i].marker_type === 'logo' ) {
				var icon = {
					url: locations[i].marker,
					scaledSize: new google.maps.Size(40, 53)
				};
			} else {
				var icon = {
					url: locations[i].marker,
					scaledSize: new google.maps.Size(27, 35),
					origin: new google.maps.Point(0, 0),
					anchor: new google.maps.Point(0, 35)
				};
			}
			bounds.extend(position);
			var marker = new google.maps.Marker({
				position: position,
				icon: icon,
				map: map
			});
			markers.push(marker);
			showInfoWindow(locations[i], marker, infowindow);
		}
	}
	map.setCenter(bounds.getCenter());
	if ( n < 1 ) {
		map.setZoom(10);
	} else if ( n > 1 ) {
		map.fitBounds(bounds);
		map.panToBounds(bounds);
	} else {
		map.setZoom(15);
	}
	console.log(markers);
}
setMarkers(locations);

// map info window
function showInfoWindow(location, marker, infowindow){
	google.maps.event.addListener(marker, 'click', function(event){
		var content = '<div class="infowindow" data-index="'+location.index+'">';
			content += '<div class="property-card">';
			content += '<div class="content">';
			if ( location.image.length > 0 ) {
			content += '<div class="image"><div class="thumbnail"><img src="'+location.image+'"></div></div>';
			}
			content += '<div class="info">';
			content += '<div class="title"><h6>'+location.title+'</h6></div>';
			content += '<div class="address"><span>'+location.street_number+'</span></div>';
			content += '<div class="details">';
			if ( location.bed != '' && location.bed != 0 ) { content += '<span class="meta bed">&bull; '+location.bed+' bed</span>'; }
			if ( location.bath != '' && location.bath != 0 ) { content += '<span class="meta bath">&bull; '+location.bath+' bath</span>'; }
			if ( location.size != '' && location.size != 0 ) { content += '<span class="meta size">&bull; '+location.size+' sqft</span>'; }
			if ( location.lot != '' && location.lot != 0 ) { content += '<span class="meta lot">&bull; '+location.lot+' sqft lot</span>'; }
			if ( location.price != '' && location.price != 0 ) { content += '<span class="meta price">&bull; $'+location.price+'</span>'; }
			content += '</div>';
			content += '</div>';
			content += '</div>';
			content += '<div class="buttons"><a href="'+location.url+'">View Details</a></div>';
			content += '</div>';
			content += '</div>';
		infowindow.index = location.index;
		infowindow.setOptions({
			content: content,
			maxWidth: 300
		});
		infowindow.open(map, marker);
		$('.list-item').removeClass('active');
		$('.list-item-' + infowindow.index).addClass('active');
	});
}

// map marker click
$(document).on('click', '#marker-link', function(event){
	event.preventDefault();
	var button = $(event.currentTarget);
	var marker = markers[button.data('marker-id')];
	var position = marker.getPosition();
	$('.list-item').removeClass('active');
	$('.list-item-' + button.data('marker-id')).addClass('active');
	$('.map-list').removeClass('open');
	$('.map-list-controls .show-list').removeClass('active');
	$('.map-list-controls .show-map').addClass('active');
	google.maps.event.trigger(marker, 'click');
	map.panTo(position);
});

google.maps.event.addListener(infowindow, 'closeclick', function(){
	$('.list-item-' + infowindow.index).removeClass('active');
});

// search reset
if ( $('#search').val() !== '' ) {
	$('#search-reset').addClass('open');
}

$(document).on('click', '#search-reset', function(e){
	e.preventDefault();
	$('#search').val('');
	//$('.search-result').removeClass('open');
	$('#search-reset').removeClass('open');
});

// clear URL
function clearURL() {
	window.history.replaceState({}, '', location.pathname);
}

// filter, sort & load more variables
var mapVars = {
filters : $('#filters'),
apply : $('#apply'),
reset : $('#reset'),
maploader : $('.map-loader'),
loadmore : $('.load-more-btn'),
maploadmore : $('.map-load-more-btn'),
current_page : helper.current_page,
max_page : helper.max_page
}

// APPLY FILTERS
$(document).on('click', '#apply', function(){
	var paramsArray = [];
	var search = $('#search').val();
	if ( search.length > 0 ) {
		//$('.search-result').addClass('open');
		//$('.search-keyword').text(search);
		$('#search-reset').addClass('open');
	}
	var price_min = $('#price_min').val();
	var price_max = $('#price_max').val();
	if ( $('.filter-size').length > 0 ) {
		var size_min = $('#size_min').val();
		var size_max = $('#size_max').val();
	} else {
		var size_min ='';
		var size_max = '';
	}
	var agent = $('input[name="agent"]').val();
	var availability;
	if ( $('input[name="availability"]:checked').val() ) {
		availability = $('input[name="availability"]:checked').val();
	} else {
		availability = $('input[name="availability"]').val();
	}
	var status = $('.filter-status input[type="radio"]:checked').val();
	var type;
	if ( $('input[name="type"]:checked').val() ) {
		type = $('input[name="type"]:checked').val();
	} else {
		type = $('input[name="type"]').val();
	}
	var bed;
	if ( $('input[name="bed"]:checked').val() ) {
		bed = $('input[name="bed"]:checked').val();
	} else {
		bed = $('input[name="bed"]').val();
	}
	var bath;
	if ( $('input[name="bath"]:checked').val() ) {
		bath = $('input[name="bath"]:checked').val();
	} else {
		bath = $('input[name="bath"]').val();
	}
	var hood = $('.filter-hood option:selected').val();
	var sort_by = $('#sorts input[type="radio"]:checked').attr('data-sort-by');
	var sort_order = $('#sorts input[type="radio"]:checked').attr('data-sort-order');
	paramsArray = [
		{ key: 'search', value: search },
		{ key: 'price_min', value: price_min },
		{ key: 'price_max', value: price_max },
		{ key: 'size_min', value: size_min },
		{ key: 'size_max', value: size_max },
		{ key: 'availability', value: availability },
		{ key: 'type', value: type },
		{ key: 'status', value: status },
		{ key: 'bed', value: bed },
		{ key: 'bath', value: bath },
		{ key: 'hood', value: hood },
		{ key: 'sort_by', value: sort_by },
		{ key: 'sort_order', value: sort_order }
	];
	
	var form_data = mapVars.filters.serializeArray();
	var sort_by = $('#sorts input[type="radio"]:checked').attr('data-sort-by');
	var sort_order = $('#sorts input[type="radio"]:checked').attr('data-sort-order');
	form_data.push(
		{ name: 'sort_by', value: sort_by },
		{ name: 'sort_order', value: sort_order },
		{ name: 'action', value: 'seagrove_filter' }
	);
	
	var url = new URL(window.location.href);
	var query_string = url.search;
	var search_params = new URLSearchParams(query_string);
	
	for ( var i = 0; i < paramsArray.length; i++ ) {
		appendUrlParams( paramsArray[i].key, paramsArray[i].value );
	}
	
	function appendUrlParams( param_key, param_value ){
		if ( !search_params.has(param_key) ) {
			if ( param_value != '' ) {
				search_params.append(param_key, param_value);
			}
		} else {
			if ( param_value != '' ) {
				search_params.set(param_key, param_value);
			} else {
				search_params.delete(param_key);
			}
		}
	}
	
	url.search = search_params.toString();
	var new_url = url.toString();
	
	var data = {
		'action' : 'seagrove_filter',
		'security' : helper.security_filter,
		'search' : search,
		'price_min' : price_min,
		'price_max' : price_max,
		'size_min' : size_min,
		'size_max' : size_max,
		'agent' : agent,
		'availability' : availability,
		'status' : status,
		'type' : type,
		'bed' : bed,
		'bath' : bath,
		'hood' : hood,
		'sort_by' : sort_by,
		'sort_order' : sort_order
	};
	$.ajax({
		url: helper.ajaxurl,
		data: data,
		type: 'post',
		beforeSend: function(xhr){
			mapVars.maploader.fadeIn('fast');
			mapVars.apply.text('Processing...');
			console.log(data);
			console.log(mapVars.current_page);
			console.log(mapVars.max_page);
		},
		success: function(data){
			mapVars.apply.text('Apply');
			$('#listings').html(data);
			if ( typeof new_data !== 'undefined' && new_data !== '' ) {
				mapVars.current_page = new_data.current_page;
				mapVars.max_page = new_data.max_page;
			}
			if ( mapVars.current_page < mapVars.max_page ) {
				mapVars.loadmore.show().text('Load More');
				mapVars.maploadmore.show().text('Load More');
			} else {
				mapVars.loadmore.fadeOut('fast');
				mapVars.maploadmore.fadeOut('fast');
			}
		},
		complete: function(data){
			window.history.pushState({ path: new_url }, '', new_url);
			$('#map-filters').animate({ scrollTop: 0 }, 250);
			$('.map-list').animate({ scrollTop: 0 }, 250);
			$('.map-filters-container').removeClass('open');
			$('.map-filter-btn').removeClass('active');
			deleteMarkers();
			setMarkers(locations);
			setTimeout(function(){
			mapVars.maploader.fadeOut('fast');
			}, 500);
		}
	});
	return false;
});

// LOAD MORE
$(document).on('click', '#loadmore', function(){
	var search = $('#search').val();
	var price_min = $('#price_min').val();
	var price_max = $('#price_max').val();
	var size_min = $('#size_min').val();
	var size_max = $('#size_max').val();
	var agent = $('input[name="agent"]').val();
	var availability;
	if ( $('input[name="availability"]:checked').val() ) {
		availability = $('input[name="availability"]:checked').val();
	} else {
		availability = $('input[name="availability"]').val();
	}
	var status = $('.filter-status input[type="radio"]:checked').val();
	var type;
	if ( $('input[name="type"]:checked').val() ) {
		type = $('input[name="type"]:checked').val();
	} else {
		type = $('input[name="type"]').val();
	}
	var bed;
	if ( $('input[name="bed"]:checked').val() ) {
		bed = $('input[name="bed"]:checked').val();
	} else {
		bed = $('input[name="bed"]').val();
	}
	var bath;
	if ( $('input[name="bath"]:checked').val() ) {
		bath = $('input[name="bath"]:checked').val();
	} else {
		bath = $('input[name="bath"]').val();
	}
	var hood = $('.filter-hood option:selected').val();
	var sort_by = $('#sorts input[type="radio"]:checked').attr('data-sort-by');
	var sort_order = $('#sorts input[type="radio"]:checked').attr('data-sort-order');
	var data = {
		'action' : 'seagrove_loadmore',
		'security' : helper.security_load,
		'locations' : locations,
		'page' : mapVars.current_page,
		'search' : search,
		'price_min' : price_min,
		'price_max' : price_max,
		'size_min' : size_min,
		'size_max' : size_max,
		'agent' : agent,
		'availability' : availability,
		'status' : status,
		'type' : type,
		'bed' : bed,
		'bath' : bath,
		'hood' : hood,
		'sort_by' : sort_by,
		'sort_order' : sort_order
	};
	$.ajax({
		url  : helper.ajaxurl,
		data : data,
		type : 'POST',
		beforeSend : function(xhr){
			mapVars.maploader.fadeIn('fast');
			mapVars.loadmore.text('Loading...');
			mapVars.maploadmore.text('Loading...');
			console.log(data);
			console.log(mapVars.current_page);
			console.log(mapVars.max_page);
		},
		success : function(data){
			if ( data ) {
				var items = $(data);
				$('#listings').append(items);
				mapVars.current_page++;
				if ( mapVars.current_page == mapVars.max_page ) {
					mapVars.loadmore.fadeOut('fast');
					mapVars.maploadmore.fadeOut('fast');
				} else {
					mapVars.loadmore.text('Load More');
					mapVars.maploadmore.text('Load More');
				}
			} else {
				mapVars.loadmore.remove();
				mapVars.maploadmore.remove();
			}
		},
		complete : function(data){
			deleteMarkers();
			setMarkers(locations);
			setTimeout(function(){
			mapVars.maploader.fadeOut('fast');
			}, 500);
		}
	});
});

// RESET FILTERS
$(document).on('click', '#reset', function(e){
	e.preventDefault();
	$('#search').val('');
	//$('.search-result').removeClass('open');
	$('#search-reset').removeClass('open');
	$('#price_min').val('');
	$('#price_max').val('');
	$('#size_min').val('');
	$('#size_max').val('');
	var agent = $('input[name="agent"]').val();
	if ( $('.filter-availability').length > 0 ) {
		$('.filter-availability input[type="radio"]:first').prop('checked', true);
		$('.filter-availability .button').removeClass('checked');
		$('.filter-availability .button:first').addClass('checked');
	} else {
		var availability = $('input[name="availability"]').val();
	}
	$('.filter-status input[type="radio"]:first').prop('checked', true);
		$('.filter-status .button').removeClass('checked');
		$('.filter-status .button:first').addClass('checked');
	if ( $('.filter-type').length > 0 ) {
		$('.filter-type input[type="radio"]:first').prop('checked', true);
		$('.filter-type .button').removeClass('checked');
		$('.filter-type .button:first').addClass('checked');
		var type = $('input[name="type"]').val();
	} else {
		var type = $('input[name="type"]').val();
	}
	$('.filter-beds input[type="radio"]:first').prop('checked', true);
	$('.filter-bath input[type="radio"]:first').prop('checked', true);
	$('.filter-hood option:first').prop('selected', true);
	$('#sorts input[type="radio"]:first').prop('checked', true);
	var data = {
		'action' : 'seagrove_filter',
		'security' : helper.security_filter,
		'agent' : agent,
		'availability' : availability,
		'type' : type
	};
	$.ajax({
		url: helper.ajaxurl,
		data: data,
		type: 'post',
		beforeSend: function(xhr){
			mapVars.maploader.fadeIn('fast');
			mapVars.reset.text('Processing...');
			console.log(data);
		},
		success: function(data){
			mapVars.reset.text('Reset all');
			$('#listings').html(data);
			if ( typeof new_data !== 'undefined' ) {
				mapVars.current_page = new_data.current_page;
				mapVars.max_page = new_data.max_page;
			}
			if ( mapVars.current_page < mapVars.max_page ) {
				mapVars.loadmore.show().text('Load More');
				mapVars.maploadmore.show().text('Load More');
			} else {
				mapVars.loadmore.fadeOut('fast');
				mapVars.maploadmore.fadeOut('fast');
			}
		},
		complete: function(data){
			clearURL();
			$('#map-filters').animate({ scrollTop: 0 }, 250);
			$('.map-list').animate({ scrollTop: 0 }, 250);
			$('.map-filters-container').removeClass('open');
			$('.map-filter-btn').removeClass('active');
			deleteMarkers();
			setMarkers(locations);
			setTimeout(function(){
			mapVars.maploader.fadeOut('fast');
			}, 500);
		}
	});
	return false;
});

}

}
google.maps.event.addDomListener(window, 'load', initialize);

// map list controls
$('.map-list-controls a').click(function(e){
	e.preventDefault();
	if ( $(this).hasClass('active') ) {
		$(this).removeClass('active');
		$(this).siblings().addClass('active');
	} else {
		$(this).addClass('active');
		$(this).siblings().removeClass('active');
	}
	if ( $('.map-list-controls .show-list').hasClass('active') ) {
		$('.map-list').addClass('open');
	} else {
		$('.map-list').removeClass('open');
	}
});

// map filter controls
$('.map-filter-btn').click(function(e){
	e.preventDefault();
	$(this).toggleClass('active');
	$('.map-filters-container').toggleClass('open');
});

$('.close-filter-btn').click(function(e){
	e.preventDefault();
	$('.map-filter-btn').removeClass('active');
	$('.map-filters-container').removeClass('open');
});

// filter buttons change
$('.buttons .button input[type="radio"]').click(function(){
	$(this).closest('.button').siblings().removeClass('checked');
	$(this).closest('.button').addClass('checked');
});

});