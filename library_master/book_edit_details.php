<?php 
$location_id=$_POST['location_id'];
$book_ref_no=$_POST['ref_no'];
if(isset($location_id) && empty($book_ref_no))
{
    include '../admin/database.php'; 
    $db = new Database(); 
    $db->select('tbl_temp_book_detail',"*",null,'location= "'.$location_id.'"',null,null); 
}else if(isset($book_ref_no) && empty($location_id))
{
    include '../admin/database.php'; 
    $db = new Database(); 
    $db->select('tbl_temp_book_detail',"*",null,'book_ref_no= "'.$book_ref_no.'"',null,null);
}
else if(isset($book_ref_no) && isset($location_id))
{
    include '../admin/database.php'; 
    $db = new Database(); 
    $db->select('tbl_temp_book_detail',"*",null,'location= "'.$location_id.'" and book_ref_no= "'.$book_ref_no.'"',null,null);
}
$res_book = $db->getResult(); 
$db->select('tbl_book_category',"*",null,null,null,null);
$res_book_cat = $db->getResult(); 
if(!empty($res_book))
{ ?>
<table id="case_law" class="table">
<h4 align="center">Book Details</h4>
    <thead class="" style="background: #315682;color:#fff;">
        <th style="width:50px;">Sl No</th>
        <th>Ref No.</th>
        <th>Book Name </th>
        <th>Author Name</th>
        <th>Edition</th>
        <th>Year</th>
        <th>Place & Publisher</th>
        <th>Page</th>
        <th>Price</th>
        <th>quantity</th>
        <th>Location</th>
        <th>Row</th>
        <th>Book Type</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php 
                            //print_r($res_book);
                            $sl_no=1;
                           foreach($res_book as $res)
                           {
                            $id=$res['id'];
                           
                            $book_ref_no=$res['book_ref_no'];
                            $book_name=$res['book_name'];
                            $author_name=$res['author_name'];
                            $edition=$res['edition'];
                            $year_of_publication=$res['year_of_publication'];
                            $place_publisher=$res['place_publisher'];
                            $volume=$res['volume'];
                            $page=$res['page'];
                            $price=$res['price'];
                            $quantity=$res['quantity'];
                            $location=$res['location'];
                            $row=$res['row'];
                            $book_type=$res['book_type'];
                            $book_category=$res['book_category'];
                            $status=$res['status'];
                            ?>
        <tr>
            <td><?php echo $sl_no++;?></td>
            <td><?php echo $book_ref_no?></td>
            <td><?php echo $book_name?></td>
            <td><?php echo $author_name?></td>
            <td><?php echo $edition?></td>
            <td><?php echo $year_of_publication?></td>
            <td><?php echo $place_publisher?></td>
            <td><?php echo $page?></td>
            <td><?php echo $price?></td>
            <td><?php echo $quantity?></td>
            <td><?php echo $location?></td>
            <td><?php echo $row?></td>
            <td><?php echo $book_type?></td>
            <td> 
                <?php
                    if(!empty($status))
                    { ?>
                        <span style="color:red">Deleted</span>
                   <?php }
                    else
                    { ?>
                        <button type="button" class="btn btn-primary" data-toggle="modal" style="padding: 10px 10px;"
                        data-target="#detailsModal_<?php echo $res['id']; ?>">
                        Edit
                        </button>
                        <button type="button" class="btn btn-danger" style="padding: 10px 10px;"
                        id="delete" value="<?php echo $res['id']; ?>" onclick="delete_book(this);">
                        Delete
                        </button>
                  <?php  } 
                ?>
                
                <input type="hidden" id="delete_id_<?=$id?>" value="<?=isset($id)?$id:'';?>" />
                <!--Tranee Detail Modal -->
                <div id="detailsModal_<?php echo $res['id']; ?>" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width:200%;margin-left: -33%;">
                            <div class="modal-header"
                                style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, #00acc1 0%, #1abc9c 100%);;color: #fff;">
                                <h5 class="modal-title" id="m_title" style="color:#fff" style="text-align:center;"> Book
                                    Details
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form id="frm_add_<?=$id?>">
                                    <input type="hidden" id="update_id_<?=$id?>" value="<?=isset($id)?$id:'';?>" />
                                    <div class="row" style="margin-left:2%;margin-right:2%;padding:1%">
                                        <div class="col-3" style="">
                                            <label>Reference No :</label>
                                            <input class="form-control me-3" name="book_ref_no" id="book_ref_no"
                                                value="<?=isset($book_ref_no)?$book_ref_no:'';?>"
                                                placeholder="Enter Reference No." required>
                                        </div>
                                        <div class="col-5" style="">
                                            <label>Book Name :</label>
                                            <input class="form-control me-3" name="book_name" id="book_name"
                                                value="<?=isset($book_name)?$book_name:'';?>"
                                                placeholder="Enter Book Name" required>
                                        </div>
                                        <div class="col-4" style="">
                                            <label>Author's Name :</label>
                                            <input class="form-control me-3" name="author_name" id="author_name"
                                                value="<?=isset($author_name)?$author_name:'';?>"
                                                placeholder="Enter Author Name" required>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left:2%;margin-right:2%;padding: 1%;">
                                        <div class="col-4">
                                            <label>Edition :</label>
                                            <input class="form-control me-2" name="edition" id="edition"
                                                value="<?=isset($edition)?$edition:'';?>" placeholder="Enter Edition"
                                                required>
                                        </div>
                                        <div class="col-4">
                                            <label>Year of Publication :</label>
                                            <input class="form-control me-2" name="year_of_publication"
                                                id="year_of_publication"
                                                value="<?=isset($year_of_publication)?$year_of_publication:'';?>"
                                                placeholder="Enter publication year" required>
                                        </div>
                                        <div class="col-4">
                                            <label>Place and Publisher :</label>
                                            <input class="form-control me-2" name="place_publisher" id="place_publisher"
                                                value="<?=isset($place_publisher)?$place_publisher:'';?>"
                                                placeholder="Enter Place and Publisher" required>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left:2%;margin-right:2%;padding: 1%;">
                                        <div class="col-4">
                                            <label>Page :</label>
                                            <input class="form-control me-2" name="page" id="page"
                                                value="<?=isset($page)?$page:'';?>" placeholder="Enter No.of Page"
                                                required>
                                        </div>
                                        <div class="col-4">
                                            <label>Price :</label>
                                            <input class="form-control me-2" name="price" id="price"
                                                value="<?=isset($price)?$price:'';?>" placeholder="Enter Price"
                                                required>
                                        </div>
                                        <div class="col-4">
                                            <label>Quantity :</label>
                                            <input class="form-control me-2" name="quantity" id="quantity"
                                                value="<?=isset($quantity)?$quantity:'';?>" placeholder="Enter Quantity"
                                                required>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left:2%;margin-right:2%;padding: 1%;">
                                        <div class="col-4">
                                            <label>Location :</label>
                                            <input class="form-control me-2" name="location" id="location"
                                                value="<?=isset($location)?$location:'';?>" placeholder="Enter Location"
                                                required>
                                        </div>
                                        <div class="col-4">
                                            <label>Row :</label>
                                            <input class="form-control me-2" name="row" id="row"
                                                value="<?=isset($row)?$row:'';?>" placeholder="Enter Row" required>
                                        </div>
                                       
                                        <div class="col-4">
                                            <label>Book Type :</label>
                                            <select class="form-control me-2" aria-label="Default select example" name ="book_category" id="book_category">
                                            <option value="">Select Book Category</option>
                                            <?php 
                                            if($res_book_cat){
                                            foreach($res_book_cat as $res_cat)
                                            { 
                                            $cat_id=$res_cat['id']; 
                                            if($book_category==$cat_id)
                                            {
                                                $selected="selected";
                                            }
                                            else
                                            {
                                                $selected="";
                                            }
                                            ?>
                                            <option value="<?php echo $cat_id?>" <?=$selected?>><?php echo $res_cat['book_category']?></option>
                                            <?php 
                                             }
                                            } ?>              
                                            </select>
                                        </div>
                                        </div>
                                    <div class="row" style="margin-left:2%;margin-right:2%;padding: 1%;">
                                        <div class="col-4">
                                            <label>Subject :</label>
                                            <input class="form-control me-2" name="book_type" id="book_type"
                                                value="<?=isset($book_type)?$book_type:'';?>"
                                                placeholder="Enter Book type" required>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                            <div class="modal-footer" id="m_footer">
                                <input type="submit" class="btn btn-primary" value="Update" id="<?=$id?>" onclick="update(this)">
                                <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
                            </div>
                        </div>
                    </div>
                </div>

            </td>
        </tr>
        <?php   }
                            ?>


    </tbody>
</table>
<?php } else 
{
    echo '<b style="color:red">No data found</b>';
}
?>
<script>
function delete_book(data) {
    var del_id=data.value;
    let delete_id = $("#delete_id_"+del_id).val();
    var location_id= '<?php echo $location_id ;?>';

    $.ajax({
        type: "POST",
        url: "ajax_case_master.php",
        data: {
            action: "delete_case",
            book_id: delete_id,
            table: "tbl_temp_book_detail",
        },

        success: function(res) {
           // alert(res);
            let elm = res.split('#');
            if (elm[0] == "success") {
                getBooksList(location_id);
                sessionStorage.message = "Book Details are Deleted successfully";
                sessionStorage.type = "error";
                showMessage();
                //location.reload();
            }


        }
    })
   
}
</script>