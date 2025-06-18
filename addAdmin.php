<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="admin/login/styles.css">
</head>
<body>
    <div class="container">

        <!-- Register Form -->
        <div class="form-container" id="register-form">
            <h2>Register</h2>
            <form id="registerForm">
                <input type="text" id="registerUsername" placeholder="Username" required>
                <input type="password" id="registerPassword" placeholder="Password" required>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>

    <script>
        // Handle Register Form Submission
        document.getElementById('registerForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const username = document.getElementById('registerUsername').value;
        const password = document.getElementById('registerPassword').value;

            const response = await fetch('../../admin/login/register.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json',},
                body: JSON.stringify({ username, password }),
            });

            const result = await response.json();
            alert(result.message);
            if (result.status ==="success") {
                window.location.href = '../../admin/index.php'; // Redirect to admin page on successful login
            }


        });
    </script>
</body>
</html>