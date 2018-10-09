/* exported module, exports */
module.exports = {
	init: function(self) {
		this.bind();
	},
	bind: function() {
		$('.view-skills').click(function(e) {
			e.preventDefault();
			var exp = $('.exp-container');
			var title = $('.expertise h2');
			var exp_title = title.data('expertise');
			var skills_title = title.data('skills');

			if (exp.is(":visible")) {
				$('.exp-container').hide();
				title.text(skills_title);
				$('.skills-container').show();
			} else {
				$('.exp-container').show();
				title.text(exp_title);
				$('.skills-container').hide();
			}
		});
	}
};
