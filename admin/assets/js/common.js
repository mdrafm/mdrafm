$(document).ready(function() {
   
    $().ready(function() {
        showMessage();
        // $('#term3').DataTable();
        $sidebar = $('.sidebar');
        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        // if( window_width > 767 && fixed_plugin_open == 'Dashboard' ){
        //     if($('.fixed-plugin .dropdown').hasClass('show-dropdown')){
        //         $('.fixed-plugin .dropdown').addClass('show');
        //     }
        //
        // }

        $('.fixed-plugin a').click(function(event) {
            // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
            if ($(this).hasClass('switch-trigger')) {
                if (event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                }
            }
        });

        $('.fixed-plugin .background-color span').click(function() {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');

            var new_color = $(this).data('color');

            if ($sidebar.length != 0) {
                $sidebar.attr('data-color', new_color);
            }

            if ($full_page.length != 0) {
                $full_page.attr('filter-color', new_color);
            }

            if ($sidebar_responsive.length != 0) {
                $sidebar_responsive.attr('data-color', new_color);
            }
        });

        $('.fixed-plugin .img-holder').click(function() {
            $full_page_background = $('.full-page-background');

            $(this).parent('li').siblings().removeClass('active');
            $(this).parent('li').addClass('active');


            var new_image = $(this).find("img").attr('src');

            if ($sidebar_img_container.length != 0 && $(
                    '.switch-sidebar-image input:checked').length != 0) {
                $sidebar_img_container.fadeOut('fast', function() {
                    $sidebar_img_container.css('background-image', 'url("' +
                        new_image + '")');
                    $sidebar_img_container.fadeIn('fast');
                });
            }

            if ($full_page_background.length != 0 && $(
                    '.switch-sidebar-image input:checked').length != 0) {
                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find(
                    'img').data('src');

                $full_page_background.fadeOut('fast', function() {
                    $full_page_background.css('background-image', 'url("' +
                        new_image_full_page + '")');
                    $full_page_background.fadeIn('fast');
                });
            }

            if ($('.switch-sidebar-image input:checked').length == 0) {
                var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr(
                    'src');
                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find(
                    'img').data('src');

                $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                $full_page_background.css('background-image', 'url("' +
                    new_image_full_page + '")');
            }

            if ($sidebar_responsive.length != 0) {
                $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
            }
        });

        $('.switch-sidebar-image input').on("switchChange.bootstrapSwitch", function() {
            $full_page_background = $('.full-page-background');

            $input = $(this);

            if ($input.is(':checked')) {
                if ($sidebar_img_container.length != 0) {
                    $sidebar_img_container.fadeIn('fast');
                    $sidebar.attr('data-image', '#');
                }

                if ($full_page_background.length != 0) {
                    $full_page_background.fadeIn('fast');
                    $full_page.attr('data-image', '#');
                }

                background_image = true;
            } else {
                if ($sidebar_img_container.length != 0) {
                    $sidebar.removeAttr('data-image');
                    $sidebar_img_container.fadeOut('fast');
                }

                if ($full_page_background.length != 0) {
                    $full_page.removeAttr('data-image', '#');
                    $full_page_background.fadeOut('fast');
                }

                background_image = false;
            }
        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
            var $btn = $(this);

            if (sidebar_mini_active == true) {
                $('body').removeClass('sidebar-mini');
                sidebar_mini_active = false;
                nowuiDashboard.showSidebarMessage('Sidebar mini deactivated...');
            } else {
                $('body').addClass('sidebar-mini');
                sidebar_mini_active = true;
                nowuiDashboard.showSidebarMessage('Sidebar mini activated...');
            }

            // we simulate the window Resize so the charts will get updated in realtime.
            var simulateWindowResize = setInterval(function() {
                window.dispatchEvent(new Event('resize'));
            }, 180);

            // we stop the simulation of Window Resize after the animations are completed
            setTimeout(function() {
                clearInterval(simulateWindowResize);
            }, 1000);
        });
    });
});

// show messges

function showMessage(){
	if ( sessionStorage.type=="success" ) {
        console.log(123);
        $('#alert_msg').show();
        //$('#btn_records_mtnc').show();
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

function add_course_dir(id,course_dir,roll,trng_type,tbl) {

    let faculty_id = $(`#course_director_${id}`).val();
    var action;
    
    if (course_dir == 0) {
        action = "add_course_dir"; 
    } else {
        action = "update_course_dir";
    }
   // console.log(action);
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: action,
            id: id,
            faculty_id: faculty_id,
            course_dir: course_dir,
            roll_id: roll,
            trng_type:trng_type,
            table: tbl
        },
        success: function(res) {
            console.log(res);
            // if (res == "success") {
            //     sessionStorage.message = " successfully";
            //     sessionStorage.type = "success";
            //     location.reload();
            // }
        }
    })
}


function add_asst_course_dir(id, course_dir, roll,trng_type,tbl) {

    let faculty_id = $(`#asst_course_director_${id}`).val();
    var action;

    // if (course_dir == 0) {
    //     action = "add_asst_course_dir";
    // } else {
    //     action = "update_asst_course_dir";
    // }
   
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {

            action: "add_asst_course_dir",
            id: id,
            faculty_id: faculty_id,
            course_dir: course_dir,
            roll_id: roll,
            trng_type:trng_type,
            table: tbl

        },
        success: function(res) {
            console.log(res);
            
            // if (res == "success") {
            //     sessionStorage.message = "Email Content Updated successfully";
            //     sessionStorage.type = "success";
            //     location.reload();
            // }
        }
    })
}