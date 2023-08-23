<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'volunteer') {
    header('Location: ../public/signin.php');
    exit();
}

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    $host = "localhost";
    $username = "root";
    $password = "mysql";
    $database = "php";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $user_id = $_SESSION['user_id'];

    $check_query = "SELECT * FROM event_registrations WHERE volunteer_id = $user_id AND event_id = $event_id";
    $check_result = mysqli_query($conn, $check_query);

    if (!$check_result) {
        die("Check query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($check_result) === 0) {
        $insert_query = "INSERT INTO event_registrations (event_id, volunteer_id) VALUES ($event_id, $user_id)";
        $insert_result = mysqli_query($conn, $insert_query);

        if (!$insert_result) {
            $_SESSION['registration_message'] = "Failed to register for the event.";
        } else {
            $_SESSION['registration_message'] = "Successfully registered for the event.";  
        }
    } else {
        $_SESSION['registration_message'] = "You are already registered for this event.";
    }

    mysqli_close($conn);
}

header('Location: volunteer_dashboard.php');
exit();
?>
