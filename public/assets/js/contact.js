var Contact = function () {

    return {
        //main function to initiate the module
        init: function () {
			var map;
			$(document).ready(function(){
			  map = new GMaps({
				div: '#gmapbg',
				lat: -6.183152,
				lng: 106.829172
			  });
			   var marker = map.addMarker({
		            lat: -6.183152,
					lng: 106.829172,
		            title: 'Telkom DDS',
		            infoWindow: {
		                content: "<b>Telkom DDS</b> Jl. Kebon Sirih<br>Jakarta Pusat"
		            }
		        });

			   marker.infoWindow.open(map, marker);
			});
        }
    };

}();

jQuery(document).ready(function() {    
   Contact.init(); 
});

