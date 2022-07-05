/* Customize your message & rules
* jQery Validation js library
*/
$(document).ready(function() {

//  Login Form Validation Start
  $("#loginForm").validate({
      rules: {
          email: {
              required: true,
              email: true,
              maxlength: 50
          },
          password: {
              required: true,
              minlength: 5
          },
      },
      messages: {
          email: {
              required: "Email is required",
              email: "Email must be a valid email address",
              maxlength: "Email cannot be more than 50 characters",
          },
          password: {
              required: "Password is required",
              minlength: "Password must be at least 5 characters"
          }, 
      }
  });

  // Login Form Validation End

  // Signup form start
  $("#signUpForm").validate({
    rules: {
        user_name: {
            required: true,
            maxlength: 20,
        },
        first_name: {
            required: true,
            maxlength: 10,
        },
        last_name: {
            required: true,
            maxlength: 10,
        },
        email: {
            required: true,
            email: true,
            maxlength: 50
        },
        password: {
            required: true,
            minlength: 5
        }

    },
    messages: {
        email: {
            email: "Email must be a valid email address",
            maxlength: "Email cannot be more than 50 characters",
        },
        password: {
            required: "Password is required",
            minlength: "Password must be at least 5 characters"
        }
    }

  });


});