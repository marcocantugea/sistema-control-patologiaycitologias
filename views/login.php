<div class="text-center m-2 p-2">
    <h2 class="h2"><?php echo $model['appName'];?></h2>
</div>
<form method="POST" action="usuarios/login">
  <div class="form-group m-3">
    <label for="usuariotxt">Usuario</label>
    <input type="text" class="form-control" id="usuariotxt" name="usuario" aria-describedby="emailHelp">
  </div>
  <div class="form-group m-3">
    <label for="passwordtxt">Password</label>
    <input type="password" class="form-control" id="passwordtxt" name="password" >
  </div>
  <br/>
  <div class="text-center">
    <button type="submit" class="btn btn-lg btn-primary">Entrar al sistema</button>
  </div>
  
</form>