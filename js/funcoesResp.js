/*Função aparecer menu de notificacao*/
$( ".btnNotificaoLista, .centraldenotificacao" ).click(function(e) {
   e.stopPropagation(); // parar propagação ---
   $( '.centraldenotificacao' ).show(); //             |
});//                                         |
//                                            |
$(document).click(function(){ // <-------------
   $(".centraldenotificacao").hide();
});
/*FIM*/


/*Função aparecer menu de configurações*/
$( ".btnConfigResp, #menu-config" ).click(function(e) {
   e.stopPropagation(); // parar propagação ---
   $( '#menu-config' ).show(); //             |
});//                                         |
//                                            |
$(document).click(function(){ // <-------------
   $("#menu-config").hide();
});
/*FIM*/

