$(document).ready(function() {
    $('#loginForm').submit(function(e) {
      e.preventDefault(); // Prevent default form submission
      var formData = $(this).serialize(); // Serialize form data
  
      // AJAX call to send form data to login.php
      $.ajax({
        url: 'login.php', // PHP file handling login process
        type: 'POST',
        data: formData,
        success: function(response) {
          // Handle the response
          console.log(response);
          var result = JSON.parse(response);
          if (result.success) {
            // Redirect to profile.html upon successful login
            window.location.href = 'profile.html';
          } else {
            // Handle invalid login credentials
            alert(result.message);
          }
        },
        error: function(xhr, status, error) {
          // Handle errors if necessary
          console.error(error);
        }
      });
    });
  });
  