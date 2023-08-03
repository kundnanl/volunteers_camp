<?php
session_start();
$umsg = "";

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_role'] === 'volunteer') {
        header('Location: ../private/volunteer_dashboard.php');
    } elseif ($_SESSION['user_role'] === 'organization') {
        header('Location: ../private/organization_dashboard.php');
    }
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

if (isset($_POST['usignin'])) {
    $uname = trim($_POST['uname']);
    $upassword = $_POST['upassword'];

    $sql = "SELECT user_id, password, role FROM users WHERE username = '$uname'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        // Verify the provided password against the hashed password stored in the database
        if (password_verify($upassword, $row['password'])) {
            // If the password matches, set the user role and ID in the session
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_role'] = $row['role'];
            if ($row['role'] === 'volunteer') {
                header('Location: ../private/volunteer_dashboard.php');
            } elseif ($row['role'] === 'organization') {
                header('Location: ../private/organization_dashboard.php');
            }
            exit();
        } else {
            $umsg = "Invalid password. Please try again.";
        }
    } else {
        $umsg = "User not found. Please check the username or sign up.";
    }
}

mysqli_close($conn);
?>

<?php include('header.php'); ?>
<main>
    <h1>Sign In</h1>
    <?php echo $umsg; ?>
    <form method="post" action="signin.php">
        User Name:
        <input type="text" name="uname" required><br>
        Password:
        <input type="password" name="upassword" required><br>
        <input type="submit" value="Sign In" name="usignin">
    </form>
</main>
<?php include('footer.php'); ?>