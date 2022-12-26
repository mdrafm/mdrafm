<?php 
  include ('admin/database.php') ;
  $db = new Database();

  if(isset($_POST['action']) && $_POST['action'] == 'sub_category_list'){
    $cat_id = $_POST['cat_id'];

    $db->select('tbl_circular_sub_group',"*",null,"group_id = ".$cat_id,null,null);
    // print_r( $db->getResult());
    $res = $db->getResult();
   
    if($res){
        ?>
<option value="0">Select Sub Category</option>
<?php
        foreach($res as $sub_cat){
            ?>
<option value="<?php echo $sub_cat['id'] ?>"><?php echo $sub_cat['sub_group_name'] ?></option>
<?php
          }
    }else{
         echo "<option value='0' >No Sub Category Found  </option>";
    }
     
  }
  
  if(isset($_POST['action']) && $_POST['action'] == 'search_data'){
     //print_r($_POST);
     if($_POST['circular_no'] !='' ){
        $sql = "SELECT c.dept_id,g.group_name,s.sub_group_name,c.circular_no,c.year,c.date,c.subject,c.file_name FROM `tbl_circular` c 
                LEFT JOIN `tbl_circular_group` g ON c.group = g.id 
                LEFT JOIN `tbl_circular_sub_group` s ON c.sub_group = s.id 
                WHERE c.dept_id = '".$_POST['dept_id']."' AND  c.circular_no = '".$_POST['circular_no']."' " ;
     }else{
        $where = " a.dept_id = '".$_POST['dept_id']."' ";

        if($_POST['subject'] != ''){
            $where .= " AND (a.group_name LIKE '%".$_POST['subject']."%' OR  a.sub_group_name LIKE '%".$_POST['subject']."%' OR  a.subject LIKE '%".$_POST['subject']."%') ";
        }
        
        if( isset($_POST['category_list']) && $_POST['category_list'] != ''){
            $where .= " AND a.group_name ='".$_POST['category_list']."' ";
        }
        if( isset($_POST['sub_category_list']) && $_POST['sub_category_list'] != ''){
            $where .= " AND a.sub_group_name =  '".$_POST['sub_category_list']."'  ";
        }
        if(  $_POST['date'] != ''){
            $date = Date("Y-m-d",strtotime($_POST['date']));

            $where .= " AND a.date ='".$date."' ";
        }
        if(  $_POST['year'] != ''){
           
            $where .= " AND a.year ='".$_POST['year']."' ";
        }

        $sql = "SELECT a.dept_id,a.group_name,a.sub_group_name,a.circular_no,a.year,a.date,a.subject,a.file_name FROM 
                    ( SELECT c.dept_id,g.group_name,s.sub_group_name,c.circular_no,c.year,c.date,c.subject,c.file_name FROM `tbl_circular` c 
                    LEFT JOIN `tbl_circular_group` g ON c.group = g.id 
                     LEFT JOIN `tbl_circular_sub_group` s ON c.sub_group = s.id )a 
                     WHERE  ". $where." ORDER BY  a.year DESC , a.date DESC";
     }

     ?>
<table id="circular" class="table">
    <thead class="" style="background: #315682;color:#fff;">

        <th style="width:50px;">Sl No</th>
        <th style="text-align:center;width:100px">Circular No/Date </th>
        <th style="text-align:center;width: 100px">Category</th>
        <th style="text-align:center;width: 100px">Sub Category</th>
        <th style="text-align:center;">Subject</th>
        <!-- <th style="text-align:center;width: 100px">Date</th> -->

        <th style="text-align:center;width: 8rem;">File</th>

    </thead>
    <tbody>
        <?php 
                               
                              
                               $count = 0;
                             
                               $db->select_sql($sql);
                              // print_r( $db->getResult());
                              $result = $db->getResult();
                              if($result){
                                    foreach($result as $row){
                                       // print_r($row); exit;
                                        $count++;
                                        $folder = "";
                                        $parent_folder = "";
                                        switch ($row['dept_id']) {
                                            case '10':
                                                $parent_folder='fin_circular';
                                                $folder = $row['year'];
                                                // if($row['year'] < 1987){
                                                //     $folder = "archive";
                                                   
                                                //    }else{
                                                //     $folder = $row['year'];
                                                //    }
                                                break;
                                            case '2':
                                                $parent_folder='ga_circular';
                                                $folder = $row['year'];
                                                break;
                                            
                                        }
                                        
                                        $path = "cms/circulars/".$parent_folder."/".$folder."/".$row['file_name'];
                                        ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row['circular_no']." <br>". Date("d-m-Y",strtotime($row['date'])); ?></td>
            <td><?php echo $row['group_name']; ?></td>
            <td><?php echo $row['sub_group_name']; ?></td>
            <td><?php echo $row['subject']; ?> </td>

            <td style="text-align:center;">

                <a href=<?php echo $path; ?> target="_blank" style="color:#4164b3"><img src="images/document_pdf.png" />
                    circular</i></a>

            </td>
        </tr>
        <?php
                                    }
                              }else{
                                echo "No Record Found";
                              }
                               
                      
                               
                              ?>

    </tbody>
</table>
<?php
  }
?>