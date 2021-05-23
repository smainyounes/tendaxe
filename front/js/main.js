$(window).scroll(function (event) {
	var height = $(window).scrollTop();

	    if(height <= 0) {
	        $(".navbar").removeClass("bg-light");
	        $(".navbar").removeClass("shadow");
	        $(".navbar").removeClass("navbar-light");
	        $(".navbar").addClass("navbar-dark");
	        $("#logo").addClass("text-white");
	        $("#logo").removeClass("text-black");
	    }else{
	    	$(".navbar").addClass("bg-light");
	    	$(".navbar").addClass("shadow");
	    	$(".navbar").addClass("navbar-light");
	    	$(".navbar").removeClass("navbar-dark");
	    	$("#logo").addClass("text-black");
	        $("#logo").removeClass("text-white");
	    }

});
