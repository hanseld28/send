function is_cpf (c) {

      if((c = c.replace(/[^\d]/g,"")).length != 11)
        return false

      if (c == "00000000000")
        return false;
      if (c == "11111111111")
        return false;
      if (c == "22222222222")
        return false;
      if (c == "33333333333")
        return false;
      if (c == "44444444444")
        return false;
      if (c == "55555555555")
        return false;
      if (c == "66666666666")
        return false;
      if (c == "77777777777")
        return false;
      if (c == "88888888888")
        return false;
      if (c == "99999999999")
        return false;

      var r;
      var s = 0;

      for (i=1; i<=9; i++)
        s = s + parseInt(c[i-1]) * (11 - i);

      r = (s * 10) % 11;

      if ((r == 10) || (r == 11))
        r = 0;

      if (r != parseInt(c[9]))
        return false;

      s = 0;

      for (i = 1; i <= 10; i++)
        s = s + parseInt(c[i-1]) * (12 - i);

      r = (s * 10) % 11;

      if ((r == 10) || (r == 11))
        r = 0;

      if (r != parseInt(c[10]))
        return false;

      return true;
    }


    function fMasc(objeto,mascara) {
      obj=objeto
      masc=mascara
      setTimeout("fMascEx()",1)
    }

    function fMascEx() {
      obj.value=masc(obj.value)
    }

    function mCPF(cpffunc){
      cpffunc=cpffunc.replace(/\D/g,"")
      cpffunc=cpffunc.replace(/(\d{3})(\d)/,"$1.$2")
      cpffunc=cpffunc.replace(/(\d{3})(\d)/,"$1.$2")
      cpffunc=cpffunc.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
      return cpffunc
    }

    cpfCheck = function (el) {
      document.getElementById('cpfResponse').innerHTML = is_cpf(el.value)? '<span style="color:green"> CPF Válido</span>' : '<span style="color:red"> CPF Inválido</span>';
      if(el.value=='') document.getElementById('cpfResponse').innerHTML = '';
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function is_cpf (c) {

      if((c = c.replace(/[^\d]/g,"")).length != 11)
        return false

      if (c == "00000000000")
        return false;
      if (c == "11111111111")
        return false;
      if (c == "22222222222")
        return false;
      if (c == "33333333333")
        return false;
      if (c == "44444444444")
        return false;
      if (c == "55555555555")
        return false;
      if (c == "66666666666")
        return false;
      if (c == "77777777777")
        return false;
      if (c == "88888888888")
        return false;
      if (c == "99999999999")
        return false;

      var r;
      var s = 0;

      for (i=1; i<=9; i++)
        s = s + parseInt(c[i-1]) * (11 - i);

      r = (s * 10) % 11;

      if ((r == 10) || (r == 11))
        r = 0;

      if (r != parseInt(c[9]))
        return false;

      s = 0;

      for (i = 1; i <= 10; i++)
        s = s + parseInt(c[i-1]) * (12 - i);

      r = (s * 10) % 11;

      if ((r == 10) || (r == 11))
        r = 0;

      if (r != parseInt(c[10]))
        return false;

      return true;
    }


    function fMasc(objeto,mascara) {
      obj=objeto
      masc=mascara
      setTimeout("fMascEx()",1)
    }

    function fMascEx() {
      obj.value=masc(obj.value)
    }

    function mCPF(cpfResponsavel){
      cpfResponsavel=cpfResponsavel.replace(/\D/g,"")
      cpfResponsavel=cpfResponsavel.replace(/(\d{3})(\d)/,"$1.$2")
      cpfResponsavel=cpfResponsavel.replace(/(\d{3})(\d)/,"$1.$2")
      cpfResponsavel=cpfResponsavel.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
      return cpfResponsavel
    }

    cpfCheck = function (el) {
      document.getElementById('cpfResponse').innerHTML = is_cpf(el.value)? '<span style="color:green"> CPF Válido</span>' : '<span style="color:red"> CPF Inválido</span>';
      if(el.value=='') document.getElementById('cpfResponse').innerHTML = '';
    }
