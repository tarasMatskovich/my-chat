$(document).ready(function() {
	var headerHeight = $("section.menu").height();
    var footerHeight = $("footer").height();
    var height = screen.height - headerHeight - footerHeight;
	if (headerHeight != undefined && footerHeight != undefined) {
		$(".main-content").css({
			minHeight:height - 180
		});
	}
	$('.more-msg-info').click(function() {
		if($("#show-more-info-msg").is(":visible")) {
			$("#show-more-info-msg").fadeOut();
		} else {
			$("#show-more-info-msg").fadeIn();
		}
		
	});
});