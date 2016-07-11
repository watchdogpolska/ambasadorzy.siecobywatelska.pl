$(function(){
	$('#video-modal').on('shown.bs.modal', function (ev) {
	  var url = $(ev.relatedTarget).data('url');
	  $('#video-modal .embed-item').attr('src', url);
	})
});
