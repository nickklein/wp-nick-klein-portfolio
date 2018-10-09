var slick = require('slick-carousel');
var waypoint = require('../../../node_modules/waypoints/lib/jquery.waypoints.js');

/* exported module, exports */
module.exports = {
	init: function(self) {
		this.bind();
	},
	bind: function() {
			$('.view-work').click(function(e) {
				e.preventDefault();
				var href = $(this).attr('href');
				$("html, body").animate({ scrollTop: $(href).offset().top }, 1000);
			});
		    //alert('test');
	}
};
