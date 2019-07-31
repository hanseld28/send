$(document).ready(function (){

    /* Efeitos na label*/
    
    $("input").on("focus", function(event) {
    const div = $(this).parent(".caixaLabels");
    const label = div.children("label");
    
    label.css("margin-top", "-18%");
  });
  
  $("input").on("blur", function(event) {
    const div = $(this).parent(".caixaLabels");
    const label = div.children("label");
    
    if ($(this).val().length == 0) {
      label.css("margin-top", "-10%");
    }
  });

  /* fim efeitos na label*/
});