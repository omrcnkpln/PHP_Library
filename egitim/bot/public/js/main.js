$(document).ready(function () {
    // jQuery(".section-title-holder").stick_in_parent({offset_top: 64}).on("sticky_kit:stick", function (e) {
    //     jQuery('.menu-wrapper, .menu-wrapper .sub-menu').css('backgroundColor', jQuery(this).css("backgroundColor"));
    //     jQuery('.menu-wrapper a, .mob-menu').css('color', jQuery(this).find('.section-num span').css("color"));
    // });
    //
    // jQuery(".section-title-holder").stick_in_parent({offset_top: 64}).on("sticky_kit:unbottom", function (e) {
    //     jQuery('.menu-wrapper, .menu-wrapper .sub-menu').css('backgroundColor', jQuery(this).css("backgroundColor"));
    //     jQuery('.menu-wrapper a, .mob-menu').css('color', jQuery(this).find('.section-num span').css("color"));
    // });
    //
    //
    // //Placeholder show/hide
    // jQuery('input, textarea').focus(function () {
    //     jQuery(this).data('placeholder', jQuery(this).attr('placeholder'));
    //     jQuery(this).attr('placeholder', '');
    // });
    // jQuery('input, textarea').blur(function () {
    //     jQuery(this).attr('placeholder', jQuery(this).data('placeholder'));
    // });
    //
    //
    // //Portfolio
    // var grid = jQuery('.grid').imagesLoaded(function () {
    //     grid.isotope({
    //             itemSelector: '.grid-item',
    //             masonry: {
    //                 columnWidth: '.grid-sizer'
    //             }
    //         }
    //     );
    //     //Fix for portfolio item text
    //     jQuery('.portfolio-text-holder').each(function () {
    //         jQuery(this).find('.portfolio-text-wrapper').css('margin-top', (jQuery(this).height() - jQuery(this).find('.portfolio-text-wrapper').height()) / 2 - 70);
    //     });
    //
    //     //Fix for portfolio hover text fade in/out
    //     jQuery('.grid-item a').hover(function () {
    //         jQuery(this).find('.portfolio-text-holder').fadeIn('fast');
    //     }, function () {
    //         jQuery(this).find('.portfolio-text-holder').fadeOut('fast');
    //     });
    // });

});
//------------------------------------------------------------------------
//Helper Methods -->
//------------------------------------------------------------------------


// var showHideMobMenu = function (e) {
//     jQuery('.main-menu').slideToggle();
// };
//
// var hideMobMenuItemClick = function (e) {
//     if (jQuery('.mob-menu').is(':visible')) {
//         jQuery('.main-menu').slideUp();
//     }
// };

// function is_touch_device() {
//     alert();
//     return !!('ontouchstart' in window);
// }

// function isValidEmailAddress(emailAddress) {
//     var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
//     return pattern.test(emailAddress);
// }

// var SendMail = function () {
//
//     var emailVal = jQuery('#contact-email').val();
//
//     if (isValidEmailAddress(emailVal)) {
//         var params = {
//             'action': 'SendMessage',
//             'name': jQuery('#name').val(),
//             'email': jQuery('#contact-email').val(),
//             'subject': jQuery('#subject').val(),
//             'message': jQuery('#message').val()
//         };
//         jQuery.ajax({
//             type: "POST",
//             url: "php/sendMail.php",
//             data: params,
//             success: function (response) {
//                 if (response) {
//                     var responseObj = jQuery.parseJSON(response);
//                     if (responseObj.ResponseData) {
//                         alert(responseObj.ResponseData);
//                     }
//                 }
//             },
//             error: function (xhr, ajaxOptions, thrownError) {
//                 //xhr.status : 404, 303, 501...
//                 var error = null;
//                 switch (xhr.status) {
//                     case "301":
//                         error = "Yönlendirme Hatası!";
//                         break;
//                     case "307":
//                         error = "Hata, geçici sunucu yönlendirme!";
//                         break;
//                     case "400":
//                         error = "Geçersiz istek!";
//                         break;
//                     case "404":
//                         error = "Sayfa bulunamadı!";
//                         break;
//                     case "500":
//                         error = "Sunucu şu anda kullanılamıyor!";
//                         break;
//                     default:
//                         error = "Beklenmeyen hata, lütfen daha sonra tekrar deneyin.";
//                 }
//                 if (error) {
//                     alert(error);
//                 }
//             }
//         });
//     }
//     else {
//         alert('Email formatınız hatalı!');
//     }
//
//
// };

// var DemoMail = function () {
//
//     var emailVal = jQuery('#email').val();
//
//     if (isValidEmailAddress(emailVal)) {
//
//         var message = " <br/>";
//         if (jQuery('#BOYSWEB')[0].checked)
//             message += " BOYSWEB <br/>";
//         if (jQuery('#EBA')[0].checked)
//             message += " EBA <br/>";
//         if (jQuery('#QDMS')[0].checked)
//             message += " QDMS <br/>";
//         if (jQuery('#ENSEMBLE')[0].checked)
//             message += " ENSEMBLE <br/>";
//         if (jQuery('#OZEL')[0].checked)
//             message += " ÖZEL YAZILIM GELİŞTİRME <br/>";
//         var params = {
//             'action': 'SendMessage',
//             'name': jQuery('#name').val(),
//             'phone': jQuery('#phone').val(),
//             'email': jQuery('#email').val(),
//             'company': jQuery('#company').val(),
//             'position': jQuery('#position').val(),
//             'subject': "DEMO TALEP FORMU",
//             'message': message,
//
//         };
//
//         // console.log(params)
//
//         jQuery.ajax({
//             type: "POST",
//             url: "php/demoMail.php",
//             data: params,
//             success: function (response) {
//                 if (response) {
//                     var responseObj = jQuery.parseJSON(response);
//                     if (responseObj.ResponseData) {
//                         alert(responseObj.ResponseData);
//                     }
//                 }
//             },
//             error: function (xhr, ajaxOptions, thrownError) {
//                 //xhr.status : 404, 303, 501...
//                 var error = null;
//                 switch (xhr.status) {
//                     case "301":
//                         error = "Yönlendirme Hatası!";
//                         break;
//                     case "307":
//                         error = "Hata, geçici sunucu yönlendirme!";
//                         break;
//                     case "400":
//                         error = "Geçersiz istek!";
//                         break;
//                     case "404":
//                         error = "Sayfa bulunamadı!";
//                         break;
//                     case "500":
//                         error = "Sunucu şu anda kullanılamıyor!";
//                         break;
//                     default:
//                         error = "Beklenmeyen hata, lütfen daha sonra tekrar deneyin.";
//                 }
//                 if (error) {
//                     alert(error);
//                 }
//             }
//         });
//     }
//     else {
//         alert('Email formatınız hatalı!');
//     }
//
//
// };
