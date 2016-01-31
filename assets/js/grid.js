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
			var $card = $(this).closest('.card2');
			var $grid_item = $card.closest('.grid-item');

			$card.toggleClass('expanded');
			$grid_item.toggleClass('expanded');

			$(this).text($card.hasClass('expanded') ? "Zwiń <" : "Rozwiń >");
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
