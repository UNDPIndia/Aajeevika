/* Customize your message & rules
* jQery Validation js library
*/
$(document).ready(function() {

  // Signup form start
  $("#signUpForm").validate({
    rules: {
        role_id: {
            required: true,
            number: true,
        },
        name: {
            required: true,
            maxlength: 255,
        },
        email: {
            //required: true,
            email: true,
            maxlength: 255
        },
        mobile: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number: true
        },
        password: {
            required: true,
            minlength: 8
        },
        password_confirmation: {
            required: true,
            equalTo: "#password"
        },
        profileImage: {
            required: true,
        },
        example1: {
            required: true,
        }

    },
    messages: {
        email: {
            email: "Email must be a valid email address",
            maxlength: "Email cannot be more than 50 characters",
        },
        password: {
            required: "Password is required",
            minlength: "Password must be at least 8 characters"
        }
    }

  });


});