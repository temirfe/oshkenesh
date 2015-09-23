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
            console.log('asdf');
            if ($(window).scrollTop() > 100) {
                $('.js_logo1').fadeIn();
            }
            else {
                $('.js_logo1').fadeOut();
            }
        });

        $(".js_logo1").click(function() {
            $("html, body").animate({ scrollTop: 0 });
            return false;
        });
    });