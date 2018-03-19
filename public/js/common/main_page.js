$(function () {

	
	$(".mask-btn").click(function(){
	    $(".photo_mask").css("display","block");
	   
	});


	$(".mask-btn").click(function(){
	    $(".photo_album").css("margin-left","-250px");
	   
	});


	$(".photo_album .photo_close,.photo_mask").click(function(){
	    $(".photo_mask").css("display","none")
	});



	$(".photo_album .photo_close,.photo_mask").click(function(){
	    $(".photo_album").css("margin-left","-2450px")
	});

})