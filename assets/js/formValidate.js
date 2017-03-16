$(function(){
    $('.contan button').mouseover(function(){
      if($('.contan button').attr('disabled')){
        $(this).removeAttr('disabled');
        }  
    })
});