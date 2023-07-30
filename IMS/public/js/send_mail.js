// Wait for the document to be ready
  $(document).ready(function() {
    // Handle click event on the link with class "accept-link"
    $(".accept-link").on("click", function(event) {
      event.preventDefault(); // Prevent the default action of the link

      var url = $(this).attr("href"); // Get the URL from the link's "href" attribute
      var rId = $(this).data("rid"); // Get the "r_id" data from the link's "data-rid" attribute
      var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token value

      // Perform AJAX POST request
      $.ajax({
        url: url,
        method: "POST",
        data: { r_id: rId }, // Data to send in the request body
        headers: {
            "X-CSRF-Token": csrfToken // Include the CSRF token in the headers
        },
        success: function(response) {
          // Handle the response
          console.log("Request successful:", response);
        },
        error: function(error) {
          // Handle errors
          console.error("Error:", error);
        }
      });
    });
  });
