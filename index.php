<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="TE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hospital website</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="style.css">
<style>
    .home{
        background: white;
    }
      .dropdown-container {
        position: relative;
        display: inline-block;
        margin-top: 20px;

    }

  .dropbtn {
    background-color: var(--green); /* Change to your preferred color */
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}

.dropbtn:hover, .dropbtn:focus {
    background-color: #23b79a; /* Change to your preferred hover color */
}

.dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        border-radius: 5px;
        overflow: hidden;
    }

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown.active .dropdown-content {
    display: block;
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
    color:var(--green);
    cursor: pointer;
    font-size: 1.7rem;
    background: #fff;
}
/* Popup styles */
.popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

.popup-content {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 300px;
    text-align: center;
    position: relative;
}

.popup-content .close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
}

.popup-content input {
    width: 100%;
    margin: 10px 0;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.popup-content button {
    background: #007bff;
    color: #fff;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 4px;
}

.popup-content button:hover {
    background: #0056b3;
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
        <a href="#" class="btn1" id="admin-login-btn"> Login </a>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>

<!-- Admin Login Popup -->
<div id="admin-login-popup" class="popup">
    <div class="popup-content">
        <span class="close-btn">&times;</span>
        <h2>Admin Login</h2>
        <form id="admin-login-form" action="admin.php" method="POST">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</div>

<section class="home" id="home">
 
    <div class="image">
        <img src="image/about-img.svg" alt="">
    </div>

    <div class="content">
        <h3>we take care of your healthy life</h3>
        <p id="typing-animation">We are here 24/7 for your help...</p>
        <a href="contact.html" class="btn">Emergency Contact <span class="fas fa-chevron-right"></span></a>
    </div>

</section>
<section class="icons-container">

    <div class="icons">
        <i class="fas fa-user-md"></i>
        <h3>150+</h3>
        <p>doctors at work</p>
    </div>

    <div class="icons">
        <i class="fas fa-users"></i>
        <h3>1030+</h3>
        <p>satisfied patients</p>
    </div>

    <div class="icons">
        <i class="fas fa-pills"></i>
        <h3>490+</h3>
        <p>Medicine info</p>
    </div>

    <div class="icons">
        <i class="fas fa-hospital"></i>
        <h3>70+</h3>
        <p>available hospitals</p>
    </div>

</section>

<section class="services" id="services">

    <h1 class="heading"> our <span>services</span> </h1>

    <div class="box-container">

        <div class="box">
            <i class="fas fa-notes-medical"></i>
            <h3>free checkups</h3>
    <p>Receive complimentary health checkups to ensure your well-being and early detection of potential issues.</p>
            <a href="freecheckup.php" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
        </div>

        <div class="box">
            <i class="fas fa-ambulance"></i>
            <h3>24/7 ambulance</h3>
    <p>Our ambulance service is available, providing emergency medical assistance whenever you need it.</p>
            <a href="contact.php" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
        </div>

        <div class="box">
            <i class="fas fa-user-md"></i>
            <h3>expert doctors</h3>
    <p>Consult with our team of highly qualified and experienced doctors who are experts in their respective fields.</p>
            <a href="doctor.php" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
        </div>

        <div class="box">
            <i class="fas fa-pills"></i>
            <h3>medicines</h3>
    <p>We offer a wide range of medications, ensuring you have access to the treatments you need.</p>
            <a href="medicine.php" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
        </div>

        <div class="box">
            <i class="fas fa-phone"></i>
            <h3>Emergency contact</h3>
    <p>In case of an emergency, reach out to us immediately through our dedicated emergency contact lines.</p>
            <a href="contact.php" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
        </div>

        <div class="box">
            <i class="fas fa-droplet"></i>
            <h3>Blood Info</h3>
    <p>Access vital information about blood donations, types, and availability to support life-saving efforts.</p>
            <a href="blood2.php" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
        </div>

    </div>

</section>
<section class="about" id="about">

    <h1 class="heading"> <span>about</span> us </h1>

    <div class="row">

        <div class="image">
            <img src="image/home-img.svg" alt="">
        </div>

        <div class="content">
            <h3>take the world's best quality treatment</h3>
            <p>This website has been meticulously designed and developed by Masum Billah and Tasnim Fairoze Oishy, bringing together their expertise and passion for creating an exceptional online experience.</p>
    <p>We are dedicated to providing high-quality content and services, ensuring that every visitor receives the best possible experience. Thank you for visiting our site.</p>
        </div>

    </div>

</section>
<section class="appointment" id="appointment">

    <h1 class="heading"> <span>appoint</span> now </h1>    

    <div class="row">

        <div class="image">
            <img src="image/appointment-img.svg" alt="">
        </div>

        <form action="connection.php" method="post">

            <h3>make appointment</h3>
            <div class="dropdown">
                <button type="button" class="dropbtn">Appoint</button>
                <div class="dropdown-content">
                    <a href="signup.php">Sign Up</a>
                    <a href="login.php">Login</a>
                </div>
            </div>
        </form>

    </div>

</section>


<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>quick links</h3>
            <a href="#home"> <i class="fas fa-chevron-right"></i> home </a>
            <a href="#about"> <i class="fas fa-chevron-right"></i> about </a>
            <a href="#services"> <i class="fas fa-chevron-right"></i> services </a>
            <a href="#doctors"> <i class="fas fa-chevron-right"></i> doctors </a>
            <a href="#appointment"> <i class="fas fa-chevron-right"></i> appointment </a>
            <a href="medicine.html"> <i class="fas fa-chevron-right"></i> Medicine </a>
        </div>

        <div class="box">
            <h3>our services</h3>
            <a href="contact.html"> <i class="fas fa-chevron-right"></i> Ambulance </a>
            <a href="medicine.html"> <i class="fas fa-chevron-right"></i> Medicine Info </a>
            <a href="freecheckup.html"> <i class="fas fa-chevron-right"></i> Offer's in Diffenrent Hospital </a>
        </div>

        <div class="box">
            <h3>appointment info</h3>
            <a href="#"> <i class="fas fa-phone"></i> +8801688238801 </a>
            <a href="#"> <i class="fas fa-phone"></i> +8801782546978 </a>
            <a href="#"> <i class="fas fa-envelope"></i> Medicare@gmail.com</a>
            <a href="#"> <i class="fas fa-envelope"></i> Medicare2@gmail.com </a>
            <a href="#"> <i class="fas fa-map-marker-alt"></i> Dhaka, Bangladesh </a>
        </div>

        <div class="box">
            <h3>follow us</h3>
            <a href="#"> <i class="fab fa-faceappointment-f"></i> faceappointment </a>
            <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
            <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
            <a href="#"> <i class="fab fa-pinterest"></i> pinterest </a>
        </div>

    </div>

    <div class="credit"> created by <span>SpiderScript</span> | all rights reserved </div>

</section>


<script src="script.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropbtn = document.querySelector('.dropbtn');
    const dropdown = document.querySelector('.dropdown');

    dropbtn.addEventListener('click', function(event) {
        event.stopPropagation(); // Stop event from bubbling up
        dropdown.classList.toggle('active');
    });

    // Close the dropdown if the user clicks outside of it
    document.addEventListener('click', function(event) {
        if (!dropdown.contains(event.target)) {
            dropdown.classList.remove('active');
        }
    });
});
// JavaScript for popup functionality
document.getElementById('admin-login-btn').addEventListener('click', function(e) {
    e.preventDefault(); // Prevent default link behavior
    document.getElementById('admin-login-popup').style.display = 'flex';
});

document.querySelector('.close-btn').addEventListener('click', function() {
    document.getElementById('admin-login-popup').style.display = 'none';
});

// Close popup on outside click
window.addEventListener('click', function(event) {
    const popup = document.getElementById('admin-login-popup');
    if (event.target === popup) {
        popup.style.display = 'none';
    }
});

</script>
</body>
</html>