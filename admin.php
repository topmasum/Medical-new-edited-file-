<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webprac";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request for doctors
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete image file from server
    $sqlImage = "SELECT image FROM doctors WHERE id = $delete_id";
    $resultImage = $conn->query($sqlImage);
    if ($resultImage->num_rows > 0) {
        $imageRow = $resultImage->fetch_assoc();
        $imagePath = "uploads/" . $imageRow['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Delete doctor record
    $sqlDelete = "DELETE FROM doctors WHERE id = $delete_id";
    if ($conn->query($sqlDelete) === TRUE) {
        echo "<script>alert('Doctor deleted successfully!'); window.location.href='admin.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
if (isset($_GET['cancel_id'])) {
    $cancel_id = $_GET['cancel_id'];

    // Delete appointment record 
    $sqlCancel = "DELETE FROM appointments WHERE id = $cancel_id";
    if ($conn->query($sqlCancel) === TRUE) {
        echo "<script>alert('Appointment canceled successfully!'); window.location.href='admin.php';</script>";
    } else {
        echo "Error canceling appointment: " . $conn->error;
    }
}
// Handle confirm request for appointments
if (isset($_GET['confirm_id'])) {
    $confirm_id = $_GET['confirm_id'];

    // Update appointment status
    $sqlConfirm = "UPDATE appointments SET status='Approved' WHERE id=?";
    $stmt = $conn->prepare($sqlConfirm);
    if ($stmt) {
        $stmt->bind_param("i", $confirm_id);
        if ($stmt->execute()) {
            echo "<script>alert('Appointment confirmed successfully!'); window.location.href='admin.php';</script>";
        } else {
            echo "Error confirming appointment: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

// Fetch doctor data
$doctors = $conn->query("SELECT * FROM doctors");

// Fetch client data
$clients = $conn->query("SELECT * FROM appoint");

// Fetch appointment data
$appointments = $conn->query("SELECT * FROM appointments");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        // Function to toggle table views
        function toggleTable(tableId) {
            document.getElementById('doctorsTable').style.display = 'none';
            document.getElementById('clientsTable').style.display = 'none';
            document.getElementById('requestsTable').style.display = 'none';
            document.getElementById(tableId).style.display = 'block';
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>

        <!-- Buttons to toggle between Doctors, Clients, and Requests tables -->
        <button onclick="toggleTable('doctorsTable')">Doctors Info</button>
        <button onclick="toggleTable('clientsTable')">Clients Info</button>
        <button onclick="toggleTable('requestsTable')">Requests Info</button>

        <!-- Doctors Table -->
        <div id="doctorsTable" style="display: block;">
            <h2>Doctors Information</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Degree</th>
                        <th>Medical</th>
                        <th>Email</th>
                        <th>Category</th>
                        <th>Visiting Days</th>
                        <th>Visiting Time</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $doctors->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['degree']; ?></td>
                        <td><?php echo $row['medical']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['visiting_days']; ?></td>
                        <td><?php echo $row['visiting_time']; ?></td>
                        <td>
                            <?php if ($row['image']): ?>
                                <img src="uploads/<?php echo $row['image']; ?>" alt="Doctor Image">
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="admin.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this doctor?');">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Clients Table -->
        <div id="clientsTable" style="display: none;">
            <h2>Clients Information</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Address</th>
                        <th>About</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $clients->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['about']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Requests Table -->
        <div id="requestsTable" style="display: none;">
            <h2>Appointment Requests</h2>
            <table>
                <thead>
                    <tr>
                        <th>User_id</th>
                        <th>Doctor Type</th>
                        <th>Doctor Name</th>
                        <th>Visiting Day</th>
                        <th>Visiting Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $appointments->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['userid']; ?></td>
                        <td><?php echo $row['doctor_type']; ?></td> <!-- Doctor Type -->
                        <td><?php echo $row['doctor_name']; ?></td> <!-- Doctor Name -->
                        <td><?php echo $row['visiting_day']; ?></td> <!-- Visiting Day -->
                        <td><?php echo $row['visiting_time']; ?></td> <!-- Visiting Time -->
                        <td>
                            <a href="admin.php?confirm_id=<?php echo $row['id']; ?>" onclick="return confirm('Confirm this appointment?');">Confirm</a>
                            <a href="admin.php?cancel_id=<?php echo $row['id']; ?>" onclick="return confirm('Cancel this appointment?');">Cancel</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
