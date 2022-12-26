<?php
include('../admin/database.php');
$db = new Database();


// if(isset($_POST['action']) && $_POST['action'] == 'add_case'){
//  print_r($_POST);
//  print_r($_FILES);
// }

if(isset($_POST['action']) && $_POST['action'] == 'search_case'){
   $broad_area_sql = '';
   $case_type_sql = '';
   $caseNo_sql = '';
   $caseYear_sql = '';
   $orderDate_sql= '';
   $partyName_sql = '';
   $courtName_sql = '';
   $section_gst_act_sql = '';
   $rule_gst_act_sql = '';
   $keyword_sql = '';
   $view = 0;
   $case_status = 'Approved';
   if(isset($_POST['case_status'])  ){
      $case_status = $_POST['case_status'];
   }

   if(isset($_POST['view'])  ){
      $view = $_POST['view'];
   }
   //   print_r($_POST);
   //   exit;
   
    
    //case keyword Search 
    if($_POST['keyword'] != ''){
      $keyword = $_POST['keyword'];

        $keyword_sql .= " AND (l.issue_in_case LIKE '%".$keyword."%' OR  l.court_judgement LIKE '%".$keyword."%' ) ";
    }
    //case year 
    if($_POST['caseYear'] != ''){
      $caseYear_sql = " AND l.case_year = $_POST[caseYear]";
    }
    //order date
    if($_POST['orderDate'] != ''){
     // Date("Y-m-d",strtotime($_POST['date']));
      $order_date = Date('Y-m-d', strtotime($_POST['orderDate']));

      $orderDate_sql = " AND l.order_date = '".$order_date."'"; 
    }
   // broadArea was selected
      if(isset($_POST['broadArea'])){
         $broad = $_POST['broadArea'];
         $where = '';

      if(count($broad) > 1){
      
         foreach($broad as $item){
         
            $where .= "FIND_IN_SET('$item',broad_area) OR ";
         }

            $str= preg_replace('/\W\w+\s*(\W*)$/', '$1', $where);
            $broad_area = $str;

         // SELECT * FROM `tbl_gst_case_law` WHERE FIND_IN_SET('29',broad_area) OR FIND_IN_SET('26',broad_area);
         //print_r($broad);
      }else{
      
         $broad_area = "FIND_IN_SET('$broad[0]',broad_area) ";
      }
      $broad_area_sql = ' AND '.$broad_area;
         
      }

   //section_gst_act sql

      if(isset($_POST['section_gst_act'])){
         $sections = $_POST['section_gst_act'];
         $where1 = '';

      if(count($sections) > 1){
      
         foreach($sections as $section){
         
            $where1 .= "FIND_IN_SET('$section',section_gst_act) OR ";
         }

            $str1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $where1);
            $section_gst = $str1;

         // SELECT * FROM `tbl_gst_case_law` WHERE FIND_IN_SET('29',broad_area) OR FIND_IN_SET('26',broad_area);
         //print_r($broad);
      }else{
      
         $section_gst = "FIND_IN_SET('$sections[0]',section_gst_act) ";
      }
        $section_gst_act_sql = ' AND '.$section_gst;
         
      }
   
    //section_gst_act sql

    if(isset($_POST['rule_gst_act'])){
      $rules = $_POST['rule_gst_act'];
      $where2 = '';

   if(count($rules) > 1){
   
      foreach($rules as $rule){
      
         $where2 .= "FIND_IN_SET('$rule',rule_gst_act) OR ";
      }

         $str2= preg_replace('/\W\w+\s*(\W*)$/', '$1', $where2);
         $rule_gst = $str2;

      // SELECT * FROM `tbl_gst_case_law` WHERE FIND_IN_SET('29',broad_area) OR FIND_IN_SET('26',broad_area);
      //print_r($broad);
   }else{
   
      $rule_gst = "FIND_IN_SET('$rules[0]',rule_gst_act) ";
   }
     $rule_gst_act_sql = ' AND '.$rule_gst;
      
   }

   // if($case_status == 'Approved'){
   //    $status_sql = " AND l.case_status = 'Approved' ";
   // }else{
   //    $status_sql = " AND (l.case_status = 'Draft' OR l.case_status = 'Pending') ";
   // }

   switch ($case_status) {
      case 'Approved':
         $status_sql = " AND l.case_status = 'Approved' ";
         break;
      case 'Draft':
        $status_sql = " AND (l.case_status = 'Draft' OR l.case_status = 'Pending') ";
         break;
      case 'Pending':
         $status_sql = " AND  l.case_status = 'Pending' ";
            break;
      case 'Reject':
         $status_sql = " AND  l.case_status = 'Reject' ";
            break;
      default:
         # code...
         break;
   }

    //party Name
    if($_POST['partyName'] != ''){
      // Date("Y-m-d",strtotime($_POST['date']));
       
       $partyName_sql = " AND `party_name` LIKE '%".$_POST['partyName']."%' "; 
     }

     //Court Name
    if($_POST['courtName'] != 0){
      $courtName_sql = " AND l.court_name = $_POST[courtName]";
    }
