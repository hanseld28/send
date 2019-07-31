/*Função aparecer menu de configurações*/
$( ".btn-configuracao, #menu-config" ).click(function(e) {
   e.stopPropagation(); // parar propagação ---
   $( '#menu-config' ).show(); //             |
});//                                         |
//                                            |
$(document).click(function(){ // <-------------
   $("#menu-config").hide();
});
/*FIM*/

