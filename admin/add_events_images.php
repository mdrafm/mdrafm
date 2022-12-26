<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    $db = new Database();
    ?>
    <style type="text/css">
        .imgdiv{
            display: flex;
            justify-content: space-around;
            align-items: center;
            background: lightsteelblue;
            padding: 5px;
        }
    </style>
</head>

<body class="user-profile">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="wrapper ">

        <?php include('sidebar.php'); ?>

        <div class="main-panel" id="main-panel">
            <?php include('navbar.php'); ?>

            <div class="panel-header panel-header-sm">


            </div>


            <div class="content" style="margin-top: 50px;">


                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="card-title">Add Images For Events </h4>
                                    </div>

                                </div>


                            </div>
                            <div class="card-body">
                                <form id="eventImages" method="post" enctype="multipart/form-data">
                                    <div class="row" style="margin-top:20px;">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-2">
                                                    <label><strong>Title</strong></label>
                                                </div>
                                                <div class="col-md-7">
                                                  <?php
                                                     $db->select_one('tbl_other_event','title',$_POST['id']);

                                                     foreach($db->getResult() as $row){
                                                         echo $row['title'];
                                                     }
                                                  ?>

                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-2">
                                                    <label><strong>Images</strong></label>
                                                </div>
                                                <div class="col-md-4">
                                                <input type="file" name="evntsImage[]" id="descrDoc" class="form-control"
                                                     style="opacity: 1;position: unset;height: 85%;border-radius: 5px;" multiple>

                                                </div>


                                            </div>
                                        </div>
                                        <input type="hidden" name="update_id" value="<?php echo $_POST['id']; ?>" />
                                        <input type="hidden" name="action"  value="eventImages" />
                                    </div>
                                    <div class="col-md-2" style="float:right">
                                        <!-- <input type="button" class="btn btn-primary" id="save" value="Add"
                                            onclick="add('Other Program','program','tbl_other_event',<?php echo $_POST['id']; ?>)"
                                            style="margin-top: 0px" /> -->
                                             <input type="submit" class="btn btn-primary" id="addImage" value="Add" />
                                            
                                          
                                           <!-- <button class="btn btn-primary" id="save">Add</button> -->
                                    </div>

                                </form>
                                <input type="hidden" name="update_id" id="update_id" />
                            </div>
                        </div>

                    </div>

                </div>

                <div >
                    <h3>Images</h3>
                    <div class="imgdiv">
                    <?php
                        $db->select_one('tbl_other_event','title,images',$_POST['id']);

                        foreach($db->getResult() as $evnts){
                            if($evnts['images'] != ''){
                                $eventImages= explode( ',', $evnts['images']);
                               
                                foreach($eventImages as $image){
                                    // echo $image;
                                    ?>
                                         <div class="img" style="width:30%;margin: 2px; position:relative " >
    
                                             <img src="../images/event_images/<?php echo trim($image) ?>" alt="images" >
                                             <button class="btn btn-danger" style="position: absolute;left: 50%;bottom: 10px" 
                                                onclick="cnfBox(<?php echo $_POST['id']; ?>,'<?php echo  $evnts['images'] ?>','<?php echo $image ; ?>')" >
                                             <i class="far fa-trash-alt " style="font-size:1.5rem;"></i>
                                                                    
                                            </button>
                                            <!-- <a href="#" style="color:#4164b3" class="edit"
                                            onclick="cnfBox(<?php echo $_POST['id']; ?>,<?php echo json_encode($eventImages); ?>,'<?php echo $image ; ?>')" >
                                                                <i class="far fa-edit " style="font-size:1.5rem;"></i></a> -->
                                                                    
        
                                         </div>
                                    <?php
                                }
                            }
                            
                        }
                    ?>
                       

                    </div>

                </div>

            </div>


        </div>

    </div>

    </div>

    </div>

    <!-- msgBox Modal Modal HTML -->
    <div id="cnfModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="width:100%; margin:20px -80px">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="m_title" style="text-align:center;">Remove Image </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="warning">
                            <p>Are you sure you want to remove this Image?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div>
                        <p id="m_body"></p>
                    </div>
                    <div class="modal-footer" id="m_footer">


                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <?php include('common_script.php') ?>

</body>

</html>

<script type="text/javascript">

$('#eventImages').on('submit', function(e){
   e.preventDefault();
   $.ajax({
	url: "ajax_otherProgram.php",
	type: "POST",
	data:  new FormData(this),
	contentType: false,
	cache: false,
	processData:false,
	success: function(res){
	console.log(res);
        let elm = res.split('#');
            if (elm[0] == "success") {
                sessionStorage.message = 'Image' + ' ' + elm[1];
                sessionStorage.type = "success";
                location.reload();
            }
	},
	error: function(){} 	        
});
})


function cnfBox(id,img,imgId) {
    //alert(id);
    let photo = img.split(',');
    console.log(imgId);
     console.log(photo);
     let new_photo = photo.filter((item)=>{
         return item !== imgId;
     })
     
     console.log(new_photo);
    $('#m_footer').empty();
    var html =
        `<input type="button" class="btn btn-danger btn-dlt" value="Remove" onclick="remove_img(${id},'${new_photo}','${imgId}')" />
        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">`;
    $('#m_footer').append(html);
    $('#cnfModal').modal('show');
}

function remove_img(id,new_photo,imgId) {
    console.log(new_photo);
    $.ajax({
        type: "POST",
        url: "ajax_otherProgram.php",
        data: {

            action: "remove_img",
            id: id,
            imgId:imgId,
            new_photo:new_photo,
            table: 'tbl_other_event'
        },
        success: function(res) {
            console.log(res);
            let elm = res.split('#');
            if (elm[0] == "success") {
                sessionStorage.message = 'Image' + ' ' + elm[1];
                sessionStorage.type = "success";
                location.reload();
            }
        }
    })
}

function view(id) {
    $('#m_body').html('');
    $.ajax({
        type: "POST",
        url: "ajax_otherProgram.php",
        data: {

            action: "view",
            id: id,
            table: 'tbl_other_event'
        },
        success: function(res) {
            console.log(res);
            $('#m_body_view').html(res);
            $('#viewModal').modal('show');
        }
    })
}

function datapost(path, params, method) {
    //alert(path);
    method = method || "post"; // Set method to post by default if not specified.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
    for (var key in params) {
        if (params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();
}
</script>