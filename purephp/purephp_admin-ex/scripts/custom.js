$(function(){

    $(window).scroll(function(){
        if($(this).scrollTop() > 200){
            $(".up_btn").fadeIn(500).css("border-radius", "10px");
        }else{
            $(".up_btn").fadeOut(500);
        }
    });

    jQuery(".up_btn").click(function(){
        $("body").animate({scrollTop: "0"},1500);
    });
// ************************************************************
var l_up = $("#l_up");
var l_down = $("#l_down");
var item_index = 0;
var item_length = $(".item").length-1;

    l_up.click(function () {
        item_index --;
        if(item_index >= 0){
            
            $('html, body').animate({
                scrollTop: $(".item").eq(item_index).offset().top
            }, 1000,);
        }else{
            item_index = 0;
            $('html, body').animate({
                scrollTop: $(".item").eq(item_index).offset().top
            }, 1000, 'swing');
        }
    });

    l_down.click(function () {
        item_index ++;
        if (item_index <= item_length) {
            $('html, body').animate({
                scrollTop: $(".item").eq(item_index).offset().top
            }, 1000);
        } else {
            item_index = item_length;
            $('html, body').animate({
                scrollTop: $(".item").eq(item_index).offset().top
            }, 'slow', 'swing');
        }
    });

});
