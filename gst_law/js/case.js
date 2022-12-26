$('#broadArea').select2({
    placeholder: "Select a Broad Area",
    allowClear: true,
    
});
$('#section_gst_act2').select2({
    placeholder: "Select a Section under GST Act",
    allowClear: true,
    
});
$('#rule_gst_act').select2({
    placeholder: "Select Rules GST Act",
    allowClear: true,

});

$("#order_date").datepicker({
    changeMonth: true,
    changeYear: true,
    yearRange: "-100:+0"
});

	const casetypeEl = document.querySelector('#case_type');
    const casenoEl = document.querySelector('#caseno');
    const caseyearE1 = document.querySelector('#caseyear');
	const broadAreaEl = document.querySelector('#broadArea');
    const partyNameEl = document.querySelector('#partyName');
	const courtNameE1 = document.querySelector('#courtName');
    



    const sectionGstActE1 = document.querySelector('#section_gst_act');
	const ruleGstActE1 = document.querySelector('#rule_gst_act');
	const keywordE1 = document.querySelector('#keyword');

  
	function resetAll(elem){
		$(elem).closest('form').find('input[type=text], textarea').val('');
	    $('#case_type').val('0');
		$('#caseyear').val('0');
		$('#broadArea').val('').trigger('change');
		$('#partyName').val('0');
		$('#courtName').val('0');
		$('#section_gst_act').val('').trigger('change');
		$('#rule_gst_act').val('').trigger('change');
			   
	    //resetradio(elem);
	}

function GetRecordCount(flag){

	let  isCasenoValid = true;
	let  isCasetypeValid = true;
	let  isCaseyearValid = true;
	let  isBroadAreaValid = true;
	let  ispartyNameValid = true;
	let  iscourtNameValid = true;
	let  isSectionGstActValid = true;
	let  isRuleGstActValid = true;
	let  isKeywordValid = true;
	
	$('.checkbox2').each(function(){	
		
		//console.log(this);
			if($(this).is(':checked') && $(this).attr('data-target')=='keyword' && $('#keyword').val() == ''){
				isKeywordValid = checkTextField(keywordE1);
				
			}
			if($(this).is(':checked') && $(this).attr('data-target')=='caseno' && $('#caseno').val() == ''){
				isCasenoValid = checkTextField(casenoEl);
				
			}
			if($(this).is(':checked') && $(this).attr('data-target')=='casetype' && $('#case_type').val() == 0){
				isCasetypeValid = checkDropdown(casetypeEl);
				
			}
			if($(this).is(':checked') && $(this).attr('data-target')=='caseyear' && $('#caseyear').val() == 0){
				isCaseyearValid = checkDropdown(caseyearE1);
			}
			if($(this).is(':checked') && $(this).attr('data-target')=='broadArea' && $('#broadArea').val() == 0){
				isBroadAreaValid = checkDropdown(broadAreaEl);
			}
			if($(this).is(':checked') && $(this).attr('data-target')=='partyName' && $('#partyName').val() == 0){
				ispartyNameValid = checkDropdown(partyNameEl);
			}
			if($(this).is(':checked') && $(this).attr('data-target')=='courtName' && $('#courtName').val() == 0){
				iscourtNameValid = checkDropdown(courtNameE1);
			}
			if($(this).is(':checked') && $(this).attr('data-target')=='section_gst_act' && $('#section_gst_act').val() == 0){
				isSectionGstActValid = checkDropdown(sectionGstActE1);
			}
			if($(this).is(':checked') && $(this).attr('data-target')=='rule_gst_act' && $('#rule_gst_act').val() == 0){
				isRuleGstActValid = checkDropdown(ruleGstActE1);
			}
		
	})
	 if(isCasetypeValid){
			$('#case_type_err').hide();
		}
	if(isCasenoValid){
		$('#caseno_err').hide();
	}
	if(isCaseyearValid){
		$('#caseyear_err').hide();
	}
	if(isBroadAreaValid){
		$('#broadArea_err').hide();
	}
	if(ispartyNameValid){
		$('#partyName_err').hide();
	}
	if(iscourtNameValid){
		$('#courtName_err').hide();
	}
	if(isSectionGstActValid){
		$('#section_err').hide();
	}
	if(isRuleGstActValid){
		$('#rule_err').hide();
	}
	if(isKeywordValid){
		$('#keyword_err').hide();
	}
	let isFormValid = isCasetypeValid &&
	                  isCasenoValid &&
	                  isCaseyearValid && 
					  isBroadAreaValid && 
					  ispartyNameValid && 
					  iscourtNameValid && 
					  isRuleGstActValid &&
					  isKeywordValid;
	// console.log(isCasetypeValid,isCasenoValid,isCaseyearValid,isBroadAreaValid,ispartyNameValid,iscourtNameValid);

	if (isFormValid) {
		
        let caseType = $('#case_type').val();
		let caseNo = $('#caseno').val();
		let caseYear = $('#caseyear').val();
		let broadArea = $('#broadArea').val();
		let partyName = $('#partyName').val();
		let courtName = $('#courtName').val();
		let orderDate = $('#orderDate').val();
		let section_gst_act = $('#section_gst_act').val();
		let rule_gst_act = $('#rule_gst_act').val();
		let keyword = $('#keyword').val();
		let view = $('#view_only').val();
       // console.log(view);
		var caseYear_text = '';
		var partyName_text ='';
        
		if(caseYear != 0){
             caseYear_text = $('#caseyear option:selected').text();
        }
		if(partyName != 0){
             partyName_text = $('#partyName option:selected').text();
        }
		
         if(flag == 2){
			URL ="../ajax_master.php";
		 }else{
			URL ="ajax_master.php";
		 }
		console.log(URL);

			$.ajax({
			type: "POST",
			url: URL,
			beforeSend: function(){
				$('.loader').show();
				$('#tbl_case_law').html('');
				
				},
			data: {
				action:"search_case",
				caseNo:caseNo,
				caseType:caseType,
				caseYear:caseYear_text,
				broadArea:broadArea,
				partyName:partyName_text,
				courtName:courtName,
				orderDate:orderDate,
				section_gst_act:section_gst_act,
				rule_gst_act:rule_gst_act,
				keyword:keyword,
				view:view
				

			},
			
			success: function(data) {
					console.log(data);
				$('.loader').hide();
			 $('#tbl_case_law').html(data);
			 $('#case_law').DataTable();
			}
			
		})
		
	}
}

