$(function(){
    $('.main_header_menu_mobile_obj').on('click', function(){
        $('.main_header_menu_mobile_sub1').toggleClass('ds_none');
        $(this).toggleClass('main_header_menu_mobile_active')
    });
});