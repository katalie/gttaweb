
// When the DOM is ready...
$(function(){
	$("#submit_button").attr("disabled",true);
	$("#rock").each(function(){
		this.checked = false;
		this.disabled = true;
	});
	
	// Fade out steps 2 and 3 until ready
	$("#step_2").css({ opacity: 0.3 });
	$("#step_3").css({ opacity: 0.3 });
	
	$.stepTwoComplete_one = "not complete";
	$.stepTwoComplete_two = "not complete"; 
		
	
	$(".nickname").keyup(function(){
	
		var all_complete = true;
				
		if (all_complete) {
			$("#step_1")
			.animate({
				paddingBottom: "120px"
			})
			.css({
				"background-image": "url(images/check.png)",
				"background-position": "bottom center",
				"background-repeat": "no-repeat"
			});
			$("#step_2")
			.animate({
				paddingBottom: "120px"
			})
			.css({
				"background-image": "url(images/check.png)",
				"background-position": "bottom center",
				"background-repeat": "no-repeat"
			});
			$("#step_2").css({
				opacity: 1.0
			});
			$("#step_2 legend").css({
				opacity: 1.0 // For dumb Internet Explorer
			});
			$("#step_3").css({
				opacity: 1.0
			});
			$("#step_3 legend").css({
				opacity: 1.0 // For dumb Internet Explorer
			});
			$("#rock").attr("disabled",false);
		};
	});
	
	$("#rock").click(function(){
		if (this.checked == true)
			$("#submit_button").attr("disabled",false);
		else
			$("#submit_button").attr("disabled",true);
	});
	
});