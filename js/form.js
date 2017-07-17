// return id element
function $(id){
  var element = document.getElementById(id);
  if( element == null ){
    var err = new Error();
    err.message = 'Programmer error: ' + id + ' does not exist.';
    throw err;
  }
  return element;
}
// display error
function displayError(id, errorId, errorMessage) {
  $(id).className = 'invalidForm';
  $(errorId).className = 'error';
  $(errorId).innerHTML = errorMessage;
}
// clear error
function clearError(id, errorId) {
  $(id).className = '';
  $(errorId).className = 'nonError';
}

// validation for login page
function loginFormValidate() {
  try {
    var ret = true;
    // user name
    if(!(validateUserName('username', 'error-username'))) {
      ret = false;
    }
    // passward
    if(!(validatePassword('password', 'error-password'))) {
      ret = false;
    }
    return ret;
  } catch(e) {
    alert(e.message);
    return false;
  }
}
// validation for sign up page
function signupFormValidate() {
  try {
    var ret = true;
    // user name
    if(!(validateUserName('username', 'error-username'))) {
      ret = false;
    }
    // e-mail
    if(!(validateEmail('email', 'error-email'))) {
      ret = false;
    }
    // passward
    if(!(validatePassword('password', 'error-password'))) {
      ret = false;
    }
    return ret;
  } catch(e) {
    alert(e.message);
    return false;
  }
}

// validate user name
function validateUserName(id, errorId) {
  if(!testNameBlank(id)) {
    displayError(id, errorId, "Please enter your name.");
    return false;
  } else if(!testNameValid(id)) {
    displayError(id, errorId, "Please enter 1-15 letters, digits and English characters.");
    return false;
  } else {
    clearError(id, errorId);
    return true;
  }
}
function testNameBlank(id){
  if($(id).value.trim().length == 0) {
    return false;
  }
  return true;
}
function testNameValid(id) {
  var nameFormat = /^[\w]{1,15}$/;
  if($(id).value.trim().match(nameFormat)) {
    return true;
  }
  return false;
}

// validate password
function validatePassword(id, errorId) {
  if(!testPasswordBlank(id)) {
    displayError(id, errorId, "Please enter your password.");
    return false;
  } else if(!testPasswordValid(id)) {
    displayError(id, errorId, "Please enter 6-10 letters, digits and English characters.");
    return false;
  } else {
    clearError(id, errorId);
    return true;
  }
}
function testPasswordBlank(id) {
  if($(id).value.trim().length == 0) {
    return false;
  }
  return true;
}
function testPasswordValid(id) {
  var passwordFormat = /^[\w]{6,10}$/;
  if($(id).value.trim().match(passwordFormat)) {
    return true;
  }
  return false;
}

// validate e-mail
function validateEmail(id, errorId) {
  if(!testEmailBlank(id)) {
    displayError(id, errorId, "Please enter your email address.");
    return false;
  } else if(!testEmailValid(id)) {
    displayError(id, errorId, "Please enter valid email address.");
    return false;
  } else {
    clearError(id, errorId);
    return true;
  }
}
function testEmailBlank(id) {
  var email = $(id).value.trim();
  if($(id).value.trim().length == 0){
    return false;
  }
  return true;
}
function testEmailValid(id) {
    var email = $(id).value.trim();
    var emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if($(id).value.trim().match(emailFormat)) {
      return true;
    }
    return false;
}
