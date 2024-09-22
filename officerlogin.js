document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById('loginForm');
    const notification = document.getElementById('notification');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(loginForm);

        fetch('officerlogin.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                notification.textContent = data.message;
                notification.style.color = 'green';
                setTimeout(() => {
                    window.location.href = 'officer_dashboard.html'; // Redirect to home page
                }, 1000); // Redirect after 1 second
            } else {
                notification.textContent = data.message;
                notification.style.color = 'red';
            }
        })
        .catch(error => {
            notification.textContent = 'An error occurred. Please try again.';
            notification.style.color = 'red';
            console.error('Error:', error);
        });
    });
});