function onlyNumbers(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		alert('Enter Only Numbers');
        return false;
    }
    else {
        return true;
    }
}

	function SetFilterField(elem) {
		
		$('.form-actions').show();
		var MyTarget = $(elem).attr('data-target');
		console.log(elem);
		if ($(elem).is(":checked")) {
			if (MyTarget == 'casetype') {
				$('.' + MyTarget).show();

			}
			if(MyTarget == 'caseno'){
				$('.' + MyTarget).show();
			}
			if(MyTarget == 'caseyear'){
				$('.' + MyTarget).show();
			}
			if(MyTarget == 'orderDate'){
				$('.' + MyTarget).show();
			}
			if(MyTarget == 'broadArea'){
				$('.' + MyTarget).show();
			}
			if(MyTarget == 'partyName'){
				$('.' + MyTarget).show();
			}
			if(MyTarget == 'courtName'){
				$('.' + MyTarget).show();
			}
			if(MyTarget == 'section_gst_act'){
				$('.' + MyTarget).show();
			}
			if(MyTarget == 'rule_gst_act'){
				$('.' + MyTarget).show();
			}
			if(MyTarget == 'keyword'){
				$('.' + MyTarget).show();
			}
		} else {
			if (MyTarget == 'casetype') {
				$('.' + MyTarget).hide();

			}
			if(MyTarget == 'caseno'){
				$('.' + MyTarget).hide();
			}
			if(MyTarget == 'caseyear'){
				$('.' + MyTarget).hide();
			}
			if(MyTarget == 'orderDate'){
				$('.' + MyTarget).hide();
			}
			if(MyTarget == 'broadArea'){
				$('.' + MyTarget).hide();
			}
			if(MyTarget == 'partyName'){
				$('.' + MyTarget).hide();
			}
			if(MyTarget == 'courtName'){
				$('.' + MyTarget).hide();
			}
			if(MyTarget == 'section_gst_act'){
				$('.' + MyTarget).hide();
			}
			if(MyTarget == 'rule_gst_act'){
				$('.' + MyTarget).hide();
			}
			if(MyTarget == 'keyword'){
				$('.' + MyTarget).hide();
			}
		}
	}

	
