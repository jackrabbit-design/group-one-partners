/* ========================================================================= */
/* BE SURE TO COMMENT CODE/IDENTIFY PER PLUGIN CALL */
/* ========================================================================= */

jQuery(function($){


    // PARALLAX
/*
    $(document).scroll(function(){
        var nm = $("html").scrollTop();
        var nw = $("body").scrollTop();
        var n = (nm > nw ? nm : nw);

        $('#element').css({
            'webkitTransform' : 'translate3d(0, ' + n + 'px, 0)',
            'MozTransform'    : 'translate3d(0, ' + n + 'px, 0)',
            'msTransform'     : 'translateY('     + n + 'px)',
            'OTransform'      : 'translate3d(0, ' + n + 'px, 0)',
            'transform'       : 'translate3d(0, ' + n + 'px, 0)',
        });

        // if transform3d isn't available, use top over background-position
        //$('#element').css('top', Math.ceil(n/2) + 'px');

    });    
*/



    /* ====== Twitter API Call ============================================= 
        Note: Script Automatically adds <li> before and after template. Don't forget to setup Auth info in /twitter/index.php */
    /*
    $('#tweets-loading').tweet({       
        modpath: '/path/to/twitter/', // only needed if twitter folder is not in root
        username: 'jackrabbits',
        count: 1,
		template: '<p>{text}</p><p class="tweetlink">{time}</p>' 
	});
    */
	
	randowmBanners();
	_mobileMenu();
	_toggleNav();
	_mediaFilter();
	_headerSearch();
	nestedInit();
	teamHover();
});


function randowmBanners(){
	var bannerItems = $('#hm-slider ul li');
	bannerItems.hide();
	var rand = Math.floor(Math.random() * 1000);
	
	var $li = $("#hm-slider ul li");
	$li.eq(rand % $li.length).show();
}

function _mobileMenu(){
	$('#toggle_menu_btn').click(function(){
		$(this).toggleClass('active');
		$('#mobile-nav-wrap').slideToggle('fast');
	});
}

function _toggleNav(){
	$('.toggle-nav .dropdown').click(function(){
		$('.toggle-nav').toggleClass('open');
	});
	
	$('.toggle-nav ul li ul li').click(function(){
		var currentTxt = $(this).html();
		$('.toggle-nav .dropdown span').text(currentTxt);
		$('.toggle-nav').removeClass('open');
	});
}

function _mediaFilter(){
	$('#media').mixItUp();
}

function _headerSearch(){
	$('#desktop-search').click(function(){
		$(this).toggleClass('active')
		$('.search-box').slideToggle('fast');
		$('.search-box input').focus();
	});
	
	$('#mobile-search').click(function(){
		$('.mobile-search-box').fadeToggle('fast');
		$('.mobile-search-box input').focus();
	});
}

function nestedInit(){
        
	var winW = $(window).width();
	if (winW > 768) {
		$('#works-grid').nested({
			minWidth: 267,
			gutter: 8,
			//centered:true,
			resizeToFit: true
		});
	}else{
		$('#works-grid').nested({
			minWidth: 130,
			gutter: 8,
			//centered:true,
			resizeToFit: true
		});
	}
};

function teamHover(){
	var current = 0; 

	
	 $('#team-members li').on('mouseleave',function(){
	 	var total = $(this).children('span.active').attr('data-count')-1;
	 	var cur = $('span.active',this).index(); 
	 	if(cur == total){ var newCir = 0;} else { var newCir = cur + 1; } 
		
		//alert(cur);
		
		var datNum = newCir + 1;
		$('span',this).removeClass('active');
		
		$('span[data-num='+datNum+']',this).addClass('active'); 
    });
}


$(window).resize(function(){
	if( $(window).innerWidth() > 767 ){
		$("#mobile-nav-wrap").removeAttr("style");
		$('#toggle_menu_btn').removeClass('active');
	}
});