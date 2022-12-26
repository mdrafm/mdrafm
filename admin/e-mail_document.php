<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    $db = new Database();
    ?>

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
                                        <h4 class="card-title">Upload Essential Documents For Email </h4>
                                    </div>

                                </div>


                            </div>
                            <div class="card-body">
                                <div class="row" style="margin-top:20px;">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label><strong>Select Program</strong></label>
                                            </div>
                                            <div class="col-md-7">
                                                <select class="custom-select mr-sm-2" name="program" id="prgram_id">
                                                    <option value="0" selected>Select Program</option>
                                                    <?php 
                                                        
                                                        $count = 0;
                                                        $db->select('tbl_program_master',"*",null,"trng_type = 1 AND status ='approve'",null,null);
                                                        // print_r( $db->getResult());
                                                        foreach($db->getResult() as $row){
                                                            //print_r($row);
                                                            $count++
                                                        ?>
                                                    <option value="<?php echo $row['id'] ?>">
                                                        <?php echo $row['prg_name'] ?>
                                                    </option>

                                                    <?php 
                                                        }
                                                        ?>
                                                </select>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!-- Nav pills -->
                                <div id="show_div"></div>
                                
                            </div>
                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>

    </div>

    </div>

    <?php include('common_script.php') ?>

</body>

</html>

<script type="text/javascript">
$('#tranee_list').click(function() {

    let batch_id = $('#batch_id').val();
    $('#tranee_data').html('');
    $.ajax({
        type: 'POST',
        url: "ajax_search.php",
        data: {
            batch_id: batch_id,
            action: "tranee_list"
        },
        success: function(res) {
            //console.log(res);
            $('#tranee_data').html(res);
        }

    });
})

$('#prgram_id').change(function() {
    $('#doc_nav').show();
    let program_id = $('#prgram_id').val();
    if (prgram_id == 0) {
        $('#doc_nav').hide();
    }
    $.ajax({
        type: 'POST',
        url: "upload_email_doc.php",
        data: {
            program_id: program_id,
            action: "email_div"
        },
        success: function(res) {
            console.log(res);
           
            $('#show_div').html(res);
            $('#doc_nav').show();
            
        }

    });
    console.log(prgram_id);
})

$('#latter').on('change', function(e) {

    var name = $('#latter_name').val(),
        file = e.target.files[0],
        filename = name.length > 1 ? name + ".pdf" : file.name,
        filetype = file.type,
        filesize = file.size,
        data = {
            "filename": filename,
            "filetype": filetype,
            "filesize": filesize
        },
        reader = new FileReader();
    reader.onload = function(e) {
        data.file_base64 = e.target.result.split(/,/)[1];
        $.post("fileupload.php", {
                file: data
            }, "json")
            .then(function(data) {

                // parse `json` string `data`
                var filedata = JSON.parse(data)

                    // do stuff with `data` (`file`) object
                    ,
                    results = $("<a>", {
                        "href": "data:" + filedata.filetype +
                            ";base64," + filedata.file_base64,
                        "download": filedata.filename,
                        "target": "_blank",
                        "text": filedata.filename
                    }, "</a>");
                console.log(results)
                $("#latter_view").append("View File ", results[0]);
            }, function(jqxhr, textStatus, errorThrown) {
                console.log(textStatus, errorThrown)
            })
    };
    reader.readAsDataURL(file)


})

function upload_email_doc(doc_id) {

    let prgram_id = $('#prgram_id').val();
    var name = document.getElementById(doc_id).files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'pdf']) == -1) {
        alert("Invalid Image File");
    }
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById(doc_id).files[0]);
    var f = document.getElementById(doc_id).files[0];
    var fsize = f.size || f.fileSize;
    if (fsize > 2000000) {
        alert("Image File Size is very big");
    } else {
        form_data.append("file", document.getElementById(doc_id).files[0]);
        form_data.append("action", "email_doc");
        form_data.append("type", doc_id);
        form_data.append("program_id", prgram_id);
        
        console.log(form_data);
        $.ajax({
            url: "upload_email_doc.php",
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
            },
            success: function(res) {
                let elm = res.split('#');
                //console.log(elm[0]);
                if (elm[0] == "success") {
                    sessionStorage.message =  "Document" +' '+ elm[1]; 
                    sessionStorage.type = "success";
                    location.reload();
                }
                return false;
            }
        });
    }
}

function remove(id,field){
    alert(field);
    $.ajax({
        type:'POST',
        url:'upload_email_doc.php',
        data:{id:id,field:field,action:"remove_report"},
        success: function(res){
            console.log(res);
            let elm = res.split('#');
            //console.log(elm[0]);
            if (elm[0] == "success") {
                //print_r$("#email_div").load(" #email_div");
                location.reload();
            }
        }
    })
}

</script>