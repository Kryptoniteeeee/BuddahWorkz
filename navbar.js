$(document).ready(function() {
  $('.navbar a.dropdown-toggle').on('click', function(e) {
    var elmnt = $(this).parent().parent();
    if (!elmnt.hasClass('nav')) {
      var li = $(this).parent();
      var heightParent = elmnt.height() / 2;
      var widthParent = elmnt.width() - 10;

      li.toggleClass('open').siblings().removeClass('open');
      $(this).next().css({
        top: heightParent + 'px',
        left: widthParent + 'px'
      });

      return false;
    }
  });
});
