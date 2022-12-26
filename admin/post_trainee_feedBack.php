<!DOCTYPE html>
<html lang="en">


<head>
    <?php 
    
    include('header_link.php');
    include('../config.php');
    include 'database.php';
    ?>
    <!-- select2 -->
    <link href="assets/css/mdtimepicker.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style>
    /* .content_row .contentBox{
            position:relative; 
            background:#fff;
            height:0;
            overflow:hidden;
            transition:0.5s;
            overflow-y:auto;
        } */
    /* .content_row .active .contentBox{
            height:150px;
            padding:10px;
        } */
        .feedback-heading{
            width:100%;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #af0000;
            background: #001b804f;
            border-radius: 5px;
        }
        .ind-heading{
            width: 60%;
            font-weight: 600;
            margin-top: 50px;
            margin-left: 5px;
            background: #ff5d0040;
            color: #230baf;
            padding: 10px;
            border-radius: 5px
        }
        .feedback_div{
            width: 90%;
            padding: 20px;
            margin: 0 auto;
            margin-bottom: 30px;
            background: #dce2f545;
            box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
        }
        .printbtn{
            float: right;
            padding: 5px 18px;
            margin-top: -39px;
            background-color: #279d73;
            color: #fff;
            border-radius: 5px;
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


            <div class="content">


                <div class="row" style="margin-top:50px">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Feedback</h4>
                            </div>
                            <div class="card-body">
                                <form id="frm_feedback">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><strong>Training Type</strong></label>
                                                <select class="custom-select mr-sm-2" name="traning_type"
                                                    id="traning_type">
                                                    <option selected>Select Type</option>
                                                    <?php 
                                                                    $db = new Database();
                                                                    $count = 0;
                                                                    $db->select('tbl_training_type',"*",null,null,null,null);
                                                                    // print_r( $db->getResult());
                                                                    foreach($db->getResult() as $row){
                                                                        //print_r($row);
                                                                        $count++
                                                                 ?>
                                                    <option value="<?php echo $row['id'] ?>">
                                                        <?php echo $row['type'] ?>
                                                    </option>

                                                    <?php 
                                                            }
                                                       ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><strong>Program</strong></label>
                                                <select class="custom-select mr-sm-2" name="program_id" id="program_id">
                                                    <option selected>Select Program</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="display:none" id="tourProgram">
                                            <div class="form-group">
                                                <label><strong>Tour Program</strong></label>
                                                <select class="custom-select mr-sm-2" name="tour_id" id="tour_id">
                                                    <option value='0' selected>Select Tour Program</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 class_room">
                                            <div class="form-group">
                                             
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="feedback_type"   value="1">
                                                      
                                                    <label class="form-check-label" for="Faculty"
                                                        style="padding-left: 5px;"> Trainning Program Wise</label>
                                                </div>
                                             
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="feedback_type"  value="2">
                                                       
                                                    <label class="form-check-label" for="Topic"
                                                        style="padding-left: 5px;">Trainee Wise</label>
                                                </div>

                                            </div>
                                           
                                        </div>
                                      

                                    </div>
                                   
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">

                                                <input type="button" class="btn btn-primary" value="view"
                                                    style="float: right" onclick="view_feedback()">
                                            </div>

                                        </div>
                                    </div>
                                </form>
                              
                            </div>
                        </div>

                    </div>

                </div>

                <div class="row" style="margin-top:50px:">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"></h4>

                            </div>
                            <div class="card-body">
                                <div id="feedback_program">

                                </div>
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
$('#traning_type').on('change', function() {
    var type = $('#traning_type').val();

    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "timeTable_prgram",
            type: type,

        },
        success: function(res) {
            console.log(res);
            $('#program_id').html(res);

        }
    })
})

$('#program_id').on('change', function() {
    var program_id = $('#program_id').val();
   
     if(program_id == 1){
        $('#tourProgram').show();
     }
    $.ajax({
        type: "POST",
        url: "ajax_trainee.php",
        data: {

            action: "fetch_tour_program",
            program_id: program_id,
          

        },
        success: function(res) {
            console.log(res);
            $('#tour_id').html(res);

        }
    })
})

// $('input[name="feedback"]').click(function() {
//     if ($(this).is(':checked')) {
//         let id = $(this).val();
//             switch (id) {
//                 case '1':
//                     $('#facultyType').show();
//                     $('#topicWise').hide();
//                     break;
//                 case '2':
//                     $('#facultyType').hide();


//                 break;
//              case '3':
//                $('#facultyType').hide();
//                $('#topicWise').show();
//                var program_id = $('#program_id').val();
//                         $.ajax({
//                             type: "POST",
//                             url: "ajax_trainee.php",
                            
//                             data: { 'action': 'select_topicWise',program_id:program_id},
//                             success: function(res) {
//                                 console.log(res);
//                                 $('#topic_id').html(res);


//                             }
//                         })
//                 break;
//             default:
//                 break;
//         }
//     }
// });

function view_feedback() {
    var program_id = $('#program_id').val();
    var prog_name ='';
    
       if(program_id ==1){
         prog_name = $('#tour_id option:selected').text();
       }else{
         prog_name = $('#program_id option:selected').text();
       }
    
    $.ajax({
        type: "POST",
        url: "ajax_trainee.php",
        
        data: $('#frm_feedback').serialize() + '&' + $.param({
            'action': 'view_post_feedBack',
            prog_name:prog_name

            
        }),
        success: function(res) {
            console.log(res);
            $('#feedback_program').html(res);


        }
    })

}

function show_content(id) {
    // $(`.contentBox_${id}`).css({transition : 'opacity 1s ease-in-out'});
    // $(this).parent().find('button').html('<i class="fa fa-minus"></i>');


    $(`.contentBox_${id}`).toggle();


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