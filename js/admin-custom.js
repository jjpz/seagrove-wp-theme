jQuery(document).ready(function($){
	if ( $('#post-search-input').length ) {
		var search = $('#post-search-input').val();
		if ( search !== '' ) {
			$('span.subtitle').text('Search results for "'+ search +'"'); 
		}
	}
});