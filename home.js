$(document).ready(function() {
    // Handle search button click
    $('#searchButton').click(function() {
        var casID = $('#casID').val();
        $.ajax({
            url: 'search_case.php',
            type: 'GET',
            data: { casID: casID },
            success: function(data) {
                $('#searchResults').html(data);
            },
            error: function() {
                alert('Error loading records.');
            }
        });
    });

    // Handle Contact Us Modal
    var modal = document.getElementById("contactUsModal");
    var btn = document.getElementById("contactUsButton");
    var span = document.getElementsByClassName("close-modal")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    $('#contactUsForm').submit(function(event) {
        event.preventDefault();
        alert('Message sent successfully!');
        modal.style.display = "none";
    });
});
