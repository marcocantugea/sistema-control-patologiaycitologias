<?php require("./views/headers.php"); ?>
<h1> Alta de usuarios </h1>
<p>Formulario para alta de usuarios del sistema</p>

<form>
  <div class="form-group">
    <label for="usertxt">Nombre de Usuario</label>
    <input id="usertxt" name="usertxt" type="text" required="required" class="form-control">
  </div>
  <div class="form-group">
    <label for="emailtxt">email</label>
    <input id="emailtxt" name="emailtxt" type="email" required="required" class="form-control">
  </div>
  <div class="form-group">
    <label for="passwordtxt">Contraseña</label>
    <input id="passwordtxt" name="passwordtxt" type="password" required="required" class="form-control">
  </div>
  <div class="form-group text-center">
    <button name="submit" type="button" onclick="Usuarios.agregaUsuario();" class="btn btn-primary">Agregar usuario</button>
  </div>
</form>
<div id="sucessMessageDiv" class="alert alert-success" role="alert">
  <span id="messageSuccess">here goes the message</span>
</div>
<div id="failMessageDiv" class="alert alert-danger" role="alert">
  <span id="messageFail">here goes the message</span>
</div>
<?php require("./views/messages_boards.php")?>
<script type="text/javascript">
  $(document).ready(function() {

    $('#sucessMessageDiv').hide();
    $('#failMessageDiv').hide();

  });
</script>
<script type="text/javascript" src="<?php echo $this->getPathJs() ?>/usuarios.js"></script>
<?php require("./views/footer.php"); ?>