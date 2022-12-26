showMessage();

function showMessage(){
	if ( sessionStorage.type=="success" ) {
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

function getBooksList(id,ref_no){
    $.ajax({
            method: "POST",
            url: "book_edit_details.php",
            data: {'location_id': id,'ref_no': ref_no},
            success: function(res) {
               // alert(res);
                $('#tbl_case_law').html(res);
                $('#case_law').DataTable();
                //update();
                //$('#detailsModal_27').modal('hide');

            }
        })
}


function closeAlertBox(){
window.setTimeout(function () {
$("#alert_msg").fadeOut(300)
}, 3000);
}
