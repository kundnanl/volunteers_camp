<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'volunteer') {
    header('Location: ../public/signin.php');
    exit();
}

if (isset($_SESSION['registration_message'])) {
    echo '<div class="registration-message">' . $_SESSION['registration_message'] . '</div>';
    unset($_SESSION['registration_message']); // Clear the message
}


$host = "localhost";
$username = "root";
$password = "mysql";
$database = "php";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM events";
$result = mysqli_query($conn, $sql);

$upcomingEvents = array();

while ($row = mysqli_fetch_assoc($result)) {
    $upcomingEvents[] = $row;
}

mysqli_close($conn);

include('header.php');
?>
<main>
    <h1>Welcome, Volunteer!</h1>
    <h2>Upcoming Events</h2>
    <?php if (empty($upcomingEvents)): ?>
        <p>No upcoming events found.</p>
    <?php else: ?>
        <ul>
<?php foreach ($upcomingEvents as $event) : ?>
    <li>
        <strong><?php echo $event['event_name']; ?></strong><br>
        Date: <?php echo $event['event_date']; ?><br>
        Location: <?php echo $event['event_location']; ?><br>
        <a href="register_event.php?event_id=<?php echo $event['event_id']; ?>">Register</a>
    </li>
<?php endforeach; ?>
        </ul>
    <?php endif; ?>
</main>
<?php include('footer.php'); ?>