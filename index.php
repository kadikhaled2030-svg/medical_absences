<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medical Excuse Management System</title>
    <link rel="stylesheet" href="maxcdn.bootstrapcdn.com">

    <style>
        body {
            background-color: #f5f5f5;
            text-align: center;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Header Image */
        .header-image {
            width: 100%;
            height: 260px;
            background-image: url('images/picc.jpg');
            background-size: cover;
            background-position: center;
        }

        /* Container for Login Buttons */
        .login-container {
            margin-top: 50px;
        }

        .login-btn {
            width: 200px; /* Made buttons slightly wider */
            padding: 15px;
            font-size: 18px;
            margin: 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease; /* Added smooth transition and hover effect */
            text-decoration: none;
        }

        .login-btn:hover {
            transform: translateY(-3px); /* Lifts the button slightly on hover */
        }

        .student {
            background-color: darkblue;
            color: white;
        }

        

        .admin {
            background-color: red;
            color: white;
        }

        

        .project-title {
            font-size: 35px;
            font-weight: bold;
            margin-top: 30px;
            color: #0c3b59;
        }

        /* New styles for the welcome section */
        .welcome-section {
            margin-top: 40px;
            padding: 0 20px;
            color: #333;
        }

        .welcome-section h3 {
            font-size: 24px;
            color: #0c3b59;
            margin-bottom: 15px;
        }

        .welcome-section p {
            font-size: 18px;
            line-height: 1.6;
            color: #555;
            max-width: 700px;
            margin: 0 auto 30px auto;
        }

        .call-to-action {
            font-size: 20px;
            font-weight: bold;
            color: #0c3b59;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <!-- Header Image -->
    <div class="header-image"></div>

    <!-- Title -->
    <div class="project-title">Medical Excuse Management System</div>

    <!-- Welcome & Instructions Section -->
    <div class="welcome-section">
        <h3>Unified Login Portal</h3>
        <p>
            Welcome to the Electronic Medical Excuse System. This platform is designed to streamline the process of submitting and tracking medical requests .
        <div class="call-to-action">
            Please select your role to proceed:
        </div>
    </div>

    <!-- Login Buttons -->
    <div class="login-container">
        <a  href="student/login.php" class="btn login-btn student">Student Login</a>
        <a  style="background-color: darkred; border-color: darkred;" href="admin/login.php" class="btn login-btn admin">Admin Login</a>
    </div>

</body>
</html>