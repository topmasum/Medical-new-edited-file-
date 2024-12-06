<?php
include 'database.php';

if (isset($_GET['type'])) {
    // Case 1: Fetch doctors based on the category
    $type = trim(mysqli_real_escape_string($conn, $_GET['type'])); // Sanitize input

    // Fetch doctors from the database based on the selected category
    $query = "SELECT id, name FROM doctors WHERE category = '$type'";
    $result = mysqli_query($conn, $query);

    $doctors = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $doctors[] = [
                'id' => $row['id'],
                'name' => $row['name']
            ];
        }
    }

    // Return as JSON
    header('Content-Type: application/json');
    echo json_encode($doctors);

} elseif (isset($_GET['doctor_id'])) {
    // Case 2: Fetch visiting days and time for a specific doctor
    $doctor_id = intval($_GET['doctor_id']); // Sanitize input

    // Fetch visiting days and time for the specific doctor
    $query = "SELECT name,visiting_days, visiting_time FROM doctors WHERE id = $doctor_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $doctor = mysqli_fetch_assoc($result);
        header('Content-Type: application/json');
        echo json_encode([
                        'visiting_days' => $doctor['visiting_days'],
            'visiting_time' => $doctor['visiting_time']
        ]);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Doctor not found']);
    }

} else {
    // Invalid request
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}

mysqli_close($conn);
?>
