<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'organization') {
    header('Location: ../public/signin.php');
    exit();
}

// Replace the example arrays with actual data fetched from the database
$hostedEvents = array(
    array('name' => 'Charity Fundraiser', 'date' => '2023-08-15', 'location' => 'Community Hall'),
    array('name' => 'Blood Donation Camp', 'date' => '2023-08-25', 'location' => 'Hospital')
);

$volunteerRegistrations = array(
    array('volunteer' => 'John Doe', 'event' => 'Charity Fundraiser'),
    array('volunteer' => 'Jane Smith', 'event' => 'Blood Donation Camp')
);

?>

<?php include('header.php'); ?>
<main>
    <h1>Welcome, Organization!</h1>
    <h2>Hosted Events</h2>
    <?php if (empty($hostedEvents)) : ?>
        <p>No hosted events found.</p>
    <?php else : ?>
        <ul>
            <?php foreach ($hostedEvents as $event) : ?>
                <li>
                    <strong><?php echo $event['name']; ?></strong>
                    <br>Date: <?php echo $event['date']; ?>
                    <br>Location: <?php echo $event['location']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <h2>Volunteer Registrations</h2>
    <?php if (empty($volunteerRegistrations)) : ?>
        <p>No volunteer registrations found.</p>
    <?php else : ?>
        <ul>
            <?php foreach ($volunteerRegistrations as $registration) : ?>
                <li>
                    <strong><?php echo $registration['volunteer']; ?></strong> - <?php echo $registration['event']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</main>
<?php include('footer.php'); ?>
