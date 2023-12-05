$(document).ready(function() {
    $('#signupForm').submit(function(e) {
      e.preventDefault(); // Prevent default form submission
      var formData = $(this).serialize(); // Serialize form data
  
      // AJAX call to send form data to signup.php
      $.ajax({
        url: 'signup.php', // PHP file handling signup process
        type: 'POST',
        data: formData,
        success: function(response) {
          // Handle the response if needed
          console.log(response);
          // Redirect to login.html upon successful registration
          window.location.href = 'login.html';
        },
        error: function(xhr, status, error) {
          // Handle errors if necessary
          console.error(error);
        }
      });
    });
  });
  