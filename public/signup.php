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

if (isset($_POST['usignup'])) {
    $uname = trim($_POST['uname']);
    $upassword = $_POST['upassword'];
    $role = $_POST['role']; 

    $hashed_password = password_hash($upassword, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password, role) VALUES ('$uname', '$hashed_password', '$role')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['user_id'] = mysqli_insert_id($conn);
        $_SESSION['user_role'] = $role;
        header('Location: volunteer_dashboard.php');
        exit();
    } else {
        $umsg = "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<?php include('header.php'); ?>
<main>
    <h1>Sign Up</h1>
    <?php echo $umsg; ?>
    <form method="post" action="signup.php">
        User Name:
        <input type="text" name="uname" required><br>
        Password:
        <input type="password" name="upassword" required><br>
        Role:
        <label><input type="radio" name="role" value="volunteer" checked> Volunteer</label>
        <label><input type="radio" name="role" value="organization"> Organization</label><br>
        <input type="submit" value="Sign Up" name="usignup">
    </form>
</main>
<?php include('footer.php'); ?>