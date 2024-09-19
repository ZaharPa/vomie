$(document).ready(function() {
	$("#slider").slider({
		range: true,
		min: 1900,
		max: 2025, 
		values: [1900, 2025], 
		slide: function(event, ui) {
			$("#year-min").val(ui.values[0]);
			$("#year-max").val(ui.values[1]);
		},
		stod: function(event, ui) {
			applyFilters();
		}
	});
	
	$("#year-min").val($("$slider").slider("values", 0));
	$("#year-max").val($("$slider").slider("values", 1));
});