function add_case() {
	console.log(1243);
	const casetypeEl = document.querySelector('#case_type');
    const casenoEl = document.querySelector('#case_no');
    const caseyearE1 = document.querySelector('#case_year');
	const broadAreaEl = document.querySelector('#broadArea');
	const courtNameE1 = document.querySelector('#court_name');
	const orderDateE1 = document.querySelector('#order_date');
	
	const petitionerNameEl = document.querySelector('#petitioner_name');
	const oppositePartyEl = document.querySelector('#opposite_party');
	const courtJudgementEl =  CKEDITOR.instances['court_judgement'].getData();
	const issueInCaseaseEl =  CKEDITOR.instances['issue_in_case'].getData(); 

    console.log(courtJudgementEl);
	console.log(issueInCaseaseEl);

    let     isPetitionerNameValid = checkTextField(petitionerNameEl),
	        isOppositePartyValid = checkTextField(oppositePartyEl),
	        isCasenoValid = checkTextField(casenoEl),
			isCasetypeValid = checkDropdown(casetypeEl),
			isCaseyearValid = checkDropdown(caseyearE1),
			iscourtNameValid = checkDropdown(courtNameE1),
			isOrderDateValid = checkTextField(orderDateE1),
			isBroadAreaValid = checkDropdown(broadAreaEl)
			// isCourtJudgementValid = checkTextField(courtJudgementEl),
			// isIssueInCaseaseValid = checkTextField(issueInCaseaseEl);


    // let file_name = document.getElementById("circular_file").files;
    // iscircularFileValid = chkFile(file_name);
	//console.log(iscourtNameValid)


    let isFormValid = isCasetypeValid &&
	                  isCasenoValid &&
	                  isCaseyearValid && 
					  isBroadAreaValid && 
					  isPetitionerNameValid && 
					  isOppositePartyValid && 
					  iscourtNameValid && 
					  isOrderDateValid;
					//   isCourtJudgementValid && 
					//   isIssueInCaseaseValid;
    
   // let isFormValid = true;

    if (isFormValid) {

        var name = document.getElementById("case_file").files[0];
		if(name){
			name = name.name;
			var ext = name.split('.').pop().toLowerCase();
			if (jQuery.inArray(ext, ['pdf']) == -1) {
			alert("Invalid Case File");
		   }
	    }

        var form_data = new FormData(document.querySelector('form'));
        
        form_data.append("action", "add_case");
		form_data.append("issue_in_case",issueInCaseaseEl);
		form_data.append("court_judgement", courtJudgementEl);

        // console.log(name);
        $.ajax({
            method: "POST",
            url: "ajax_gst_case.php",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                console.log(res);

                let elm = res.split('#');
                if (elm[0] == "success") {
                    sessionStorage.message = elm[1];
                    sessionStorage.type = "success";
                    location.reload();
                }

                // if (elm[0] == "dup") {
                //     $('#circularNo_err').html('Circular Number Already Present');
                // }
            }
        })
    }

}


function drop_alert(id) {
    $('#alert_boxLabel2').html("Delete Case");
    $('.alrt_msg').html("Are you sure  want to Delete this Case");
    $('#footer_alert').html(`<button type="button" class="btn  btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="button" class="btn  btn-danger" onclick="remove(${id})" >Delete
                                </button>`);
    $('#alert_box').modal('show');
}

function approve_alert(id) {
    $('#alert_boxLabel2').html("Approve Case");
    $('.alrt_msg').html("Are you sure  want to Approve this Case for approval.");
    $('#footer_alert').html(`<button type="button" class="btn  btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="button" class="btn  btn-success" onclick="approval_case(${id})" >Approve
                                </button>`);
    $('#alert_box').modal('show');
}
function approval_alert(id) {
    $('#alert_boxLabel2').html(" Send Case for Approval");
    $('.alrt_msg').html("Are you sure  want to Send this Case for approval.");
    $('#footer_alert').html(`<button type="button" class="btn  btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="button" class="btn  btn-success" onclick="approval_case(${id})" >Send
                                </button>`);
    $('#alert_box').modal('show');
}
function final_approve_alert(id) {
    $('#alert_boxLabel2').html("Approve Case");
    $('.alrt_msg').html("Are you sure  want to Approve this Case for approval.");
    $('#footer_alert').html(`<button type="button" class="btn  btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="button" class="btn  btn-success" onclick="final_approve_case(${id})" >Approve
                                </button>`);
    $('#alert_box').modal('show');
}

function remove(id) {
    $.ajax({
        type: "POST",
        url: "ajax_case_master.php",
        data: {
            action: "remove_case",
            case_id: id,
            table: "tbl_gst_case_law"

        },

        success: function(res) {
            console.log(res);
            let elm = res.split('#');
            if (elm[0] == "success") {
                sessionStorage.message = elm[1];
                sessionStorage.type = "success";
                location.reload();
            }


        }
    })
}

function approval_case(id){
	$.ajax({
        type: "POST",
        url: "ajax_gst_case.php",
        data: {
            action: "approval_case",
            case_id: id,
            table: "tbl_gst_case_law"

        },

        success: function(res) {
            console.log(res);
            let elm = res.split('#');
            if (elm[0] == "success") {
                sessionStorage.message = "Send To Approve";
                sessionStorage.type = "success";
                location.reload();
            }


        }
    })
}

function final_approve_case(id){
	$.ajax({
        type: "POST",
        url: "ajax_gst_case.php",
        data: {
            action: "final_approval_case",
            case_id: id,
            table: "tbl_gst_case_law"

        },

        success: function(res) {
            console.log(res);
            let elm = res.split('#');
            if (elm[0] == "success") {
                sessionStorage.message = "Case Approved Successfully";
                sessionStorage.type = "success";
                location.reload();
            }


        }
    })
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