$("#poems_anchor").click(function() {
   $('html,body').animate({scrollTop: $('#poems').offset().top}, 1000, function(){
     window.location.href = "http://suapoesia-com-br.umbler.net/poems.php";
   });
});
$('#select-filter').change(function () {
  $(this).closest('form').submit();
});


$("#new_user").click(function() {
  window.location.href = "http://suapoesia-com-br.umbler.net/new_user.php";
}
$("#login").click(function() {
  window.location.href = "http://suapoesia-com-br.umbler.net/login.php";
}


$("#submit-login").click(function() {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var email = $('#email-login').val();
  result = regex.test(email);
  if(result == true){
    return true;
  } else {
    alert("Email inválido");
    return false;
  }

});

$("#submit-signup").click(function() {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var email = $('#email-signup').val();
  result = regex.test(email);
  if(result == true){
    return true;
  } else {
    alert("Email inválido");
    return false;
  }
});

var showChar = 200;
var ellipsestext = "...";
var moretext = "Mostrar mais >";
var lesstext = "Mostrar menos";


$('.more').each(function() {
    var content = $(this).html();
    if(content.length > showChar) {
        var c = content.substr(0, showChar);
        var h = content.substr(showChar, content.length - showChar);
        var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a id="moretext" href="" class="morelink">' + moretext + '</a></span>';
        $(this).html(html);
    }
});

$(".morelink").click(function(){
  if($(this).hasClass("less")) {
      $(this).removeClass("less");
      $(this).html(moretext);
  } else {
      $(this).addClass("less");
      $(this).html(lesstext);
  }
  $(this).parent().prev().toggle();
  $(this).prev().toggle();
  return false;
});
