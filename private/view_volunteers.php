<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'organization') {
    header('Location: ../public/signin.php');
    exit();
}

if (!isset($_GET['event_id'])) {
    header('Location: organization_dashboard.php');
    exit();
}

$event_id = $_GET['event_id'];

$host = "localhost";
$username = "root";
$password = "mysql";
$database = "php";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$volunteersQuery = "SELECT users.username FROM users
                    INNER JOIN event_registrations ON users.user_id = event_registrations.volunteer_id
                    WHERE event_registrations.event_id = $event_id";
$volunteersResult = mysqli_query($conn, $volunteersQuery);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View Volunteers</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <h1>Volunteers Registered for the Event</h1>
        
        <?php if (mysqli_num_rows($volunteersResult) === 0) : ?>
            <p>No volunteers registered for this event.</p>
        <?php else : ?>
            <ul>
                <?php while ($volunteer = mysqli_fetch_assoc($volunteersResult)) : ?>
                    <li><?php echo $volunteer['username']; ?></li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
        
        <a href="organization_dashboard.php">Back to Dashboard</a>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
