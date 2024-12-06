<?php
session_start();
include 'database.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all registered doctors based on selected category
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

$sql = "SELECT * FROM doctors";

// If a category is selected (and it's not the "All Categories" option), filter the results
if (!empty($categoryFilter) && $categoryFilter !== "All Categories") {
    $sql .= " WHERE category = '" . $conn->real_escape_string($categoryFilter) . "'";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Information - MEDI CARE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
       .search-bar {
        position: relative;
        width: 40%;
        background-color: var(--green);
        border-radius: 10px;
        padding: 5px;
        z-index: 1000;
        position: fixed;
        top: 25px; /* Adjust this value based on your header height */
        left: 50%;
        transform: translateX(-50%);
    }

    .search-input {
        width: 100%; /* Adjusted width for responsiveness */
        padding: 5px;
        border: none;
        border-radius: 5px;
        outline: none;
        font-size: 16px;
        color: black;
    }

    .search-input::placeholder {
        color: #ccc;
    }
    
    .header {
        position: relative;
    }
   #menu-btn{
            display:initial;
            position: absolute;
        top: 50%;
        right: 20px; /* Adjust this value according to your design */
        transform: translateY(-50%);
        }
        .header .navbar{
        position: absolute;
        top:115%; right: 2rem;
        border-radius: .5rem;
        box-shadow: var(--box-shadow);
        width: 20rem;
        border: var(--border);
        background: #fff;
        transform: scale(0);
        opacity: 0;
        transform-origin: top right;
        transition: none;
    }

    .header .navbar.active{
        transform: scale(1);
        opacity: 1;
        transition: .2s ease-out;
    }

    .header .navbar a{
        font-size: 2rem;
        display: block;
        margin:2rem;
    }
@media screen and (max-width: 600px) {
    .search-bar {
        top:8px;
        width: calc(70% - 20px); /* Adjusted width for smaller devices */
        max-width: 250px; /* Limiting maximum width for smaller devices */
        left: calc(5% - 10px); /* Slightly move to the right */
        transform: translateX(0%);
    }
    .header{
        padding: 3.5rem;
        position: fixed;
    }
    .header .logo {
        display: none; /* Hide the logo */
    }

    /* Adjusting position for the menu button */
    #menu-btn {
        position: absolute;
        top: 50%;
        right: 20px; /* Adjust this value according to your design */
        transform: translateY(-50%);
    }
   
    .heading {
    padding-top: 70px; /* Adjust this value based on your header height */
}
}
.btn1{
    display: inline-block;
    margin-top: 1rem;
    padding: .5rem;
    padding-left: 1rem;
    padding-right: 1rem;
    border:var(--border);
    border-radius: .5rem;
    box-shadow: var(--box-shadow);
    color:var(--black);
    cursor: pointer;
    font-size: 1.7rem;
    background: #fff;
}

/* Apply to span elements inside doctor details */
.detail {
    display: block; /* Forces each span to act like a block element */
    margin-bottom: 5px; /* Optional spacing between lines */
    font-size: 1rem; /* Maintain text size */
    color: #333; /* Optional: Adjust text color for readability */
}

/* Optional: Style for doctor name */
.box h3 {
    font-size: 1.5rem; /* Keep name larger than details */
    margin-bottom: 10px;
}

   
</style>

   
</head>
<body>
<header class="header">
    <a href="#" class="logo"> <i class="fas fa-heartbeat"></i>MEDI CARE</a> 
    <nav class="navbar">
       <a href="index.php#home">Home</a>
        <a href="#services">Services</a>
        <a href="medicine.php">Medicine</a>
        <a href="doctor.php">Doctors</a>
        <a href="location.php">Locations</a>
        <a href="#about">About</a>
        <a href="doctor_reg.php" class="btn1"> Login </a>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
  
        <div class="search-bar">
    <select id="categoryFilter" class="search-input">
        
        <option value="">All Categories</option>
        <option value="Gastro liver" <?php echo ($categoryFilter === 'Gastro liver') ? 'selected' : ''; ?>>Gastro liver</option>

        <option value="Child specialist" <?php echo ($categoryFilter === 'Child specialist') ? 'selected' : ''; ?>>Child specialist</option>
