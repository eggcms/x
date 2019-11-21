// let navbar = $(".navbar");

// $(window).scroll(function () {
//   // get the complete hight of window
//   let oTop = $(".section-2").offset().top - window.innerHeight;
//   if ($(window).scrollTop() > oTop) {
//     navbar.addClass("sticky");
//   } else {
//     navbar.removeClass("sticky");
//   }
// });

//Get the button
$(document).ready(function(){
	$(window).scroll(function () {
		if ($(this).scrollTop() > 50) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});
	// scroll body to 0px on click
	$('#back-to-top').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 400);
		return false;
	});


	$('.alert[data-auto-dismiss]').each(function (index, element) {
		var $element = $(element),
			timeout  = $element.data('auto-dismiss') || 5000;
		setTimeout(function () {
			$element.alert('close');
		}, timeout);
	});
	$(".close").click(function() {
		clearInterval(delay);
		$("#alert-x").slideUp();
	});

});