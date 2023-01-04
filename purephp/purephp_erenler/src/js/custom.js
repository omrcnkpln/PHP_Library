$(document).ready(function () {
    // _____________________________ mobil menu _____________________________________________________________
    var menu_ac = $("#menu_ac");
    var menu_kapat = $("#menu_kapat");
    var m_section = $("#menu_section");
    var submenu_button = $("#submenu_button_container li");
    var menu_3 = $("#menu_3");
    // var a = 0, e = 0, l = 0;

    $('#menu_ac, .overlay').click(function () {
        w = window.innerWidth;
        if (w > 1200) {
            submenu_button.removeClass('active').find('ul').hide();
            m_section.hide(333);
            $('.overlay').removeClass('show');
            $('body').removeClass('overflow');

            if (menu_3.hasClass("fadeInDown_2")) {
                menu_3.addClass("fadeOutUp_2").removeClass("fadeInDown_2");
            }
            else {
                menu_3.addClass("fadeInDown_2").removeClass("fadeOutUp_2");
            }
            // menu_3.toggle(333);
        }
        else {
            if (!$(m_section).hasClass("active")) {
                $(m_section).addClass('active').removeClass('');
                $('.overlay').addClass('show');
                $('body').addClass('overflow');
            }
            else {
                $(m_section).addClass('').removeClass('active');
                $('.overlay').removeClass('show');
                $('body').removeClass('overflow');
            }

            menu_kapat.click(function () {
                $(m_section).addClass('').removeClass('active');
                $('.overlay').removeClass('show');
                $('body').removeClass('overflow');
            });

            submenu_button.removeClass('active').find('ul').hide();

        }
    });


    // _____________________________ mobil menunun submenusu _____________________________________________________________
    var blue_2 = "#1a73e8";
    submenu_button.click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(this).find("ul").hide(333);
        }
        else {
            $(this).addClass('active');
            $(this).find("ul").show(333);
            $(this).siblings().removeClass('active').find("ul").hide(333);
        }
    });
});