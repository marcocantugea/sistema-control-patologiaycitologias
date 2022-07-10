<div id="yesNoMessageBoard" class="modal" style="width: 300px; height: 150px;">
<table class="table text-center table-borderless">
    <tr>
        <td colspan="2">
            <span id="yesNoMessageText">Mensaje de si no </span>
        </td>
    </tr>
    <tr>
        <td>
            <button class="btn btn-success" id="MessageBoardYesConfirm">SI</button>
        </td>
        <td>
            <button class="btn btn-primary" id="MessageBoardNoConfirm">NO</button>
        </td>
    </tr>
</table>
</div>
<!-- <p><button id="testloading" >Open Modal</button></p>
<p><button id="closeLoading" >Close Modal</button></p> -->

<div id="loadingMessageBoard" class="modal" style="width: 300px; height: 150px;" data-toggle="modal" >
    <div class="text-center">
        <img src="<?php echo $this->getPathImages()?>/Spinner-1s-200px.gif" width="80" height="80"><br/>
        cargando...
    </div>
</div>
<div id="WaringMessageBoard" class="modal" style="width: 300px; height: 250px;" data-toggle="modal" >
    <div class="text-center">
        <img src="<?php echo $this->getPathImages()?>/waring_icon_1.png" width="80" height="80"><br/>
        <span id="WarningMessageBoardTitle" class="h4 text-warning">Title</span><br/><br/>
        <span id="WarningMessageBoardText" class="font-weight-light">Title</span><br/><br/>
        <button class="btn btn-primary" id="CloseAllModal">Cerrar</button>
    </div>
</div>
<div id="ErrorMessageBoard" class="modal" style="width: 300px; height: 300px;" data-toggle="modal" >
    <div class="text-center">
        <img src="<?php echo $this->getPathImages()?>/error_icon_1.png" width="80" height="80"><br/>
        <span id="ErrorMessageBoardTitle" class="h4 text-danger">Title</span><br/><br/>
        <span id="ErrorMessageBoardText" class="font-weight-light">Title</span><br/><br/>
        <button class="btn btn-primary" id="CloseAllModal">Cerrar</button>
    </div>
</div>
<div id="ConfirmMessageBoard" class="modal" style="width: 300px; height: 300px;" data-toggle="modal" >
    <div class="text-center">
        <img src="<?php echo $this->getPathImages()?>/confirm_icon_1.png" width="80" height="80"><br/>
        <span id="ConfirmMessageBoardTitle" class="h4 text-success">Title</span><br/><br/>
        <span id="ConfirmMessageBoardText" class="font-weight-light">Title</span><br/><br/>
        <button class="btn btn-primary" id="CloseAllModal">Cerrar</button>
    </div>
</div>
<script type="text/javascript">
    $('#testloading').click(function(){
        MessageBoard.showLoadingBoard()
    })
    $('#MessageBoardNoConfirm').click(function(){
        MessageBoard.closeModal()
    });
    $('button[id=CloseAllModal]').click(function(){
        MessageBoard.closeModal()
    })
</script>