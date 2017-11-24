$("#poems_anchor").click(function() {
   $('html,body').animate({scrollTop: $('#poems').offset().top}, 1000, function(){
     $('#presentation').remove();
   });
});
