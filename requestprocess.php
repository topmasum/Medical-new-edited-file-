<?php
// Start PHP session
session_start();

// Include the database connection file
include 'database.php';

// Check if the form was submitted
if (isset($_POST['doctorType'], $_POST['doctorName'], $_POST['visitingDay'], $_POST['visitingTime'])) {
    // Sanitize form data
    $doctorType = mysqli_real_escape_string($conn, $_POST['doctorType']);
    $doctorId = mysqli_real_escape_string($conn, $_POST['doctorName']); // Assuming doctorName contains the doctor ID
    $visitingDay = mysqli_real_escape_string($conn, $_POST['visitingDay']);
    $visitingTime = mysqli_real_escape_string($conn, $_POST['visitingTime']);

    // Check if the user is logged in
    if (isset($_SESSION['name'])) {
        $user_name = $_SESSION['name'];

        // Retrieve user ID based on the name
        $sql = "SELECT id FROM appoint WHERE name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt === false) {
            die('<div class="container"><p>Error preparing user query: ' . mysqli_error($conn) . '</p></div>');
        }

        mysqli_stmt_bind_param($stmt, "s", $user_name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $userid = $row['id'];
            mysqli_stmt_close($stmt);

            // Fetch the doctor's name based on the ID
            $sql_doctor = "SELECT name FROM doctors WHERE id = ?";
            $stmt_doctor = mysqli_prepare($conn, $sql_doctor);
            if ($stmt_doctor === false) {
                die('<div class="container"><p>Error preparing doctor query: ' . mysqli_error($conn) . '</p></div>');
            }

            mysqli_stmt_bind_param($stmt_doctor, "i", $doctorId);
            mysqli_stmt_execute($stmt_doctor);
            $result_doctor = mysqli_stmt_get_result($stmt_doctor);

            if ($doctor = mysqli_fetch_assoc($result_doctor)) {
                $doctor_name = $doctor['name'];
                mysqli_stmt_close($stmt_doctor);

                // Insert the appointment details into the 'appointments' table
                $sql_insert = "INSERT INTO appointments (userid, doctor_type, doctor_name, visiting_day, visiting_time) VALUES (?, ?, ?, ?, ?)";
                $stmt_insert = mysqli_prepare($conn, $sql_insert);
                if ($stmt_insert === false) {
                    die('<div class="container"><p>Error preparing insert query: ' . mysqli_error($conn) . '</p></div>');
                }

                mysqli_stmt_bind_param($stmt_insert, "issss", $userid, $doctorType, $doctor_name, $visitingDay, $visitingTime);

                // Execute SQL query
                if (mysqli_stmt_execute($stmt_insert)) {
                    // Redirect to the dashboard
                    header("Location: dashboard.php");
                    exit();
                } else {
                    echo '<div class="container"><p>Error inserting data: ' . mysqli_error($conn) . '</p></div>';
                }

                mysqli_stmt_close($stmt_insert);
            } else {
                echo '<div class="container"><p>Doctor not found.</p></div>';
                mysqli_stmt_close($stmt_doctor);
            }
        } else {
            echo '<div class="container"><p>User not found.</p></div>';
            mysqli_stmt_close($stmt);
        }
    } else {
        echo '<div class="container"><p>User not logged in.</p></div>';
    }
} else {
    // Form not submitted
    echo '<div class="container"><p>Form not submitted. Missing data.</p></div>';
}

// Close database connection
mysqli_close($conn);

?>
