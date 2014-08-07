$(function(){
$(window).bind('scroll', {
    fixedOffsetBottom: parseInt($('#Fixed').css('bottom'))
},
function(e) {
    var scrollTop = $(window).scrollTop();
    scrollTop > 100 ? $('#goTop').show() : $('#goTop').hide();
    if (!/msie 6/i.test(navigator.userAgent)) {
            $('#Fixed').css('bottom', e.data.fixedOffsetBottom)
    }
});
$('#goTop').click(function() {
    $('body,html').stop().animate({
        'scrollTop': 0,
        'duration': 100,
        'easing': 'ease-in'
    })
});
});