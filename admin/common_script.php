
    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>


    <script src="assets/js/core/bootstrap.min.js"></script>


    <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>


    <!--  Google Maps Plugin    -->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGat1sgDZ-3y6fFe6HD7QUziVC6jlJNog"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="../../../buttons.github.io/buttons.js"></script>


    <!-- Chart JS -->
    <script src="assets/js/plugins/chartjs.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/plugins/bootstrap-notify.js"></script>





    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/now-ui-dashboard.minaa26.js?v=1.5.0" type="text/javascript"></script>
    <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="assets/demo/demo.js"></script>
    <!-- <script src="assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js" type="text/javascript"></script> -->
   
    <!-- Sharrre libray -->
    <script src="assets/demo/jquery.sharrre.js"></script>
     <!-- common Js  -->
    <script src= "assets/js/common.js"> </script>
    <script src= "assets/js/form_valid.js"> </script>

    <script src="assets/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="assets/js/jquery-time-picker.js"></script>
    <script src="assets/js/mdtimepicker.js"></script>
    <script src="assets/js/editor.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    
   
    <script>
        
$('input[name="faculty"]').click(function() {
    if ($(this).is(':checked')) {
        //alert($(this).val());
        let id = $(this).val();
        if(id == 1){
                $.ajax({
                type: "POST",
                url: "ajax_timetable.php",

                data: {
                    facult_id: id,
                    table: "tbl_faculty_master",
                    action: "select_faculty"
                },
                success: function(res) {
                    console.log(res);
                    $('.faculty_id_div').html(res);
                }
            })
        }else{
            //    $('#guest').show();
            //    $('.inhouse').hide();
            $('#guestModal').modal('show');
            
            $.ajax({
                type: "POST",
                url: "ajax_timetable.php",

                data: {
                   
                    table: "tbl_faculty_master",
                    action: "select_guest_faculty"
                },
                success: function(res) {
                    
                    $('.faculty_id_div').html(res);
                   

                }
            })

        }
        
    }
})

    $('#guest_paper').on('change', function() {
    var paper_id = $(this).val();
    //alert(paper_id);

    $.ajax({
        type: "POST",
        url: "ajax_timetable.php",

        data: {
            action: "assign_subjecToFaculty",
            paper_id: paper_id,
            table: "tbl_guest_subject",
            
        },
        success: function(res) {
            console.log(res);
            $('#guest_subject').html(res);
        }
    })

})

$('#guest_subject').on('change', function() {
    var subject_id = $(this).val();
    var paper_id =$('#guest_paper').val();
    //alert(paper_id);

    $.ajax({
        type: "POST",
        url: "ajax_timetable.php",

        data: {
            action: "slct_guest_faculty",
            paper_id: paper_id,
            subject_id:subject_id,
            table: "tbl_guest_subject",
            
        },
        success: function(res) {
            console.log(res);
            $('#guest_faculty').html(res);
        }
    })

})

$('#add_faculty').on('click', function() {
    var guest_faculty = $('#guest_faculty').val();
    var faculty = guest_faculty.toString();
          $.ajax({

                type: "POST",
                url: "ajax_timetable.php",

                data: {
                    action: "add_guest_faculty",
                    faculty_id: faculty,
                    table: "tbl_faculty_master"
                    
                },
                success: function(res) {
                    console.log(res);
                    $('#faculty_id').html(res);
                }
            });
   
   
    $('#guestModal').modal('hide');
    console.log(faculty);
})

$('#term_id').on('click', function() {
    var term_id = $(this).val();
    // alert(term_id);

    $.ajax({
        type: "POST",
        url: "ajax_timetable.php",

        data: {
            term_id: term_id,
            table: "tbl_paper_master",
            action: "select_paper"
        },
        success: function(res) {
            console.log(res);
            $('#paper_id').html(res);
        }
    })

})

$('#paper_id').on('click', function() {
    var paper_id = $(this).val();
    // alert(term_id);

    $.ajax({
        type: "POST",
        url: "ajax_timetable.php",

        data: {
            paper_id: paper_id,
            table: "tbl_subject_master",
            action: "select_mjr_subject"
        },
        success: function(res) {
            console.log(res);
            $('#mjr_subject_id').html(res);
        }
    })

})

$('#mjr_subject_id').on('change', function() {
    var subject_id = $(this).val();
    // alert(term_id);
    $('#topic_id').html('');
    $.ajax({
        type: "POST",
        url: "ajax_timetable.php",

        data: {
            subject_id: subject_id,
            table: "tbl_topic_master",
            action: "select_topic"
        },
        success: function(res) {
            console.log(res);
            $('#topic_id').html(res);
        }
    })

})
$('#topic_id').on('change', function() {
    var topic_id = $(this).val();

    $.ajax({
        type: "POST",
        url: "ajax_timetable.php",

        data: {
            topic_id: topic_id,
            table: "tbl_detail_topic_master",
            action: "select_deatail_topic"
        },
        success: function(res) {
            console.log(res);
            $('#subject_id').html(res);
        }
    })

})

function verify_time(period){
    //$("#timePicker_end").val("12:30 PM");
    let start_time =   $("#timepicker_start").val();
    let end_time =   $("#timePicker_end").val();
    let update_id =   $("#update_id").val();

    //alert(program_id);
    $.ajax({
        type: "POST",
        url:"ajax_timetable.php",
        data:{'action':'edit_verify_time',period:period,start_time:start_time,end_time:end_time,tbl_id:update_id},
        success: function(data){
            console.log(data);
            let elm = data.split('#');
            if(elm[0] == 'start'){
                $('#start_time').addClass('error');
                $('#start_time').html(elm[1]);
                $('#start_time').show();
            }else{
                $('#start_time').hide();
                $('#end_time').addClass('error');
                $('#end_time').html(elm[1]);
                $('#end_time').show();
            }
        }
    })
}



    </script>