function validar(btn){
    if((btn!='Eliminar') || (btn!='Cancelar'))
    {
        if(document.form.frm_rut.value=="")
        {
            alert("Debe Ingresar el RUT");
            document.form.frm_rut.focus();
            return false;
        }else{
            if(!Fn.validaRut(document.form.frm_rut.value))
            {
                alert("RUT PNK");
                document.form.frm_rut.focus();
                return false;
            }
        }
        if(document.form.frm_estado.value==3)
        {
            alert("Debe seleccionar un estado");
            document.form.frm_estado.focus();
            return false;
        }
        if(document.form.frm_nombres.value=="")
        {
            alert("Debe ingresar los nombres");
            document.form.frm_nombres.focus();
            return false;
        }
        if(document.form.frm_apellidos.value=="")
        {
            alert("Debe ingresar los apellidos");
            document.form.frm_apellidos.focus();
            return false;
        }

        if(document.form.frm_usuario.value=="")
        {
            alert("Debe ingresar el usuario");
            document.form.frm_usuario.focus();
            return false;
        }else{
            if(!validateEmail())
            {
                alert("USUARIO PNK");
                document.form.frm_usuario.focus();
                return false;
            }
        }
        if(document.form.frm_tipo.value==0)
        {
            alert("Debe seleccionar un tipo");
            document.form.frm_tipo.focus();
            return false;
        }

        if(btn=='Ingresar')
        {
            if(document.form.frm_clave1.value=="")
            {
                alert("Debe Ingresar la Clave");
                document.form.frm_clave1.focus();
                return false;
            }
            if(document.form.frm_clave2.value=="")
            {
                alert("Debe ingresar la Repetición de la Clave");
                document.form.frm_clave2.focus();
                return false;
            }

            if(document.form.frm_clave1.value!=document.form.frm_clave2.value)
            {
                alert("Las Claves son Penkas");
                document.form.frm_clave1.value="";
                document.form.frm_clave2.value="";
                document.form.frm_clave1.focus();
                return false;
            }
        }
    }

   document.form.accion.value=btn;
   document.form.submit();
}

var Fn = {
    // Valida el rut con su cadena completa "XXXXXXXX-X"
    validaRut : function (rutCompleto) {
        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
            return false;
        var tmp 	= rutCompleto.split('-');
        var digv	= tmp[1]; 
        var rut 	= tmp[0];
        if ( digv == 'K' ) digv = 'k' ;
        return (Fn.dv(rut) == digv );
    },
    dv : function(T){
        var M=0,S=1;
        for(;T;T=Math.floor(T/10))
            S=(S+T%10*(9-M++%6))%11;
        return S?S-1:'k';
    }
}

function validateEmail(){
    var emailField = document.getElementById('frm_usuario');
    var validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
    if( validEmail.test(emailField.value) ){
        return true;
    }else{
        return false;
    }
} 



function cargar_grilla()
{
    $.ajax({
        type: "POST",
        url: 'grilla_usuarios.php',
        data: 'txt='+$("#frm_txt").val(),
        success: function(response)
        {
            $("#caja_grilla").html(response);      
        }
   });
}