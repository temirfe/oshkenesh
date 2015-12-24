/**
 * Created by Temirbek on 9/23/2015.
 */
    $(document).ready(function(){
        var panel=$('.js_panel');
        $(document).on('click','.js_panel_toggle',function () {
            if(panel.hasClass('panel-opened')) //if open do close
            {
                panel.removeClass('panel-opened tooltiphide');
                $(this).addClass('glyphicon-option-vertical').removeClass('glyphicon-option-horizontal');
            }
            else //if closed do open
            {
                panel.addClass('panel-opened tooltiphide');
                $(this).removeClass('glyphicon-option-vertical').addClass('glyphicon-option-horizontal');
            }
        });

        $("[data-toggle='tooltip']").tooltip();
//$("[data-toggle='popover']").popover();

        var mySwiper = new Swiper ('.swiper-container', {
            // If we need pagination
            slidesPerView: 6,
            spaceBetween: 30,
            freeMode: true,
            autoplay: 2500,
            scrollbar: '.swiper-scrollbar',
            autoplayDisableOnInteraction:false
        });

        $(window).scroll(function() {
            if($( window ).width()>430){ //don't fade out or in if it's mobile
                if($('.logo2').length){
                    if ($(window).scrollTop() > 150) {
                        $('.js_logo1').fadeIn();
                    }
                    else {
                        $('.js_logo1').fadeOut();
                    }
                }
            }
        });

        /*$(".js_logo1").click(function() {
            $("html, body").animate({ scrollTop: 0 });
            return false;
        });*/
        (function($){$.fn.hoverIntent=function(handlerIn,handlerOut,selector){var cfg={interval:100,sensitivity:6,timeout:0};if(typeof handlerIn==="object"){cfg=$.extend(cfg,handlerIn)}else{if($.isFunction(handlerOut)){cfg=$.extend(cfg,{over:handlerIn,out:handlerOut,selector:selector})}else{cfg=$.extend(cfg,{over:handlerIn,out:handlerIn,selector:handlerOut})}}var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if(Math.sqrt((pX-cX)*(pX-cX)+(pY-cY)*(pY-cY))<cfg.sensitivity){$(ob).off("mousemove.hoverIntent",track);ob.hoverIntent_s=true;return cfg.over.apply(ob,[ev])}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=false;return cfg.out.apply(ob,[ev])};var handleHover=function(e){var ev=$.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t)}if(e.type==="mouseenter"){pX=ev.pageX;pY=ev.pageY;$(ob).on("mousemove.hoverIntent",track);if(!ob.hoverIntent_s){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}}else{$(ob).off("mousemove.hoverIntent",track);if(ob.hoverIntent_s){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob)},cfg.timeout)}}};return this.on({"mouseenter.hoverIntent":handleHover,"mouseleave.hoverIntent":handleHover},cfg.selector)}})(jQuery);

        if($( window ).width()>768) //only desktop
        {
            $('.js_news').hoverIntent(function(){
                    var id=$(this).attr('news');
                    $('.js_news_img').hide();
                    $('.js_img_'+id).show();
                    $('.js_main_news').hide();
                },
                function(){
                    $('.js_news_img').hide();
                    $('.js_first_img').show();
                    $('.js_main_news').show();
                }
            );
        }

        $(window).scroll(function() {
            if($(this).scrollTop() > 300){
                $('#goTop').stop().animate({
                    bottom: '10px'
                }, 500);
            }
            else{
                $('#goTop').stop().animate({
                    bottom: '-100px'
                }, 500);
            }
        });
        $('#goTop').click(function() {
            $('html, body').stop().animate({
                scrollTop: 0
            }, 500, function() {
                $('#goTop').stop().animate({
                    bottom: '-100px'
                }, 500);
            });
        });

    });