//search case case type, no ,year wise 

    if($_POST['caseType'] != 0 || $_POST['caseNo'] != '' || $_POST['caseYear'] != ''){
     
      //case type
        if($_POST['caseType'] != 0){
              $case_type_sql = " AND r.case_type = $_POST[caseType]";
        }
     //case numbers 
        if($_POST['caseNo'] != ''){
           $caseNo_sql = " AND r.case_no = $_POST[caseNo]";
        }
     //case year 
        if($_POST['caseYear'] != ''){
          $caseYear_sql = " AND r.case_year = $_POST[caseYear]";
        }

        $search_sql =  "SELECT l.id,l.party_name,c.court_name,t.case_code,t.case_desc,r.case_no,r.case_year, DATE_FORMAT(l.order_date,'%d-%m-%Y')as order_date, l.broad_area,l.section_gst_act,l.rule_gst_act,l.govt_circular,l.issue_in_case,l.court_judgement,l.comments,l.case_status,l.case_file 
                        FROM `tbl_case_ref` r 
                        LEFT JOIN `tbl_gst_case_law` l ON  r.case_id = l.id
                        LEFT JOIN `tbl_case_type` t ON r.case_type = t.id 
                        LEFT JOIN `tbl_court` c ON l.court_name = c.id 
                        WHERE l.status = 1 AND l.case_status = 'Approved'".$status_sql.$case_type_sql.$caseNo_sql.$caseYear_sql.$orderDate_sql.$broad_area_sql.$partyName_sql.$courtName_sql.$section_gst_act_sql.$rule_gst_act_sql.$keyword_sql;
        //echo   $search_sql;           
  }else{
   $search_sql = "SELECT l.id,l.party_name,c.court_name, DATE_FORMAT(l.order_date,'%d-%m-%Y')as order_date, l.broad_area,l.section_gst_act,
                  l.rule_gst_act,l.govt_circular,l.issue_in_case,l.court_judgement,l.comments,l.case_status,l.case_file 
                  FROM `tbl_gst_case_law` l 
                  LEFT JOIN `tbl_court` c ON l.court_name = c.id 
                  WHERE l.status = 1 ".$status_sql.$orderDate_sql.$broad_area_sql.$partyName_sql.$courtName_sql.$section_gst_act_sql.$rule_gst_act_sql.$keyword_sql;
  }

      
      ?>
      <table id="case_law" class="table">
            <thead class="" style="background: #315682;color:#fff;">

               <th style="width:50px;">Sl No</th>
               <th >Case Name </th>
               <th >Court</th>
               <th style="display: <?php echo ($_POST['caseType'] != 0)?'':'none' ?> ">Case Type</th>
               <th style="display: <?php echo ($_POST['caseNo'] != 0)?'':'none' ?> ">Case No</th>
               <th style="display: <?php echo ($_POST['caseYear'] != 0)?'':'none' ?> ">Case Year</th>
               <th >Order Date</th>
               <th  style="display: <?php echo ($case_status == 'Approved')?'none':'' ?> ">
                   <?php echo ($case_status == 'Reject')?'Comments':'Action' ?>  
              </th>
               <th >Details</th>
               
              
            </thead>
            <tbody>
               <?php
                  $count = 0;
                 $db->select_sql($search_sql);
                 $result = $db->getResult();
                 if($result){
                  foreach($result as $row){
                     $count++;
                     $path = "../case_file/".$row['case_file'];
                     ?>
                           <tr>
                              <td><?php echo $count; ?></td>
                              <td><?php echo $row['party_name'] ?></td>
                              <td>
                                 <?php
                                    if($row['court_name'] != ''){
                                       echo $row['court_name']; 
                                    }else{
                                       echo 'NA';
                                    }
                                    
                                    
                                 ?>
                              </td>
                              <td style="display: <?php echo ($_POST['caseType'] != 0)?'':'none' ?> ">
                                     <?php  echo $row['case_code']; ?>
                              </td>
                              <td style="display: <?php echo ($_POST['caseNo'] != 0)?'':'none' ?> ">
                                     <?php  echo $row['case_no']; ?>
                              </td>
                              <td style="display: <?php echo ($_POST['caseYear'] != 0)?'':'none' ?> ">
                                     <?php  echo $row['case_year']; ?>
                              </td>
                              <!-- <td><?php 
                              if($row['case_code'] !=''){
                                 echo $row['case_code'].'/'.$row['case_no'].'/'.$row['case_year'] ;
                              }else{
                                 echo 'NA';
                              }
                              ?>
                                   </td> -->
                              <td><?php echo $row['order_date']; ?> </td>
                              <td style="display: <?php echo ($case_status == 'Approved')?'none':'' ?>"> 
                              <?php
                                 if($case_status == 'Draft'){

                              
                                    if($row['case_status'] == 'Pending'){
                                       echo "<P style='padding: 10px;
                                       font-size: 16px;
                                       background: #efdddd;'>Pending For Approval</p>";
                                    }else{
                                       ?>
                                          <input type="button" class="btn " style="background:rgb(58 146 181);color:#fff; "
                                          name="view"
                                          onclick="approval_alert(<?php echo $row['id'] ?>)"
                                          value="Send To Approve" />
                                       <?php
                                    }
                                 }
                                 if($case_status == 'Pending'){
                                    ?>
                                    <input type="button" class="btn " style="background:rgb(58 146 181);color:#fff; "
                                    name="view"
                                    onclick="final_approve_alert(<?php echo $row['id'] ?>)"
                                    value="Approve" />

                                    <input type="button" class="btn " style="background:rgb(181 58 58);;color:#fff; "
                                    name="view"
                                    onclick="reject_alert(<?php echo $row['id'] ?>)"
                                    value="Reject" />
                                 <?php
                                 }

                                 if($case_status == 'Reject'){
                                    ?>
                                   <P style='padding: 10px;
                                       font-size: 16px;
                                       background: #efdddd;'><?php echo $row['comments'] ?></p>
                                 <?php
                                 }
                             
                              ?>
                             
                              </td>
                              <td> 
                               
                              <!-- <input type="button" class="btn " style="background:#3292a2"
                                 name="view"
                                 onclick="datapost('gst_case_detail.php',{case_id: <?php echo $row['id'] ?> })"
                                 value="View" /> -->

                                 <!-- <a href="#" data-toggle="modal"
                                    data-target="#detailsModal_<?php echo $row['id']; ?>"
                                    style="color:#4164b3 ;">
                                   view
                                 </a>  $flag -->
                                 <div class="action_search" style=" display: <?php echo ($view == 1)?'none':'' ?>">
                                 <a href="#" class="text-primary" id="<?php echo $row['id']; ?> " data-toggle="tooltip" data-placement="top" title="Edit" onclick="datapost('edit_case.php',{case_id:<?php echo $row['id']?>})" ><span class="pcoded-micon"><i class="feather icon-edit" style="font-size: 1.7rem;"></i></span></a>
                                 <a href="#" class="text-danger" id="<?php echo $row['id']; ?> " onclick="drop_alert(this.id)" data-toggle="tooltip" data-placement="top" title="Delete" ><span class="pcoded-micon"><i class="feather icon-trash" style="font-size: 1.7rem;"></i></span></a>
                                 </div>
                                
                                 <!-- <a href="#ex1" rel="modal:open">Open Modal</a> -->
                                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailsModal_<?php echo $row['id']; ?>">
                                 View
                                 </button>

                                                    <!--Tranee Detail Modal -->

                                                    <div id="detailsModal_<?php echo $row['id']; ?>" class="modal fade">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content" style="width:200%;margin-left: -33%;">
                                                                <div class="modal-header" style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgb(38 71 156 / 98%) 0%, rgb(39 255 0 / 73%) 100%);color: #fff;">
                                                                    <h5 class="modal-title" id="m_title" style="color:#fff"
                                                                        style="text-align:center;"> Case Details
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal"
                                                                        aria-hidden="true">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                   <div class="row" style="line-height: 2rem;">
                                                                     <div class="col-md-12">
                                                                        <h4 class="text-center" style="text-decoration: underline;text-decoration-color: #0083ff;">
                                                                          <?php 
                                                                            $partyEl =explode("Versus", $row['party_name']); 
                                                                             
                                                                          ?>
                                                                          <div class="caseName">
                                                                           <p style="font-size: 1.5rem;"><?php echo $partyEl[0] ?></p>
                                                                           <p style="font-size: 1rem;">Versus</p>
                                                                           <p style="font-size: 1.5rem;"><?php echo $partyEl[1] ?></p>
                                                                          </div>
                                                                         

                                                                       </h4>
                                                                     </div>
                                                                     <div class="col-md-6">
                                                                        <div class="row">
                                                                           <div class="col-md-5"> <strong>Case Ref No :</strong></div>
                                                                           <div class="col-md-7">
                                                                              <?php 
                                                                              $arr_case_ref = array();
                                                                                $db->select('tbl_case_ref','t.case_code,r.case_no,r.case_year',' r LEFT JOIN `tbl_case_type` t ON r.case_type = t.id ',' r.case_id='.$row['id'],null,null);
                                                                                foreach($db->getResult() as $case_ref){
                                                                                  //print_r print_r($case_ref);
                                                                                  $ref = $case_ref['case_code'].'/'.$case_ref['case_no'].'/'.$case_ref['case_year'];
                                                                                  array_push( $arr_case_ref,$ref);
                                                                                }
                                                                                echo implode(" , ",$arr_case_ref);
                                                                              //echo $row['case_code'].'/'.$row['case_no'].'/'.$row['case_year'] 
                                                                             // print_r($arr_case_ref);
                                                                              ?>
                                                                           </div>
                                                                        </div>
                                                                       
                                                                     </div>
                                                                     <div class="col-md-6">
                                                                        <div class="row">
                                                                           <div class="col-md-5"><strong>Order Date :</strong></div>
                                                                           <div class="col-md-7"><?php echo $row['order_date']; ?></div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-6">
                                                                        <div class="row">
                                                                           <div class="col-md-5"><strong>Section GST Act :</strong></div>
                                                                           <div class="col-md-7">
                                                                           <?php 
                                                                           if($row['section_gst_act'] !== ''){

                                                                              $section_arr = array();
                                                                              $sections = explode(",",$row['section_gst_act']); 
                                                                              foreach($sections as $section){
                                                                                 $db->select('tbl_section_gst_act',"*",null,"id=".$section,null,null);
                                                                                 foreach($db->getResult() as $section_gst){
                                                                                  
                                                                                    array_push($section_arr,$section_gst['section']);
                                                                                   
                                                                                 }
                                                                             
                                                                              }

                                                                              echo implode(",",$section_arr);
                                                                           }else{
                                                                              echo 'NA';
                                                                           }
                                                                              ?>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     
                                                                     <div class="col-md-6">
                                                                        <div class="row">
                                                                           <div class="col-md-5"><strong>Rule GST Act :</strong></div>
                                                                           <div class="col-md-7">
                                                                              <?php //echo $row['rule_gst_act']; ?>
                                                                              <?php 
                                                                               if($row['rule_gst_act'] !=''){
                                                                                 $gst_rule_arr = array();
                                                                              $gst_rules = explode(",",$row['rule_gst_act']); 
                                                                              foreach($gst_rules as $gst_rule){
                                                                                 $db->select('tbl_rule_gst_act',"*",null,"id=".$gst_rule,null,null);
                                                                                 foreach($db->getResult() as $rule){
                                                                                    //print_r($rule);
                                                                                    array_push($gst_rule_arr, $rule['rules']);
                                                                                 }
                                                                              
                                                                              }
                                                                              echo implode(",",$gst_rule_arr);
                                                                           }else{
                                                                              echo 'NA';
                                                                           }
                                                                              ?>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-6">
                                                                        <div class="row">
                                                                           <div class="col-md-5"><strong>Broad Area :</strong></div>
                                                                           <div class="col-md-7">
                                                                              <?php 
                                                                              if($row['broad_area'] !== ''){

                                                                                 $area2 = array();
                                       $ba = explode(",",$row['broad_area']); 

                                          foreach($ba as $a){
                                              $db->select('tbl_broad_area',"*",null,"id=".$a,null,null);
                                       foreach($db->getResult() as $area){
                                          array_push($area2,$area['broad_area']);
                                          }
                                                                              
                                 }
                                      //print_r($area2); 

                                     if(count($area2) == 1){
                                          //print_r($area2); 
                                       echo $area2[0];
                                     } else{
                                       $area_value = implode("-",$area2);
   echo $area_value =  substr_replace($area_value, ' & ',strrpos($area_value, '-',1));
                                     }                                    
                               
                                                                             
                                                                           }else{
                                                                              echo 'NA';
                                                                           }
                                                                              ?>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-6">
                                                                        <div class="row">
                                                                           <div class="col-md-3"><strong>Court Name :</strong></div>
                                                                           <div class="col-md-9">
                                                                           <?php echo $row['court_name']; ?>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     <hr>
                                                                     
                                                            
                                                           
                                                                     <hr>
                                                                     <div class="col-md-12">
                                                                        <div class="row">
                                                                           <div class="col-md-2"><strong>Issue in Case :</strong></div>
                                                                           <div class="col-md-10  " style="border: 1px solid #79585899;"><p style="text-align: justify;"><?php echo $row['issue_in_case']; ?></p></div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-12 ">
                                                                        <div class="row mt-3" >
                                                                           <div class="col-md-2"><strong>Court Judgement :</strong></div>
                                                                           <div class="col-md-10 " style="border: 1px solid #79585899;"> <p style="text-align: justify;"><?php echo $row['court_judgement']; ?></p></div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-6 mt-3">
                                                                        <div class="row">
                                                                           <div class="col-md-5"><strong>Govt Circular :</strong></div>
                                                                           <div class="col-md-7"><?php echo ($row['govt_circular'] == '')?'NA':$row['govt_circular'] ?></div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-6 mt-3">
                                                                        <div class="row">

                                                                           <div class="col-md-5"><strong>Case File :</strong></div>
                                                                           <?php
                                                                             if($row['case_file'] != ''){
                                                                              ?>
                                                                                <a href="<?php echo $path; ?>" target="_blank" style="color:#c9100c"
                                                                             id="edit_case_file"><img src="assets/images/document_pdf.png" />
                                                                              <?php
                                                                             }else{
                                                                              echo "NA";
                                                                             }
                                                                           ?>
                                                                          
                                                                        </div>
                                                                     </div>
                                                                   </div>
                                                                </div>
                                                                <div class="modal-footer" id="m_footer">
                                                                    <input type="button" class="btn btn-danger"
                                                                        data-dismiss="modal" value="Close">
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                              </td>
                              
                           </tr>
                     <?php
                  }
                 }else{
                  echo "Case Not Found";
                 }
               ?>
            </tbody>
      </table>
      <?php
}

// if(isset($_POST['action']) && $_POST['action'] == 'approve_case'){
// }
?>