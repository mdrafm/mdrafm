<form id="frm_add">
    <div class="row">

        <div class="form-group col-md-6 ">
            <label>Name of the Petitioner :</label>
            <input class="form-control me-2" type="search" name="petitioner_name" id="petitioner_name"
                placeholder="Enter Name of The Petitioner" required>
            <small class="text-danger"></small>

        </div>
        <div class="form-group col-md-6 ">
            <label>Name of the Opposite Party :</label>
            <input class="form-control me-2" type="search" name="opposite_party" id="opposite_party"
                placeholder="Enter Name of The Opposite Party" required>
            <small class="text-danger"></small>

        </div>

    </div>
    <div id="case_ref">
        <div class="row">
            <div class="form-group col-md-4">
                <label>Case Type :</label>
                <select class="form-control " name="case_type[]" id="case_type" style="width: 100%;">

                    <option value="0">Select Case Type</option>
                    <?php
                                        // print_r($_SESSION);
                                                $db->select('tbl_case_type',"*",null,'status = 1','case_code',null);
                                            //  print_r( $db->getResult());
                                                foreach($db->getResult() as $type){
                                                    ?>

                    <option value="<?php echo $type['id'] ?>">
                        <?php echo ($type['case_desc'] == '')?$type['case_code']:$type['case_code'].'-'.$type['case_desc'] ?>
                    </option>
                    </option>
                    <?php
                                                }

                                            ?>

                </select>
                <small class="text-danger" id="caseType_err"></small>
            </div>
            <div class="form-group col-md-3">
                <label>Case Number :</label>
                <input class="form-control me-2" type="text" name="case_no[]" id="case_no" placeholder="Enter Case Number"
                    onkeypress="return onlyNumbers(event);" required>
                <small class="text-danger" id="caseNo_err"></small>

            </div>
            <div class="form-group col-md-3">
                <label>Case Year :</label>
                <select class="form-control " name="case_year[]" id="case_year" style="width: 100%;">

                    <option value="0">Select Case Year</option>
                    <?php
                                        // print_r($_SESSION);
                                                $db->select('tbl_case_type',"*",null,null,null,null);
                                            //  print_r( $db->getResult());
                                            $years = [2022,2021,2020,1999,1998,1997,1996,1995,1994,1993,1992,1991,1991];
                                                foreach($years as $year){
                                                    ?>

                    <option value="<?php echo $year ?>">
                        <?php echo $year ?>
                    </option>
                    <?php
                                                }

                                            ?>

                </select>
                <small class="text-danger" id="caseYear_err"></small>
            </div>
            <div class="form-group col-md-2">
           
              <input type="button" class="btn btn-primary" value="ADD MORE" id="add_more_case" style="padding: 5px;margin-top: 2.5rem;">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label>Name of Court which has passed the Judgement :</label>
            <select class="form-control " name="court_name" id="court_name" style="width: 100%;">

                <option value="0">Select Court Name</option>
                <?php
                                           
                                                $db->select('tbl_court',"*",null,null,'court_name',null);
                                               
                                                foreach($db->getResult() as $court){
                                                    ?>
                <option value="<?php echo $court['id'] ?>">
                    <?php echo $court['court_name'] ?>
                </option>
                <?php
                                                }

                                            ?>

            </select>
            <small class="text-danger" id="court_name_err"></small>
        </div>
        <div class="from-group col-md-6">
            <label>Date of Order :</label>
            <input type="text" class="form-control" id="order_date" name="order_date" placeholder="Order Date"
                autocomplete="off">
            <small class="text-danger"></small>
        </div>

    </div>
    <!-- <div class="row justify-content-end">
        <button class="btn btn-success" onclick="check_dup()" > check duplicate</button>
    </div> -->
    <div class="row">

        <div class="form-group col-md-6">
            <label>Broad Area :</label>
            <select class="form-control form-select " name="broad_area[]" id="broadArea" style="width: 100%;"
                multiple="multiple">

                <option value="0">Select Broad Area</option>
                <?php
                                                $db->select('tbl_broad_area',"*",null,null,"broad_area",null);
                                                foreach($db->getResult() as $broad){
                                                    ?>
                <option value="<?php echo $broad['id'] ?>">
                    <?php echo $broad['broad_area'] ?>
                </option>
                <?php
                                                }

                                            ?>

            </select>
            <small class="text-danger"></small>
        </div>
        <div class="form-group col-md-6">
            <label>Section Under GST Act :</label>
            <select class="form-control " name="section_gst_act[]" id="section_gst_act" style="width: 100%;"
                multiple="multiple">

                <option value="0">Select Section Under GST Act</option>
                <?php
                                      // print_r($_SESSION);
                                            $db->select('tbl_section_gst_act',"*",null,null,"section",null);
                                           //  print_r( $db->getResult());
                                            foreach($db->getResult() as $section){
                                                ?>
                <option value="<?php echo $section['id'] ?>">
                    <?php echo $section['section'] ?>
                </option>
                <?php
                                            }

                                        ?>

            </select>

        </div>

    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label>Rule Under GST Act :</label>
            <select class="form-control " name="rule_gst_act[]" id="rule_gst_act" style="width: 100%;"
                multiple="multiple">

                <option value="0">Select Rule Under GST Act</option>
                <?php
                                      // print_r($_SESSION);
                                            $db->select('tbl_rule_gst_act',"*",null,null,"rules",null);
                                           //  print_r( $db->getResult());
                                            foreach($db->getResult() as $rule){
                                                ?>
                <option value="<?php echo $rule['id'] ?>">
                    <?php echo $rule['rules'] ?>
                </option>
                <?php
                                            }

                                        ?>

            </select>

        </div>
        <div class="form-group col-md-6">
            <label>Government Circulars/Notifications :</label>
            <input class="form-control me-2" type="text" name="govt_circular" id="govt_circular"
                placeholder="Enter govt Circulars/Notifications" required>
            <small class="text-danger" id="govyCirculars_err"></small>

        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label>issue raised/Addresed in the Case :</label>

            <textarea class="form-control" id="issue_in_case"
                placeholder="Enter issue raised/Addresed in the Case " rows="5"></textarea>
            <small class="text-danger"></small>

        </div>

        <div class="form-group col-md-6">
            <label>Court Judgement in Brief :</label>

            <textarea class="form-control"  id="court_judgement"
                placeholder="Enter Court Judgement" rows="5"></textarea>
            <small class="text-danger"></small>

        </div>
    </div>
    <div class="row">

        <div class="form-group col-md-6">
            <label>Case File :</label>
            <input type="file" class="form-control" id="case_file" name="case_file" placeholder="Case File"
                autocomplete="off">
            <small class="text-danger" id="caseFile_error"></small>
        </div>
    </div>
    <!-- <input type="hidden" name="dept_id" value="<?php echo $_SESSION['dept_id'] ?>" /> -->
    </from>

    <script>
    function check_dup() {
        let petitioner_name = $('#petitioner_name').val();
        let opposite_party = $('#opposite_party').val();
        let case_type = $('#case_type').val();
        let case_no = $('#case_no').val();
        let case_year = $('#case_year').val();
        let court_name = $('#court_name').val();

        $.ajax({
            method: "POST",
            url: "ajax_gst_case.php",
            data: {
                action: 'check_dup',
                petitioner_name: petitioner_name,
                opposite_party: opposite_party,
                case_type: case_type,
                case_no: case_no,
                case_year: case_year,
                court_name: court_name,
            },
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                console.log(res);


            }
        })

    }
