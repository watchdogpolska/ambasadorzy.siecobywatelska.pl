(function (){
	$(function() {
		var $grid = $('.grid').masonry({
			itemSelector: '.grid-item',
			percentPosition: true,
			columnWidth: '.grid-sizer',
			stamp: '.grid-stamp'
		}).imagesLoaded( function() {
			// init Masonry after all images have loaded
			$grid.masonry();
		});;

		$('.js-expand-card').click(function (e) {
			e.preventDefault();
			var $current_card = $(this).closest('.card2');
			var $current_grid_item = $current_card.closest('.grid-item');

			$current_card.toggleClass('expanded');
			$current_grid_item.toggleClass('expanded');
			$(this).text($current_card.hasClass('expanded') ? "Zwiń <" : "Rozwiń >");

			$('.card2').not($current_card).removeClass('expanded');
			$('.grid-item').not($current_grid_item).removeClass('expanded');
			$('.js-expand-card').not(this).text("Rozwiń >");

			// Refresh grid;
			$grid.masonry();
		});

		// Wait for iframe ex. Youtube
		// setTimeout(function() {
		// 	// Refresh grid;
		// 	$grid.masonry();
		// }, 500)

	});
} (jQuery));