<option value="Cardiac Surgery" <?php echo ($categoryFilter === 'Cardiac Surgery') ? 'selected' : ''; ?>>Cardiac Surgery</option>
<option value="Thoracic Surgery" <?php echo ($categoryFilter === 'Thoracic Surgery') ? 'selected' : ''; ?>>Thoracic Surgery</option>
<option value="Chest & Esophageal Surgeon" <?php echo ($categoryFilter === 'Chest & Esophageal Surgeon') ? 'selected' : ''; ?>>Chest & Esophageal Surgeon</option>
<option value="Rheumatism specialist" <?php echo ($categoryFilter === 'Rheumatism specialist') ? 'selected' : ''; ?>>Rheumatism specialist</option>
<option value="Chest (Lung) & Esophageal Specialist" <?php echo ($categoryFilter === 'Chest (Lung) & Esophageal Specialist') ? 'selected' : ''; ?>>Chest (Lung) & Esophageal Specialist</option>
<option value="Mother & Child Disease" <?php echo ($categoryFilter === 'Mother & Child Disease') ? 'selected' : ''; ?>>Mother & Child Disease</option>
<option value="Pedodontics" <?php echo ($categoryFilter === 'Pedodontics') ? 'selected' : ''; ?>>Pedodontics</option>
<option value="Prosthodontics" <?php echo ($categoryFilter === 'Prosthodontics') ? 'selected' : ''; ?>>Prosthodontics</option>
<option value="Orthodontics" <?php echo ($categoryFilter === 'Orthodontics') ? 'selected' : ''; ?>>Orthodontics</option>
<option value="Oral & Maxilofacial Surgery" <?php echo ($categoryFilter === 'Oral & Maxilofacial Surgery') ? 'selected' : ''; ?>>Oral & Maxilofacial Surgery</option>
<option value="Conservative Dentistry" <?php echo ($categoryFilter === 'Conservative Dentistry') ? 'selected' : ''; ?>>Conservative Dentistry</option>
<option value="Hepatology" <?php echo ($categoryFilter === 'Hepatology') ? 'selected' : ''; ?>>Hepatology</option>
<option value="Family medicine" <?php echo ($categoryFilter === 'Family medicine') ? 'selected' : ''; ?>>Family medicine</option>
<option value="Drug addiction" <?php echo ($categoryFilter === 'Drug addiction') ? 'selected' : ''; ?>>Drug addiction</option>
<option value="Psychiatrist" <?php echo ($categoryFilter === 'Psychiatrist') ? 'selected' : ''; ?>>Psychiatrist</option>
<option value="Physical Medicine and Rehabilitation" <?php echo ($categoryFilter === 'Physical Medicine and Rehabilitation') ? 'selected' : ''; ?>>Physical Medicine and Rehabilitation</option>
<option value="Specialist/Physiatrist" <?php echo ($categoryFilter === 'Specialist/Physiatrist') ? 'selected' : ''; ?>>Specialist/Physiatrist</option>
<option value="Skin Specialist" <?php echo ($categoryFilter === 'Skin Specialist') ? 'selected' : ''; ?>>Skin Specialist</option>
<option value="Paralysis" <?php echo ($categoryFilter === 'Paralysis') ? 'selected' : ''; ?>>Paralysis</option>
<option value="Arthritis Pain" <?php echo ($categoryFilter === 'Arthritis Pain') ? 'selected' : ''; ?>>Arthritis Pain</option>
<option value="Venereology" <?php echo ($categoryFilter === 'Venereology') ? 'selected' : ''; ?>>Venereology</option>
<option value="Diabetes" <?php echo ($categoryFilter === 'Diabetes') ? 'selected' : ''; ?>>Diabetes</option>
<option value="Sonologist" <?php echo ($categoryFilter === 'Sonologist') ? 'selected' : ''; ?>>Sonologist</option>
<option value="Radiotherapist" <?php echo ($categoryFilter === 'Radiotherapist') ? 'selected' : ''; ?>>Radiotherapist</option>
<option value="Oral & Dental Surgery" <?php echo ($categoryFilter === 'Oral & Dental Surgery') ? 'selected' : ''; ?>>Oral & Dental Surgery</option>
<option value="Endoscopist" <?php echo ($categoryFilter === 'Endoscopist') ? 'selected' : ''; ?>>Endoscopist</option>
<option value="Orthopedic Surgery" <?php echo ($categoryFilter === 'Orthopedic Surgery') ? 'selected' : ''; ?>>Orthopedic Surgery</option>
<option value="Laparoscopic Surgery" <?php echo ($categoryFilter === 'Laparoscopic Surgery') ? 'selected' : ''; ?>>Laparoscopic Surgery</option>
<option value="Nutritionist" <?php echo ($categoryFilter === 'Nutritionist') ? 'selected' : ''; ?>>Nutritionist</option>
<option value="Pediatrics" <?php echo ($categoryFilter === 'Pediatrics') ? 'selected' : ''; ?>>Pediatrics</option>
<option value="Rehabilitation Medicine" <?php echo ($categoryFilter === 'Rehabilitation Medicine') ? 'selected' : ''; ?>>Rehabilitation Medicine</option>
<option value="Orthopedician" <?php echo ($categoryFilter === 'Orthopedician') ? 'selected' : ''; ?>>Orthopedician</option>
<option value="Nephrology" <?php echo ($categoryFilter === 'Nephrology') ? 'selected' : ''; ?>>Nephrology</option>
<option value="Oncology" <?php echo ($categoryFilter === 'Oncology') ? 'selected' : ''; ?>>Oncology</option>
<option value="Pediatric Endocrinology" <?php echo ($categoryFilter === 'Pediatric Endocrinology') ? 'selected' : ''; ?>>Pediatric Endocrinology</option>
<option value="Cytopathology" <?php echo ($categoryFilter === 'Cytopathology') ? 'selected' : ''; ?>>Cytopathology</option>
<option value="Hepatopancreatobiliary Surgery" <?php echo ($categoryFilter === 'Hepatopancreatobiliary Surgery') ? 'selected' : ''; ?>>Hepatopancreatobiliary Surgery</option>
<option value="Neuro Medicine" <?php echo ($categoryFilter === 'Neuro Medicine') ? 'selected' : ''; ?>>Neuro Medicine</option>
<option value="Neuro Surgeon" <?php echo ($categoryFilter === 'Neuro Surgeon') ? 'selected' : ''; ?>>Neuro Surgeon</option>

    </select>
