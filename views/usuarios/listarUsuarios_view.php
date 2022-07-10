<?php

use app\Handlers\Encryptor;

 require("./views/headers.php"); ?>
<h1> Lista de usuarios </h1>
<p>Usuarios dados de alta en el sistema</p>

<div id="listadoUsuarios">
<table id="tablaUsuarios" class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Usuario</th>
            <th scope="col">email</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $counterRow=1;
        foreach ($model['listaUsuarios'] as $key => $user) {
        ?>
        <tr id="row_<?php echo $counterRow?>">
            <td><?php echo $counterRow?></td>
            <td><?php echo $user->user ?></td>
            <td><?php echo $user->email ?></td>
            <td>
                <input type="hidden" id="del_<?php echo Encryptor::encryptInfo($user->_id->__toString())?>" value="<?php echo Encryptor::encryptInfo(base64_encode($user->_id->__toString().":token:".$counterRow))?>" />
                <button class="btn btn-danger btn-sm" onclick="Usuarios.ConfirmacionBorrarUsuario(<?php echo $counterRow?>,'<?php echo Encryptor::encryptInfo($user->_id->__toString())?>','<?php echo Encryptor::encryptInfo(base64_encode($user->_id->__toString().":token:".$counterRow))?>')">Eliminar</button>
                <button class="btn btn-primary btn-sm" onclick="Usuarios.renderShowNuevaContrasenaModal('<?php echo Encryptor::encryptInfo($user->_id->__toString())?>','<?php echo Encryptor::encryptInfo(base64_encode($user->_id->__toString().":token:".$counterRow))?>')">Reiniciar Contraseña</button>
            </td>
        </tr>
        <?php 
        $counterRow++;
        } 
        ?>
    </tbody>
</table>
</div>

<div id="reiniciarContraseniaModal" class="modal" style="width: 300px; height: 200px;">
    <form class="form text-center">
        <label class="form-contol" for="nuevaContrasena">Nueva Contraseña</label>
        <input class="form-control" type="password" id="nuevaContrasena" value="" />
        <input type="hidden" id="id_modcon" value="">
        <input type="hidden" id="word_modcon" value="">
        <br/>
        <button type="button" class="btn btn-primary btn-lg" id="upd_contrasena" onclick="Usuarios.actualizaContrasena();" >Actualizar</button>
    </form>
</div>

<?php require("./views/messages_boards.php")?>
<script type="text/javascript" src="<?php echo $this->getPathJs() ?>/usuarios.js"></script>
<?php require("./views/footer.php"); ?>