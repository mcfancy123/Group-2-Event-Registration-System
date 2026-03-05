<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['is_logged_in'])) {
    header("Location: login.php");
    exit();
}

$name = $_SESSION['fullname'];
$gender = $_SESSION['gender'];
$event = $_SESSION['event'];
$profile_pic = $_SESSION['profile_pic'];

// if -else statement
if ($gender == "Male") {
    $greeting = "Welcome, Mr. " . $name;
} elseif ($gender == "Female") {
    $greeting = "Welcome, Ms. " . $name;
} else {
    $greeting = "Welcome, " . $name;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Campus Event</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header><h1>User Dashboard</h1></header>
    <nav>
        <a href="logout.php">Logout</a>
    </nav>

    <section class="dashboard-content">
        <h2><?php echo $greeting; ?></h2>
        

        <div class="user-info">
            <img src="<?php echo $profile_pic; ?>" alt="Profile" style="width:150px; border-radius:50%;">
            <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
            <p><strong>Selected Event:</strong> <?php echo $event; ?></p>
            <p><strong>Status:</strong> Registration Document Uploaded Successfully.</p>
        </div> 
        

        <?php 
        // Switch Statement
        switch($event) {
            case "Workshop":
                 echo "<p> <strong>Workshop Notice:</strong> Kindly ensure you arrive 15 minutes early for registration. 
                            Please bring your laptop, charger, and a valid student ID. 
                            The workshop will be held on <strong>20th November, 2026 at the SRC Hall</strong>.
                        </p>";
            break;

            case "Seminar":
                echo "<p><strong>Seminar Notice:</strong> The seminar is scheduled to commence at <strong>10:00 AM</strong> 
                        in the <strong>Main Auditorium</strong>. Attendance will be taken, and participants are advised 
                        to dress in smart casual attire.
                     </p>";
             break;

            case "Conference":
                echo "<p><strong>Conference Notice:</strong> The conference opens at <strong>9:00 AM</strong> at the 
                         <strong>University Convention Centre</strong>. All attendees are required to wear their 
                         ID badge throughout the event. A detailed programme has been sent to your registered email.
                        </p>"; 

            break;

            default:
                echo "<p><strong>Event Notice:</strong> Your registration has been received. Kindly check your 
                registered email for the full event schedule, venue details, and further instructions.</p>";
        }
        ?>
    </section>

    <footer><p>&copy; 2026 Campus Event System</p></footer>
</body>
</html>