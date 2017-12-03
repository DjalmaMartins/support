$(function(){
    
        //Controle do menu mobile
        $('.nav-mobile').click(function() {
            if(!$(this).hasClass('active')){
                $(this).addClass('active');
                $('.dm-nav').animate({'left': '0px'}, 300);
            }else{
                $(this).removeClass('active');
                $('.dm-nav').animate({'left': '-120%'}, 300);
            }
        });
    
        var action = setInterval(slideGo, 9000);
    
        $('.nav-slide.go').click(function() {
            slideGo();
            clearInterval(action);
            action = setInterval(slideGo, 9000);
        });
    
    
        $('.nav-slide.back').click(function() {
            slideBack();
            clearInterval(action);
            action = setInterval(slideGo, 9000);
        });
    
    
        function slideGo() {
            if($('.list-slide.first').next().size()){
                $('.list-slide.first').fadeOut(400, function(){
                    $(this).removeClass('first').next().fadeIn().addClass('first');
                });
            }else{
                $('.list-slide.first').fadeOut(400, function(){
                    $('.list-slide').removeClass('first');
                    $('.list-slide:eq(0)').fadeIn().addClass('first');
                });	
            }
        }
    
        function slideBack(){
            if($('.list-slide.first').index() > 1){
                $('.list-slide.first').fadeOut(400, function(){
                    $(this).removeClass('first').prev().fadeIn().addClass('first');
                });
            }else{
                $('.list-slide.first').fadeOut(400, function(){
                    $('.list-slide').removeClass('first');
                    $('.list-slide:last-of-type').fadeIn().addClass('first');
                });	
            }		
        }
    });
        //<![CDATA[
            $(window).on('load', function () {
                $('#preloader .inner').fadeOut(); 
                $('#preloader').delay(200).fadeOut('slow'); 
                $('body').delay(200).css({'overflow': 'visible'});
            })
        //]]>


