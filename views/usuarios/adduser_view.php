<?php require("./views/headers.php"); ?>
<h1> Formulario de alta de usuarios </h1>
<p>este es el modulo de alta de usuarios</p>

<div>
    <span><?php echo $model['usuario'];?></span>
</div>
<?php if(!empty($sessionUser)){ ?>
    <p>
    <?php 
        echo $_SESSION['variable'];
    ?>
    </p>
<p>
    <?php 
    echo app\Application::getSessionVariable('variable');
    ?>
</p>
<table>
    <tbody>
        <tr>
            <th>dato</th>
        </tr>
        <?php foreach($model['datos'] as $dato){ ?>
        <tr>
            <td><?php echo $dato?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php }?>
<?php require("./views/footer.php");?>