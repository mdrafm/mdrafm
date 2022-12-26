<div class="col-md-12" style="padding:0px !important;">
			<div class="row filterform">
				<div class="col-md-4" style="padding-right:0px !important">
					<div class="portlet box blue-steel">
						<div class="portlet-title">
							<div class="caption">
								<i class="glyphicon glyphicon-search"></i>Select Search Criteria
							</div>
						</div>
						<div class="portlet-body form">
							<form action="javascript:;" class="form-horizontal resetAllForm">
								<div class="form-body" style="padding:5px !important">
									<div class="row" style="line-height: 2.6rem;">
										<div class="col-md-6" style="padding-right:5px !important">
											<div class="checkbox">
												<label class="checker">
													
													<input type="checkbox" class="checkbox2" onclick="SetFilterField(this);" data-target="casetype"><span> Case/Reg. Type</span>
													<span class="checkmark"></span>
												</label>
											</div>
										</div>
										<div class="col-md-6" style="padding-right:5px !important">
											<div class="checkbox">
												<label  class="checker"><input type="checkbox" class="checkbox2" onclick="SetFilterField(this);" data-target="caseno">
												<span> Case/Reg. No</span></label>
											</div>
										</div>
										<div class="col-md-6" style="padding-right:5px !important">
											<div class="checkbox">
												<label><input type="checkbox" class="checkbox2" onclick="SetFilterField(this);" data-target="caseyear"><span> Case/Reg. Year</span></label>
											</div>
										</div>
										<div class="col-md-6" style="padding-right:5px !important">
											<div class="checkbox">
												<label><input type="checkbox" class="checkbox2" onclick="SetFilterField(this);" data-target="orderDate"><span> Order Date</span></label>
											</div>
										</div>
										<div class="col-md-6" style="padding-right:5px !important">
											<div class="checkbox">
												<label><input type="checkbox" class="checkbox2" onclick="SetFilterField(this);" data-target="broadArea"><span> Broad Area</span></label>
											</div>
										</div> 
										<div class="col-md-6" style="padding-right:5px !important">
											<div class="checkbox">
												<label><input type="checkbox" class="checkbox2" onclick="SetFilterField(this);" data-target="partyName"><span> Petitioner Name</span></label>
											</div>
										</div>
										<div class="col-md-6" style="padding-right:5px !important">
											<div class="checkbox">
												<label><input type="checkbox" class="checkbox2" onclick="SetFilterField(this);" data-target="courtName"><span> Court Name</span></label>
											</div>
										</div>
										<div class="col-md-6" style="padding-right:5px !important">
											<div class="checkbox">
												<label><input type="checkbox" class="checkbox2" onclick="SetFilterField(this);" data-target="section_gst_act"><span>Section GST Act</span></label>
											</div>
										</div>
										<div class="col-md-6" style="padding-right:5px !important">
											<div class="checkbox">
												<label><input type="checkbox" class="checkbox2" onclick="SetFilterField(this);" data-target="rule_gst_act"><span> Rule GST Act</span></label>
											</div>
										</div>

										<div class="col-md-6" style="padding-right:5px !important">
											<div class="checkbox">
												<label><input type="checkbox" class="checkbox2" onclick="SetFilterField(this);" data-target="keyword"><span>Keyword Search </span></label>
											</div>
										</div>

									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-8" style="padding-right:0px !important">
					<div class="portlet box blue-steel myfiltermain myfilter-1 text-box-hide">
						<div class="portlet-title">
							<div class="caption">
								<i class="glyphicon glyphicon-search"></i>Please Enter Search Values
							</div>
						</div>
					
					<div class="portlet-body form">
						<form action="javascript:;" id="commonForm" class="form-horizontal resetAllForm">
							<div class="row" style="margin-left:0px !important;">

								<div class="col-md-6 casetype mt-3" style="display: none;">
									<div class="row">
										<label class="control-label col-md-5" for="casetype">Case Type :</label>
										<div class="col-md-7">
											<div class="input select">
												<select name="casetype" id="case_type" class="form-control form-select checkInputExistsOrNot" data-placeholder="Select Case Type">
													<option value="0">Select Case Type</option>
                                                  <?php
												    $db->select('tbl_case_type',"*",null,'status = 1',null,null);
													$result = $db->getResult();
													foreach($result as $type){
														?>
														<option value="<?php echo $type['id'] ?>"><?php echo ($type['case_desc'] == '')?$type['case_code']:$type['case_code'].'-'.$type['case_desc'] ?></option>
														<?php
													}
												  ?>
												</select>
												<small class="text-danger" id="case_type_err"></small>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 caseno mt-3" style="display: none;">
									<div class="row">
										<label class="control-label col-md-5" for="caseno">Case No :</label>
										<div class="col-md-7">
											<input type="text" placeholder="Case No" name="case_name" class="form-control checkInputExistsOrNot disableZero" id="caseno" maxlength="10" onkeypress="return onlyNumbers(event);" />
											<small class="text-danger" id="caseno_err"></small>
										</div>
									</div>
								</div>
								<div class="col-md-6 caseyear mt-3" style="display: none;">
									<div class="row">
										<label class="control-label col-md-5" for="caseyear">Case Year</label>
										<div class="col-md-7">
											<div class="input select">
												<select name="case_year" id="caseyear" class="form-control form-select checkInputExistsOrNot" data-placeholder="Select Case Year">
												<option value="0">Select Case Year</option>
                                                  <?php
												   $caseYearSql = "SELECT case_year FROM `tbl_case_ref` GROUP BY case_year DESC";
												    $db->select_sql($caseYearSql);
													$result = $db->getResult();
													foreach($result as $year){
														?>
														<option value="<?php echo $year['case_year'] ?>"><?php echo $year['case_year'] ?></option>
														<?php
													}
												  ?>
												</select>
												<small class="text-danger" id="caseyear_err"></small>
											</div>
										</div>
									</div>
								</div>
                                <div class="col-md-6 orderDate mt-3" style="display: none;">
									<div class="row">
										<label class="control-label col-md-5" for="orderDate">Order Date :</label>
										<div class="col-md-7">
											<input type="text" placeholder="Order Date" name="order_date" class="form-control checkInputExistsOrNot" id="order_date" />
											<small class="text-danger" id="case_type_err"></small>
										</div>
									</div>
								</div>
								<div class="col-md-6 broadArea mt-3" style="display: none;">
									<div class="row">
										<label class="control-label col-md-5" for="broadArea">Broad Area</label>
										<div class="col-md-7">
											<div class="input select">
												<select name="broad_Area[]" id="broadArea" class="form-control form-select checkInputExistsOrNot" data-placeholder="Select Broad Area" multiple="multiple">
												<option value="0">Select Broad Area</option>
                                                  <?php
												    $db->select('tbl_broad_area',"*",null,"status=1",null,null);
													$result = $db->getResult();
													foreach($result as $row){
														?>
														<option value="<?php echo $row['id'] ?>"><?php echo $row['broad_area'] ?></option>
														<?php
													}
												  ?>
												</select>
												<small class="text-danger" id="broadArea_err"></small>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 partyName mt-3" style="display: none;">
									<div class="row">
										<label class="control-label col-md-5" for="partyName">Petitioner Name</label>
										<div class="col-md-7">
											<div class="input select">
												<select name="party_name" id="partyName" class="form-control form-select checkInputExistsOrNot" data-placeholder="Select Party Name">
													<option value="0">Select Petitioner</option>
														<?php
														$party_sql = "SELECT party_name FROM `tbl_gst_case_law` GROUP BY party_name ASC";
														$db->select_sql($party_sql);
														$result = $db->getResult();
														foreach($result as $party){
															?>
															<option><?php echo $party['party_name'] ?></option>
															<?php
														}
														?>
												</select>
												<small class="text-danger" id="partyName_err"></small>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 courtName mt-3" style="display: none;">
									<div class="row">
										<label class="control-label col-md-5" for="courtName">Court Name</label>
										<div class="col-md-7">
											<div class="input select">
												<select name="court_name" id="courtName" class="form-control form-select checkInputExistsOrNot" data-placeholder="Select Court Name">
                                                <option value="0">Select Court</option>
                                                  <?php
												    $db->select('tbl_court',"*",null,null,'court_name',null);
													$result = $db->getResult();
													foreach($result as $court){
														?>
														<option value="<?php echo $court['id'] ?>"><?php echo $court['court_name'] ?></option>
														<?php
													}
												  ?>
												</select>
												<small class="text-danger" id="courtName_err"></small>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 section_gst_act mt-3" style="display: none;">
									<div class="row">
										<label class="control-label col-md-5" for="section_gst_act">Section GST Act</label>
										<div class="col-md-7">
											<div class="input select">
												<select name="section_gst_act[]" id="section_gst_act2" class="form-control form-select checkInputExistsOrNot" data-placeholder="Select Section"  multiple="multiple">
                                                <option value="0">Select Section</option>
                                                  <?php
												    $db->select('tbl_section_gst_act',"*",null,null,null,null);
													$result = $db->getResult();
													foreach($result as $section){
														?>
														<option value="<?php echo $section['id'] ?>"><?php echo $section['section'] ?></option>
														<?php
													}
												  ?>
												</select>
												<small class="text-danger" id="section_err"></small>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-6 rule_gst_act mt-3" style="display: none;">
									<div class="row">
										<label class="control-label col-md-5" for="rule_gst_act">Rule GST Act</label>
										<div class="col-md-7">
											<div class="input select">
												<select name="rule_gst_act[]" id="rule_gst_act" class="form-control form-select checkInputExistsOrNot" data-placeholder="Select Rule GST Act"  multiple="multiple">
                                                <option value="0">Select Rules</option>
                                                  <?php
												    $db->select('tbl_rule_gst_act',"*",null,null,null,null);
													$result = $db->getResult();
													foreach($result as $rule){
														?>
														<option value="<?php echo $rule['id'] ?>"><?php echo $rule['rules'] ?></option>
														<?php
													}
												  ?>
												</select>
												<small class="text-danger" id="rule_err"></small>
											</div>
										</div>
									</div>
								</div>
                                <div class="col-md-8 keyword mt-3" style="display: none;">
									<div class="row">
										<label class="control-label col-md-5" for="keyword"> Enter Keyword</label>
										<div class="col-md-7">
										    <input type="text" placeholder="Keyword Search" name="keyword" id="keyword" class="form-control checkInputExistsOrNot disableZero" />
											<small class="text-danger" id="keyword_err"></small>
										</div>
									</div>
								</div>
								<input type="hidden" name="view_only" id="view_only">
								<div class="form-actions mt-4" style="display: none;width: 99%;">

									<div class="row">
										<div class="col-md-10" style="text-align: center;">
											<center>
												<input type="hidden" class="mychkfieldcount" value="0" />
												<div class="alert alert-success success_message" style="display:none;">
												</div>
                                                <?php 
                                                
                                                 if( isset($_SESSION) ){
                                                    $flag= 2;
                                                 }else{
                                                    $flag= 1;
                                                 }
                                                
                                                ?>
												<button type="button" class="btn btn-success myGetDataBtn" id="btncasedetail1_1" onclick="GetRecordCount(<?php echo $flag ?>)" >SEARCH</button>
                                           
												<!-- <button type="submit" class="btn green" id="btncasedetail1_2" onclick="return GetDetail(this);">Get Data</button> -->
												<button type="submit" class="btn btn-warning reset" onclick="resetAll(this);" >Reset</button>
											</center>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>

		