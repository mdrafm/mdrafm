<?php include('header.php') ?>
<?php include('nav_bar.php') ?>
<?php 
  include ('admin/database.php') ;
  $db = new Database();
  //print_r($_POST);
  
  $year = date("Y");
  if(isset($_POST['year'])){
    $year = $_POST['year'];
  }
  //echo $year;
?>

<div class="news-head">
    <h2><?php echo $_POST['dept_name'] ?> </h2>
</div>
<div class="container-fluid">
     
    <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
    <div class="btn_div" style="display: flex;justify-content: space-between">
        <button type="button" class="btn btn-labeled btn-primary" id="btn_bck">
            <span class="btn-label" style="margin-right:15px"><i class="fa fa-arrow-left"></i></span> 
            <a href="#" onclick="history.go(-1);" class="bck_btn" style="text-decoration: none;color: #fff;" >Back</a>
        </button>
        <button type="button" class="btn btn-labeled btn-warning" style="margin-right: 2.5rem" id="btn_search">
            <span class="btn-label" style="margin-right:15px"><i class="fa fa-search"></i></span>Search
        </button>
    </div>
    <?php
      //print_r($_POST);
    ?>
    <!-- <div class="row">
        <div class="dept">
            <p><?php echo $_POST['dept_name'] ?></p>
        </div>
    </div> -->
    <div id="search" style="display:none">
        <div class="search_div mt-2" style="margin-left: 70px;">
            <div class="search">
                <form method="post" id="frm_circular">
                    <div class="row" style="color: #fff;">
                    <div class="form-group col-md-2">
                           </div>
                        <div class="form-group col-md-3 circular_no">
                            <label></label>
                            <input class="form-control me-2" type="search" id="circular_no"
                                placeholder="Circular Number"><br>
                        </div>
                        <div class="form-group col-md-1">
                            <label></label>
                            <input class="form-control me-2" type="button" value="OR" />
                        </div>
                        <div class="form-group col-md-3 subject">
                            <label></label>
                            <input class="form-control me-2" type="search" id="subject" placeholder="Subject / Keyword" autocomplete="off"><br>

                        </div>
                        <div class="col-md-2" style="padding: 1.6rem;">

                            <a data-toggle="collapse" href="#advanceSearch" role="button" aria-expanded="false" style="color: #212e5f;text-decoration: none;"
                                aria-controls="advanceSearch" class="advanced">
                                Advance Search<i class="fa fa-angle-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="collapse" id="advanceSearch">


                        <div class="row">
                           <div class="form-group col-md-2">
                           </div>

                            <div class="form-group col-md-3 category">

                                <select class="form-control " id="category_list" 
                                    style="width: 100%;">

                                    <option value="0">Select Category</option>
                                    <?php

                                            $db->select('tbl_circular_group',"*",null," `dept_id` = '".$_POST['dept_id']."' ",null,null);
                                            // print_r( $db->getResult());
                                            foreach($db->getResult() as $Category){
                                                ?>
                                    <option value="<?php echo $Category['id'] ?>"><?php echo $Category['group_name'] ?>
                                    </option>
                                    <?php
                                            }

                                        ?>

                                </select>

                            </div>


                            <div class="form-group sub-category col-md-3" id="sub_category_div">

                                <select class="form-control " id="sub_category_list" 
                                    style="width: 100%;">
                                </select>

                            </div>


                        </div><br>

                        <div class="row">
                           <div class="form-group col-md-2">
                           </div>

                            <div class="from-group keyword col-md-3">

                                <input type="text" class="form-control" id="date_picker"   placeholder="Date" autocomplete="off">

                            </div>
                            <div class="from-group keyword col-md-3">

                               
                                 <input type="text" class="form-control" id="year" placeholder="Year">

                            </div>
                        </div>
                       

                    </div>

                </form>
            </div>
             <div class="btnFind d-flex justify-content-end">
                <button type="button" class="btn btn-labeled btn-primary" onclick="findData()">
                    Find
                </button>
                <button type="button" class="btn btn-labeled btn-warning" id="resetFrm" >
                    Reset
                </button>
               
             </div>
            
        </div>
    </div>




    <div id="tbl_circular" class=" table table-responsive table-striped table-hover" >
        <table id="circular" class="table">
            <thead class="" style="background: rgb(46 110 100 / 90%);;color:#fff;">

                <th style="width:50px;">Sl No</th>
                <th style="text-align:center;">Circular No / Date</th>
                <th style="text-align:center;width: 100px">Category</th>
                <th style="text-align:center;width: 100px">Sub Category</th>
                <th style="text-align:center;">Subject</th>
                <!-- <th style="text-align:center;width: 100px"> Date </th> -->
                <th style="text-align:center;width: 8rem;">File</th>



            </thead>
            <tbody>
                <?php 
                               
                              
                               $count = 0;
                               $dept_folder = "";

                               $db->select("tbl_department","dept_folder",null,"id = ".$_POST['dept_id'],null,null);
                               $result = $db->getResult();
                               foreach($result as $row1){
                                  $dept_folder = $row1['dept_folder'];
                               }
                             
                               //$db->select('tbl_circular',"*",null,null,null,null);
                               $sql = "SELECT c.dept_id,g.group_name,s.sub_group_name,c.circular_no,c.year,c.date,c.subject,c.file_name FROM `tbl_circular` c 
                                      LEFT JOIN `tbl_circular_group` g ON c.group = g.id LEFT JOIN  `tbl_circular_sub_group` s ON c.sub_group = s.id  WHERE c.dept_id = '".$_POST['dept_id']."' AND c.year = '".$year."'
                                       ORDER BY  c.year DESC , c.date DESC ";
                              // print_r( $db->getResult());
                               $db->select_sql($sql);
                               foreach($db->getResult() as $row){
                                   //print_r($row);
                                   $count++;
                                   $folder = $row['year'];
                                   // if($row['year'] < 1987){
                                   //  $folder = "archive";
                                    
                                   // }else{
                                   //  $folder = $row['year'];
                                   // }
                                   $path = "cms/circulars/".$dept_folder."/".$folder."/".$row['file_name'];
                                  // echo $path;exit;
                                   ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo ($row['circular_no']." <br>". Date("d-m-Y",strtotime($row['date']))); ?></td>
                   
                    <td><?php echo $row['group_name']; ?></td>
                    <td><?php echo $row['sub_group_name']; ?></td>

                    <td><?php echo $row['subject']; ?> </td>
                    <!-- <td><?php echo Date("d-m-Y",strtotime($row['date'])); ?></td> -->
                    <td style="text-align:center;">

                        <a href=<?php echo $path; ?> target="_blank" style="color:#4164b3"><img
                                src="images/document_pdf.png" />
                            circular</i></a>

                    </td>
                </tr>
                <?php
                               }
                      
                               
                              ?>

            </tbody>
        </table>
    </div>




    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">


        </div>
        <div class="col-md-2"></div>

    </div>



