document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById('loginForm');
    const notification = document.getElementById('notification');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(loginForm);

        fetch('login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                notification.textContent = data.message;
                notification.style.color = 'green';
                setTimeout(() => {
                    window.location.href = 'home.html'; // Redirect to home page after 3 seconds
                }, 3000);
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
