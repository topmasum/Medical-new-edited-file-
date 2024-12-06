<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webprac";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $degree = $_POST['degree'];
    $medical = $_POST['medical'];
    $email = $_POST['email'];
    $category = $_POST['category'];
    $visiting_days = $_POST['visiting_days'];
    $visiting_time = $_POST['visiting_time'];

    // Handle image upload
    $image = $_FILES['image'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    $imageType = $image['type'];

    // Validate the image
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

    if (in_array($imageExt, $allowed)) {
        if ($imageError === 0) {
            if ($imageSize < 5000000) { // Limit: 5MB
                $newImageName = uniqid('', true) . '.' . $imageExt;
                $imageDestination = 'uploads/' . $newImageName;

                // Move the image to the uploads directory
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }
                move_uploaded_file($imageTmpName, $imageDestination);
            } else {
                echo "Image size is too large!";
                exit;
            }
        } else {
            echo "Error uploading the image!";
            exit;
        }
    } else {
        echo "Invalid file type!";
        exit;
    }

    // Insert into database
    $sql = "INSERT INTO doctors (name, degree, medical, email, category, visiting_days, visiting_time, image) 
            VALUES ('$name', '$degree', '$medical', '$email', '$category', '$visiting_days', '$visiting_time', '$newImageName')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the page where doctors are listed
         echo "Your submission is successful!";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>