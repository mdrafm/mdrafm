showMessage();

function showMessage(){
	if ( sessionStorage.type=="success" ) {
        console.log(123);
        $('#alert_msg').show();
        //$('#btn_records_mtnc').show();
        //$('.toast-1').toast('show');
        $("#alert_msg").addClass("alert alert-secondary").html(sessionStorage.message);
        closeAlertBox();
       
        sessionStorage.removeItem("message");
        sessionStorage.removeItem("type");
    }
    if (sessionStorage.type == "error") {
        $('#alert_msg').show();
        $("#alert_msg").addClass("alert alert-danger").html(sessionStorage.message);
        closeAlertBox();
        sessionStorage.removeItem("message");
        sessionStorage.removeItem("type");
    }
}



function closeAlertBox(){
window.setTimeout(function () {
$("#alert_msg").fadeOut(300)
}, 3000);
}
