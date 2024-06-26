$(function() {
    $("#contenedor").hide();
    $("#menos").hide();
    $("#btningresar").prop( "disabled", true);
    $("#ok").hide();
    $("#pnk").hide();
    $("#okp").hide();
    $("#pnkp").hide();

    $("#mas").on( "click", function() {
      $("#contenedor").show('slow');
      $("#menos").show('slow');
      $("#mas").hide('slow');
    });

    $("#menos").on( "click", function() {
      $("#contenedor").hide('slow');
      $("#menos").hide('slow');
      $("#mas").show('slow');
    });

      $('#frmrut').Rut({
        on_error: function(){ alert('Rut incorrecto'); },
        format_on: 'keyup'
      });

      $("#email").on( "blur", function() {
        buscaremail();
      });

      $("#pwd").on( "blur", function() {
        buscaremailpsw();
      });
  });

  function validar()
  {
      if(document.form.email.value=="")
      {
          alert("Debe Ingresar el Usuario");
          document.form.email.focus();
          return false;
      }
      if(document.form.pswd.value=="")
      {
          alert("Debe Ingresar la contraseña");
          document.form.pswd.focus();
          return false;
      }

      document.form.submit();
  }


  function buscaremail()
  {
    $.ajax({
        type: "POST",
        url: 'validarusuario.php',
        data: 'usu='+$("#email").val(),
        success: function(response)
        {
           if(response==1)
            {
                $("#ok").show();
                $("#pnk").hide();
            }else{
                $("#ok").hide();
                $("#pnk").show();
                $("#email").focus();
            }
       }
   });
}

   function buscaremailpsw()
  {
    $.ajax({
        type: "POST",
        url: 'validarusuario.php',
        data: 'usu='+$("#email").val()+'&pas='+$("#pwd").val(),
        success: function(response)
        {
           if(response==1)
            {
                $("#okp").show();
                $("#pnkp").hide();
                $("#btningresar").prop( "disabled", false);
            }else{
                $("#okp").hide();
                $("#pnkp").show();
                $("#pwd").val("");
            }
       }
   });
  }