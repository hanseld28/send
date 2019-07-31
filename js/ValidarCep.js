    $(document).ready(function () {
        // Método para pular campos teclando ENTER
        $('.pula').on('keypress', function(e){
            var tecla = (e.keyCode?e.keyCode:e.which);
 
            if(tecla == 13){
                campo = $('.pula');
                indice = campo.index(this);
 
                if(campo[indice+1] != null){
                    proximo = campo[indice + 1];
                    proximo.focus();
                    e.preventDefault(e);
                }
            }
        });
 
         // Inseri máscara no CEP
        $("#cepfunc").inputmask({
            mask: ["99999-999",],
            keepStatic: true
        });

        //    $("#cpf").inputmask({
        //     mask: ["999.999.999-99",],
        //     keepStatic: true
        // });
 
         // Método para consultar o CEP
        $('#cepfunc').on('blur', function(){
 
            if($.trim($("#cepfunc").val()) != ""){
 
                $("#mensagem").html('(Aguarde, consultando CEP ...)');
                $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cepfunc").val(), function(){
 
                    if(resultadoCEP["resultado"]){
                        $("#logradourofunc").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
                        $("#bairrofunc").val(unescape(resultadoCEP["bairrofunc"]));
                        $("#cidadefunc").val(unescape(resultadoCEP["cidade"]));
                        $("#uffunc").val(unescape(resultadoCEP["uffunc"]));
                    }
 
                    
                });             
            }           
        });
    }); 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $(document).ready(function () {
        // Método para pular campos teclando ENTER
        $('.pula').on('keypress', function(e){
            var tecla = (e.keyCode?e.keyCode:e.which);
 
            if(tecla == 13){
                campo = $('.pula');
                indice = campo.index(this);
 
                if(campo[indice+1] != null){
                    proximo = campo[indice + 1];
                    proximo.focus();
                    e.preventDefault(e);
                }
            }
        });
 
         // Inseri máscara no CEP
        $("#cepaluno").inputmask({
            mask: ["99999-999",],
            keepStatic: true
        });

        //    $("#cpf").inputmask({
        //     mask: ["999.999.999-99",],
        //     keepStatic: true
        // });
 
         // Método para consultar o CEP
        $('#cepaluno').on('blur', function(){
 
            if($.trim($("#cepaluno").val()) != ""){
 
                $("#mensagem").html('(Aguarde, consultando CEP ...)');
                $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cepaluno").val(), function(){
 
                    if(resultadoCEP["resultado"]){
                        $("#logradouroaluno").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
                        $("#bairroaluno").val(unescape(resultadoCEP["bairroaluno"]));
                        $("#cidadealuno").val(unescape(resultadoCEP["cidade"]));
                        $("#ufaluno").val(unescape(resultadoCEP["ufaluno"]));
                    }
 
                    
                });             
            }           
        });
    }); 
