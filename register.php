<?php
session_start();

$message = "";

if (isset($_POST['register'])) {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'] ? $_POST['gender'] : "";
    $event = $_POST['event'];

    //  validation (if-elseif)
    if (empty($fullname) || empty($email) || empty($password) || empty($gender)) {
        $message = "All fields are required.";
    } 
    elseif (strlen($password) < 6 ) {
        $message = "Password should atleast be 8 characters";
    }
    else {

        
        // Check profile picture
        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {

            $picDir = "uploads/";
            $picName = time() . "_pic_" . basename($_FILES["profile_pic"]["name"]);
            $picPath = $picDir . $picName;
            $picType = strtolower(pathinfo($picPath, PATHINFO_EXTENSION));

            if ($picType == "jpg" || $picType == "jpeg" || $picType == "png") {

                if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $picPath)) {

                    // Now check registration document
                    if (isset($_FILES['registration_doc']) && $_FILES['registration_doc']['error'] == 0) {

                        $docDir = "uploads/";
                        $docName = time() . "_doc_" . basename($_FILES["registration_doc"]["name"]);
                        $docPath = $docDir . $docName;
                        $docType = strtolower(pathinfo($docPath, PATHINFO_EXTENSION));

                        if ($docType == "pdf") {

                            if (move_uploaded_file($_FILES["registration_doc"]["tmp_name"], $docPath)) {

                                // Store session data
                                $_SESSION['fullname'] = $fullname;
                                $_SESSION['email'] = $email;
                                $_SESSION['password'] = $password;
                                $_SESSION['gender'] = $gender;
                                $_SESSION['event'] = $event;
                                $_SESSION['profile_pic'] = $picPath;
                                $_SESSION['registration_doc'] = $docPath;

                                header("Location: login.php");
                                exit();

                            } else {
                                $message = "Registration document upload failed.";
                            }

                        } else {
                            $message = "Only PDF files are allowed for registration document.";
                        }

                    } else {
                        $message = "Please upload your registration document.";
                    }

                } else {
                    $message = "Profile picture upload failed.";
                }

            } else {
                $message = "Only JPG, JPEG, and PNG files are allowed for profile picture.";
            }

        } else {
            $message = "Please upload a profile picture.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Campus Event</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<header>
    <h1>Register for the Event</h1>
</header>

<nav>
    <a href="index.html">Home</a>
    <a href="login.php">Login</a>
</nav>

<section>

    <?php if (!empty($message)) { ?>
        <p style="color:red; text-align:center;"><?php echo $message; ?></p>
    <?php } ?>

    <form method="POST" enctype="multipart/form-data">

        <input type="text" name="fullname" placeholder="Full Name"><br><br>

        <input type="email" name="email" placeholder="Email"><br><br>

        <input type="password" name="password" placeholder="Password"><br><br>

        <label>Gender:</label><br>
        <input type="radio" name="gender" value="Male"> Male
        <input type="radio" name="gender" value="Female"> Female
        <br><br>

        <label>Select Event:</label><br>
        <select name="event">
            <option value="Workshop">Workshop</option>
            <option value="Seminar">Seminar</option>
            <option value="Conference">Conference</option>
        </select>
        <br><br>


        <label>Upload Profile Picture (JPG/JPEG/PNG only):</label><br>
        <input type="file" name="profile_pic"><br><br>

        <label>Upload Student Registration Document (PDF only):</label><br>
        <input type="file" name="registration_doc"><br><br>

        <button type="submit" name="register">Register</button>

    </form>

</section>

<footer>
    <p>&copy; 2026 Campus Event System</p>
</footer>

</body>
</html>