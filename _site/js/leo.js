$(function () {
  $("a").on('click', function(event) {
    var selector = this.href.replace(/[^#]+#/, '');
    var target = $('#' + selector);
    if(target.length) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: target.offset().top
        }, 1000);
    }
  });

  $('.antiscroll-wrap').antiscroll({
    autoHide: false
  });
});