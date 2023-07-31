document.getElementById('a-r-form').addEventListener('submit', function(event) {
    event.preventDefault();
    var result = confirm("Do you want to perform the action?");
    if (result) {
        // If the user clicks "Yes," call the Laravel route
        this.submit();
    } else {
        // If the user clicks "No," you can handle the cancel event here
        // For example, do nothing or show a different message
        console.log("Accept canceled.");
    }
});

document.getElementById('remove').addEventListener('click', function() {
    var result = confirm("Do you want to perform the action?");
    if (result) {
        // If the user clicks "Yes," call the Laravel route
        window.location.href = "{{ route('/accept') }}";
    } else {
        // If the user clicks "No," you can handle the cancel event here
        // For example, do nothing or show a different message
        console.log("Action canceled.");
    }
});