</div>

<?php include('footer.php') ?>

<script>
// $(document).ready(function{
//    $('#btn_search').on('click', function(){
//     $('#search').toggle("slide");
//    })
// })

$(document).ready(function() {
    $('#dept_list').select2();
    $('#category_list').select2();

    $('#sub_category_list').select2();
    

    $( "#date_picker" ).datepicker({
        changeMonth: true,
        changeYear: true
    });
});

var table = $('#circular').DataTable({
    searching: false,
});
table.on( 'draw', function () {
        var body = $( table.table().body() );
 
        body.unhighlight();
        body.highlight( table.search('Budget Circular') );  
    } );


$('#btn_search').click(function() {
        $('#search').toggle("down");
       // $('#search').show();
    });

$('#category_list').on('change', function() {
    let cat_id = $('#category_list').val();

    $.ajax({
        type: "POST",
        url: "ajax_circular.php",
        data: {
            action: "sub_category_list",
            cat_id: cat_id

        },
        success: function(data) {
            // console.log(data);
            $('#sub_category_list').html(data);
            // $('#sub_category_div').show();
            
        }
    })

})


$("#resetFrm").on('click', function(){
  
    $('#frm_circular')[0].reset();
    $('#category_list').val(0).trigger('change');
    $('#sub_category_list').val(0).trigger('change');
   
})

function findData() {
    $('#tbl_circular').html('');

   let dept_id = <?php echo $_POST['dept_id'] ?>;
   let circular_no = $('#circular_no').val();
   let subject = $('#subject').val();
   let date = $('#date_picker').val();
   let year = $('#year').val();
      
   let category_list = $('#category_list').val();
   let sub_category_list = $('#sub_category_list').val();
   
    if(category_list != 0){
        var category_list_text = $('#category_list option:selected').text();
    }

    if(sub_category_list !=0){
        var sub_category_list_text = $('#sub_category_list option:selected').text();
    }
    

    $.ajax({
        type: "POST",
        url: "ajax_circular.php",
        data: {
            action:"search_data",
            dept_id:dept_id,
            circular_no:circular_no,
            subject:subject,
            date:date,
            year:year,
            category_list:category_list_text,
            sub_category_list:sub_category_list_text

        },
        success: function(data) {
             console.log(data);
            $('#tbl_circular').html(data);
            $('#circular').DataTable({
                searching: false,
                //"bPaginate": false;
            });
        }
    })

}
</script>