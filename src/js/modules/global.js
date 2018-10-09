module.exports = {
		init: function(self) {
			this.bind();
		},
		bind: function() {
			$('.filter-button-group button').click(function(e) {
				e.preventDefault();
				//var three_grid_height = $('.three-col-grid').outerHeight();
				//$('.three-col-grid').css('height', three_grid_height);
				var filter = $(this).attr('data-filter');

				$('.col-item').hide();
				$('.' + filter).show();
			});

			var offset = $(window).height() / 1.2;

		    $('.wpjs').each( function() {
					var elem = $(this);
					var trigger = elem;

		          trigger.waypoint(function() {
			            elem.addClass('animate');
			            if (elem.hasClass('iso-item')) {
			            	console.log('fire');
			            }
		            },{
		                triggerOnce: true,
		                offset: offset
		          });
		    });

		    $('.slick').slick({
			  slidesToShow: 2,
			  slidesToScroll: 1,
			  autoplay: true,
			  autoplaySpeed: 6000,
			  responsive: [
			    {
			      breakpoint: 1024,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1,
			        infinite: true,
			        dots: true
			      }
			    }
			   ]
			});
			
		}
};