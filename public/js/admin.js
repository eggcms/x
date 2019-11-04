$(document).ready(function() {


   $('.tAdd').click(function () {
      if ($('#tag').val()) {
         $('#tag').val($('#tag').val()+', '+ this.value);
      }
      else {
         $('#tag').val($('#tag').val()+this.value);
      }
      $(this).hide();
   });



   $('.alert[data-auto-dismiss]').each(function (index, element) {
      var $element = $(element),
          timeout  = $element.data('auto-dismiss') || 5000;

      setTimeout(function () {
          $element.alert('close');
      }, timeout);
   });

   $(".close").click(function() {
      clearInterval(delay);
      $("#alert-x").slideUp();
   });


    $(".open_create_user").click(function() {
      $("#create_user").slideToggle();
    });

    $(".open_create_page").click(function() {
      $("#create_page").slideToggle();
    });

    $(".open_create_group").click(function() {
      $("#create_group").slideToggle();
    });
    $(".open_create_review").click(function() {
      $("#create_review").slideToggle();
    });
    $(".open_create_league").click(function() {
      $("#create_league").slideToggle();
    });    
    $(".open_create_result").click(function() {
      $("#create_result").slideToggle();
    });
    $(".open_create_setup").click(function() {
      $("#create_setup").slideToggle();
    }); 
});

function on() {
  document.getElementById("overlay").style.display = "block";
}
function off() {
  document.getElementById("overlay").style.display = "none";
}
{/* <div id="overlay" onclick="off()"><div id="text">Overlay Text</div></div> */}
