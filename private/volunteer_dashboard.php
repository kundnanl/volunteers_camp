<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'volunteer') {
    header('Location: ../public/signin.php');
    exit();
}

$upcomingEvents = array(
    array('name' => 'Volunteer Event 1', 'date' => '2023-08-10', 'location' => 'Community Center'),
    array('name' => 'Volunteer Event 2', 'date' => '2023-08-20', 'location' => 'Park')
);

$volunteerOpportunities = array(
    array('name' => 'Teaching Assistant', 'location' => 'Local School'),
    array('name' => 'Food Drive Volunteer', 'location' => 'Food Bank')
);

?>

<?php include('header.php'); ?>
<main>
    <h1>Welcome, Volunteer!</h1>
    <h2>Upcoming Events</h2>
    <?php if (empty($upcomingEvents)) : ?>
        <p>No upcoming events found.</p>
    <?php else : ?>
        <ul>
            <?php foreach ($upcomingEvents as $event) : ?>
                <li>
                    <strong><?php echo $event['name']; ?></strong>
                    <br>Date: <?php echo $event['date']; ?>
                    <br>Location: <?php echo $event['location']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <h2>Volunteer Opportunities</h2>
    <?php if (empty($volunteerOpportunities)) : ?>
        <p>No volunteer opportunities found.</p>
    <?php else : ?>
        <ul>
            <?php foreach ($volunteerOpportunities as $opportunity) : ?>
                <li>
                    <strong><?php echo $opportunity['name']; ?></strong>
                    <br>Location: <?php echo $opportunity['location']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</main>
<?php include('footer.php'); ?>
