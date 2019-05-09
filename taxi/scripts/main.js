$(function () {
	$('.mainHeader__navigationAdaptive').click(function() {
		$('.mainHeader__navigationAdaptiveIcon').toggleClass('mainHeader__navigationAdaptiveIcon_open');
		$('.mainHeader__navigation').toggleClass('mainHeader__navigation_open');		
	});
	$('.mainHeader__navigationItem').click(function () {
		$('.mainHeader__navigationAdaptiveIcon').toggleClass('mainHeader__navigationAdaptiveIcon_open');
		$('.mainHeader__navigation').toggleClass('mainHeader__navigation_open');
	});
});	