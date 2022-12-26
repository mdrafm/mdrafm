const isRequired = value => value === '' ? false : true;
const isSelect = value => (value === '0' || value === '') ? false : true;
const isBetween = (length, min, max) => length < min || length > max ? false : true;

const isEmailValid = (email) => {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};
const isPhoneValid = (phone) => {
    const re = /^\d{10}$/;
        return phone.match(re);
};

const isPasswordSecure = (password) => {
    const re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    return re.test(password);
};

const isEmailExists = (email) =>{
    var status = '' ;
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {'action':'chk_email','email':email},
        async: false,
        success: function(data) {
            console.log(data);
            if (data == 'yes'){
                status = false;
            }else{
                status = true;
            }
           
        }
    })

  return status;
} 

const isPhoneExists = (phone) =>{
    var status = '' ;
    $.ajax({
        type: "POST",
        url: "ajax_master.php",
        data: {'action':'chk_phone','phone':phone},
        async: false,
        success: function(data) {
            console.log(data);
            if (data == 'yes'){
                status = false;
            }else{
                status = true;
            }
           
        }
    })

  return status;
} 

const showError = (input, message) => {
    // get the form-field element
    const formField = input.parentElement;
    // add the error class
    formField.classList.remove('success');
    formField.classList.add('error');

    // show the error message
    const error = formField.querySelector('small');
    error.textContent = message;
};

const showSuccess = (input) => {
    // get the form-field element
    const formField = input.parentElement;

    // remove the error class
    formField.classList.remove('error');
    formField.classList.add('success');

    // hide the error message
    const error = formField.querySelector('small');
    error.textContent = '';
}

const checkTextField = (Elm) => {

    let valid = false;

    const text = Elm.value.trim();

    if (!isRequired(text)) {
        showError(Elm, 'This Field cannot be blank.');
    } else {
        showSuccess(Elm);
        valid = true;
    }
    return valid;
}

const checkDropdown = (elm) => {

    let valid = false;
    const id = elm.value;
    console.log(elm);
    if (!isSelect(id)) {

        showError(elm, 'Please Select This Field .');
    } else {

        showSuccess(elm);
        valid = true;
    }
    return valid;
}

const checkEmail = (elm) => {
   
    let valid = false;
    const email = elm.value.trim();
    
    //console.log(isEmailValid(email));
    if (!isRequired(email)) {
        showError(elm, 'Email cannot be blank.');
    } else if (!isEmailValid(email)) {
        showError(elm, 'Email is not valid.')
    } else if(!isEmailExists(email)){
        showError(elm, 'Email already present.');
    } else {
        showSuccess(elm);
        valid = true;
    }
    return valid;
}

const checkPhone = (elm) => {
   
    let valid = false;
    const phone = elm.value.trim();
    
    //console.log(isEmailValid(email));
    if (!isRequired(phone)) {
        showError(elm, 'Phone No  cannot be blank.');
    } else if (!isPhoneValid(phone)) {
        showError(elm, 'Phone No  Should be 10 digits.');
    }else if (!isPhoneExists(phone)) {
        showError(elm, 'Phone No  already present.');
    }  else {
        showSuccess(elm);
        valid = true;
    }
    return valid;
}

const checkPassword = (elm) => {

    let valid = false;

    const password = elm.value.trim();

    if (!isPasswordSecure(password)) {
        showError(elm, 'Password must has at least 8 characters that include at least 1 lowercase character, 1 uppercase characters, 1 number, and 1 special character in (!@#$%^&*)');
    } else {
        showSuccess(elm);
        valid = true;
    }

    return valid;
};

const checkConfirmPassword = (elm,elm2) => {
    let valid = false;
    // check confirm password
    const confirmPassword = elm.value.trim();
    const password = elm2.value.trim();

    if (!isRequired(confirmPassword)) {
        showError(elm, 'Please enter the password again');
    } else if (password !== confirmPassword) {
        showError(elm, 'Confirm password does not match');
    } else {
        showSuccess(elm);
        valid = true;
    }

    return valid;
};

const chkFile = (name)=>{
    let valid = true;
    $('#file_error').html('');
    if(name.length == 0){
        
        $('#file_error').html('Please Upload  File ');
        valid = false;
    }
    return valid;
 }