let selectedrow=0;
let selecteditem='';
let selectdword='';

$('#MessageBoardYesConfirm').click(function(){
    Usuarios.eliminarUsuario(selectedrow,selecteditem,selectdword);
});
var Usuarios = {
    addUsuario:function(usuario,email,password){
        return new Promise((resolve,reject)=>{
            var uri = "/usuarios/add";
            let object={
                user:usuario,
                email:email,
                password,password
            }
            $.ajax(
                {
                    type: 'post',
                    url: uri,
                    data: JSON.stringify(object),
                    processData: false,
                    success: function (response) {
                        try {
                            return resolve(response);
                        }
                        catch (e) {

                            return reject(e);
                        }
                    },
                    complete: function () {
                        MessageBoard.closeModal();
                    },
                    beforeSend: function () {
                        MessageBoard.showLoadingBoard();
                    },
                    error: function(error){
                        return reject(error);
                    }
                }
            );	
        });
    },
    delteUsuario:function(id,word){
        return new Promise((resolve,reject)=>{
            var uri = "/usuarios/delete";
            let object={
                id:id,
                word:word
            }
            $.ajax(
                {
                    type: 'delete',
                    url: uri,
                    data: JSON.stringify(object),
                    processData: false,
                    success: function (response) {
                        try {
                            return resolve(response);
                        }
                        catch (e) {

                            return reject(e);
                        }
                    },
                    complete: function () {
                        MessageBoard.closeModal();
                    },
                    beforeSend: function () {
                        MessageBoard.showLoadingBoard();
                    },
                    error: function(error){
                        return reject(error);
                    }
                }
            );	
        });
    },
    updatePassword:function(id,word,newpass){
        return new Promise((resolve,reject)=>{
            var uri = "/usuarios/password";
            let object={
                id:id,
                word:word,
                newpass:newpass
            }
            $.ajax(
                {
                    type: 'put',
                    url: uri,
                    data: JSON.stringify(object),
                    processData: false,
                    success: function (response) {
                        try {
                            return resolve(response);
                        }
                        catch (e) {

                            return reject(e);
                        }
                    },
                    complete: function () {
                        MessageBoard.closeModal();
                    },
                    beforeSend: function () {
                        MessageBoard.showLoadingBoard();
                    },
                    error: function(error){
                        return reject(error);
                    }
                }
            );	
        });
    },
    agregaUsuario:function() {
        Usuarios.renderCloseAllMessages();
        let usuario= $('#usertxt').val();
        let email=$('#emailtxt').val();
        let password=$('#passwordtxt').val();
        Usuarios.addUsuario(usuario,email,password)
        .then((response)=>{
            if(response.success==false){
                Usuarios.renderShowFailMessage(response.message);
                return;
            }
            Usuarios.renderShowSuccesMessage(response.message);
            Usuarios.cleanFields();
        })
        .catch((error)=>{
            Usuarios.renderShowFailMessage(error);
            console.log(error);
            
        });
    },
    eliminarUsuario:function(row,id,word){
      
        Usuarios.delteUsuario(id,word)
        .then((response)=>{
            if(!response.success){
                MessageBoard.showErrorBoard('Error Eliminar Usuario',response.message);
                return;
            }
            //borramos fila de la tabla
            Usuarios.renderEliminaFilaUsuario(row);
            MessageBoard.closeModal();
        })
        .catch((error)=>{
            console.log(error.statusText);
            MessageBoard.showErrorBoard('Error de comunicaciones','favor de intentar mas tarde');
            return;
        });
    },
    actualizaContrasena:function(){
        let id=$('#id_modcon').val();
        let word=$('#word_modcon').val();
        let newpass=$('#nuevaContrasena').val();

        Usuarios.updatePassword(id,word,newpass)
        .then((response)=>{
            if(!response.success){
                MessageBoard.showErrorBoard('Error al modificar el usuario',response.message);
                return;
            }
            MessageBoard.showConfirmBoard("Actualizacion exitosa","Se actualizo la contraseña con exito.");
        })
        .catch((error)=>{
            console.log(error);
            MessageBoard.showErrorBoard('Error de comunicaciones','favor de intentar mas tarde');
            return;
        });
    },
    renderShowSuccesMessage: function(mensaje){
        $('#messageSuccess').text(mensaje);
        $('#sucessMessageDiv').show();
    },
    renderHideSuccesMessage: function(){
        $('#sucessMessageDiv').hide();
    },
    renderShowFailMessage: function(mensaje){
        $('#messageFail').text(mensaje);
        $('#failMessageDiv').show();
    },
    renderHideSuccesMessage: function(){
        $('#failMessageDiv').hide();
    },
    renderCloseAllMessages:function(){
        $('#failMessageDiv').hide();
        $('#sucessMessageDiv').hide();
    },
    renderEliminaFilaUsuario:function(row){
        $('#tablaUsuarios tr#row_'+row).remove();
    },
    renderShowNuevaContrasenaModal: function(id,word){
        $('#id_modcon').val(id);
        $('#word_modcon').val(word);
        $('#reiniciarContraseniaModal').modal();
    },
    ConfirmacionBorrarUsuario(row,id,word){
        selectedrow=row;
        selecteditem=id;
        selectdword=word;
        MessageBoard.showYesNoBoard('¿Desea eliminar al usuario?')
    },
    cleanFields:function(){
        $('input').val('');
    }
}