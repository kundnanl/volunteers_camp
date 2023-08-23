<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'organization') {
    header('Location: ../public/signin.php');
    exit();
}

$host = "localhost";
$username = "root";
$password = "mysql";
$database = "php";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'];

// Fetch hosted events
$hostedEventsQuery = "SELECT * FROM events WHERE organization_id = $user_id";
$hostedEventsResult = mysqli_query($conn, $hostedEventsQuery);

// Handle event creation form submission
$eventCreationMessage = "";
if (isset($_POST['create_event'])) {
    $event_name = mysqli_real_escape_string($conn, $_POST['event_name']);
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $event_location = mysqli_real_escape_string($conn, $_POST['event_location']);
    $volunteers_needed = mysqli_real_escape_string($conn, $_POST['volunteers_needed']);

    $insert_query = "INSERT INTO events (organization_id, event_name, event_date, event_location, volunteers_needed)
                     VALUES ($user_id, '$event_name', '$event_date', '$event_location', $volunteers_needed)";

    if (mysqli_query($conn, $insert_query)) {
        $eventCreationMessage = "Event successfully created.";
    } else {
        $eventCreationMessage = "Event creation failed.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Organization Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <h1>Welcome, Organization!</h1>
        
        <h2>Create Event</h2>
        <form method="post" action="organization_dashboard.php">
            <label>Event Name: <input type="text" name="event_name" required></label><br>
            <label>Event Date: <input type="date" name="event_date" required></label><br>
            <label>Event Location: <input type="text" name="event_location" required></label><br>
            <label>Volunteers Needed: <input type="number" name="volunteers_needed" required></label><br>
            <input type="submit" name="create_event" value="Create Event">
        </form>
        
        <p><?php echo $eventCreationMessage; ?></p>

        <h2>Hosted Events</h2>
        <?php if (mysqli_num_rows($hostedEventsResult) === 0) : ?>
            <p>No hosted events found.</p>
        <?php else : ?>
            <ul>
                <?php while ($event = mysqli_fetch_assoc($hostedEventsResult)) : ?>
                    <li>
                        <strong><?php echo $event['event_name']; ?></strong>
                        <br>Date: <?php echo $event['event_date']; ?>
                        <br>Location: <?php echo $event['event_location']; ?>
                        <br>Volunteers Needed: <?php echo $event['volunteers_needed']; ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