</div>


    </div>

    </header>

   
<section class="doctors" id="doctors">
    <h1 class="heading"> our <span>doctors</span> </h1>
    <div class="box-container" id="box-container">
              <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="box">';
        echo '<img src="uploads/' . htmlspecialchars($row['image']) . '" alt="Doctor Image">';
        echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
        echo '<span class="detail"><strong>Degree:</strong> ' . htmlspecialchars($row['degree']) . '</span>';
        echo '<span class="detail"><strong>Category:</strong> ' . htmlspecialchars($row['category']) . '</span>';
        echo '<span class="detail"><strong>Medical:</strong> ' . htmlspecialchars($row['medical']) . '</span>';
        echo '<span class="detail"><strong>Email:</strong> ' . htmlspecialchars($row['email']) . '</span>';
        echo '<span class="detail"><strong>Visiting Days:</strong> ' . htmlspecialchars($row['visiting_days']) . '</span>';
        echo '<span class="detail"><strong>Visiting Time:</strong> ' . htmlspecialchars($row['visiting_time']) . '</span>';
        echo '</div>';
    }
} else {
    echo '<p>No doctors available at the moment.</p>';
}
?>

    </div>
</section>


<footer class="footer">
    <!-- Footer content if needed -->
</footer>
<script src="script.js"></script>
  <script>
        const categoryFilter = document.getElementById('categoryFilter');
        categoryFilter.addEventListener('change', () => {
            const selectedCategory = categoryFilter.value;
            const url = selectedCategory === "" 
                ? "doctor.php" 
                : `doctor.php?category=${encodeURIComponent(selectedCategory)}`;
            window.location.href = url;
        });
    </script>


</body>
</html>
