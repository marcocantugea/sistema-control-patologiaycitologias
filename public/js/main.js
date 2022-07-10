var MessageBoard ={
    showLoadingBoard:function(){
        $('#loadingMessageBoard').modal({
            escapeClose: false,
            clickClose: false,
            showClose: false
        });
       return false;

    },
    showYesNoBoard:function(message){
        $('#yesNoMessageText').text(message);
        $('#yesNoMessageBoard').modal({
            escapeClose: false,
            clickClose: false,
            showClose: false
        });
        return false;
    },
    showWarningBoard: function(title,text){
        $('#WarningMessageBoardTitle').text(title);
        $('#WarningMessageBoardText').text(text);
        $('#WaringMessageBoard').modal({
            escapeClose: false,
            clickClose: false
        });
    },
    showErrorBoard: function(title,text){
        $('#ErrorMessageBoardTitle').text(title);
        $('#ErrorMessageBoardText').text(text);
        $('#ErrorMessageBoard').modal({
            escapeClose: false,
            clickClose: false
        });
    },
    showConfirmBoard: function(title,text){
        $('#ConfirmMessageBoardTitle').text(title);
        $('#ConfirmMessageBoardText').text(text);
        $('#ConfirmMessageBoard').modal({
            escapeClose: false,
            clickClose: false
        });
    },
    closeModal:function(){
        $.modal.close();
    }   
}