var cnt = 0;
    $('#add_more_case').click(function(){
       
       cnt++;
  
        $('#case_ref').append( `<div class="row" id="ref_case_div_${cnt}">
            <div class="form-group col-md-4">
                <label>Case Type :</label>
                <select class="form-control " name="case_type[]" id="case_type" style="width: 100%;">

                    <option value="0">Select Case Type</option>
                    <?php
                                        // print_r($_SESSION);
                                                $db->select('tbl_case_type',"*",null,'status = 1','case_code',null);
                                            //  print_r( $db->getResult());
                                                foreach($db->getResult() as $type){
                                                    ?>

                    <option value="<?php echo $type['id'] ?>">
                        <?php echo ($type['case_desc'] == '')?$type['case_code']:$type['case_code'].'-'.$type['case_desc'] ?>
                    </option>
                    </option>
                    <?php
                                                }

                                            ?>

                </select>
                <small class="text-danger" id="caseType_err"></small>
            </div>
            <div class="form-group col-md-3">
                <label>Case Number :</label>
                <input class="form-control me-2" type="text" name="case_no[]" id="case_no" placeholder="Enter Case Number"
                    onkeypress="return onlyNumbers(event);" required>
                <small class="text-danger" id="caseNo_err"></small>

            </div>
            <div class="form-group col-md-3">
                <label>Case Year :</label>
                <select class="form-control " name="case_year[]" id="case_year" style="width: 100%;">

                    <option value="0">Select Case Year</option>
                    <?php
                                        // print_r($_SESSION);
                                                $db->select('tbl_case_type',"*",null,null,null,null);
                                            //  print_r( $db->getResult());
                                            $years = [2022,2021,2020,1999,1998,1997,1996,1995,1994,1993,1992,1991,1991];
                                                foreach($years as $year){
                                                    ?>

                    <option value="<?php echo $year ?>">
                        <?php echo $year ?>
                    </option>
                    <?php
                                                }

                                            ?>

                </select>
                <small class="text-danger" id="caseYear_err"></small>
            </div>
            <div class="form-group col-md-2">
                <input type="button" class="btn btn-danger" value="REMOVE" onclick="remove_ref(${cnt})" style="padding: 5px;margin-top: 2.5rem;">
            </div>
        </div>`);
    })
    function remove_ref(id){
        console.log(id);
        $('#ref_case_div_'+id).remove();
    }
    </script>