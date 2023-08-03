<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Volunteer Management System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="images/volunteer.jpg" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php
                error_reporting(0);
                session_start();

                if (isset($_SESSION['user_id'])) {
                    if ($_SESSION['user_role'] === 'volunteer') {
                        echo '<li><a href="../private/volunteer_dashboard.php">Volunteer Dashboard</a></li>';
                    } elseif ($_SESSION['user_role'] === 'organization') {
                        echo '<li><a href="../private/organization_dashboard.php">Organization Dashboard</a></li>';
                    }
                } else {
                    echo '<li><a href="../public/signup.php">Sign Up</a></li>';
                    echo '<li><a href="../public/signin.php">Sign In</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
