<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Register as Doctor</h1>
        <button id="registerButton">Register as Doctor</button>
<div id="formContainer" class="hidden">
   <form action="register.php" method="POST" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="degree">Degree:</label>
    <input type="text" id="degree" name="degree" required>

    <label for="medical">Medical Where Seated:</label>
    <input type="text" id="medical" name="medical" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="category">Category:</label>
    <select id="category" name="category" required>
        <option value="Gastro liver">Gastro liver</option>
                    <option value="Child specialist">Child specialist</option>
                    <option value="Cardiac Surgery">Cardiac Surgery</option>
                    <option value="Thoracic Surgery">Thoracic Surgery</option>
                    <option value="Chest & Esophageal Surgeon">Chest & Esophageal Surgeon</option>
                    <option value="Rheumatism specialist">Rheumatism specialist</option>
                    <option value="Chest (Lung) & Esophageal Specialist">Chest (Lung) & Esophageal Specialist</option>
                    <option value="Mother & Child Disease">Mother & Child Disease</option>
                    <option value="Pedodontics">Pedodontics</option>
                    <option value="Prosthodontics">Prosthodontics</option>
                    <option value="Orthodontics">Orthodontics</option>
                    <option value="Oral & Maxilofacial Surgery">Oral & Maxilofacial Surgery</option>
                    <option value="Conservative Dentistry">Conservative Dentistry</option>
                    <option value="Hepatology">Hepatology</option>
                    <option value="Family medicine">Family medicine</option>
                    <option value="Drug addiction">Drug addiction</option>
                    <option value="Psychiatrist">Psychiatrist</option>
                    <option value="Physical Medicine and Rehabilitation">Physical Medicine and Rehabilitation</option>
                    <option value="Specialist/Physiatrist">Specialist/Physiatrist</option>
                    <option value="Skin Specialist">Skin Specialist</option>
                    <option value="Paralysis">Paralysis</option>
                    <option value="Arthritis Pain">Arthritis Pain</option>
                    <option value="Venereology">Venereology</option>
                    <option value="Diabetes">Diabetes</option>
                    <option value="Sonologist">Sonologist</option>
                    <option value="Radiotherapist">Radiotherapist</option>
                    <option value="Oral & Dental Surgery">Oral & Dental Surgery</option>
                    <option value="Endoscopist">Endoscopist</option>
                    <option value="Orthopedic Surgery">Orthopedic Surgery</option>
                    <option value="Laparoscopic Surgery">Laparoscopic Surgery</option>
                    <option value="Nutritionist">Nutritionist</option>
                    <option value="Pediatrics">Pediatrics</option>
                    <option value="Rehabilitation Medicine">Rehabilitation Medicine</option>
                    <option value="Orthopedician">Orthopedician</option>
                    <option value="Nephrology">Nephrology</option>
                    <option value="Oncology">Oncology</option>
                    <option value="Pediatric Endocrinology">Pediatric Endocrinology</option>
                    <option value="Cytopathology">Cytopathology</option>
                    <option value="Hepatopancreatobiliary Surgery">Hepatopancreatobiliary Surgery</option>
                    <option value="Neuro Medicine">Neuro Medicine</option>
                    <option value="Neuro Surgeon">Neuro Surgeon</option>
    </select>

    <label for="image">Profile Picture:</label>
    <input type="file" id="image" name="image" accept="image/*" required>

    <label for="daySelector">Day Selector:</label>
    <select id="daySelector">
        <option value="Saturday">Saturday</option>
        <option value="Sunday">Sunday</option>
        <option value="Monday">Monday</option>
        <option value="Tueday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
    </select>
    <button type="button" id="addDayButton">Add Day</button>

    <div id="selectedDaysDisplay"></div>
    <input type="hidden" id="visiting_days" name="visiting_days">

    <label for="visiting_time">Visiting Time:</label>
    <input type="text" id="visiting_time" name="visiting_time" placeholder="e.g., 7:30 PM - 9:30 PM" required>

    <button type="submit">Submit</button>
</form>

</div>


    </div>

    <script>
    document.getElementById('registerButton').addEventListener('click', () => {
        document.getElementById('formContainer').classList.toggle('hidden');
    });
</script>
<script>
    const selectedDays = new Set(); // Use a Set to avoid duplicate days
    const daySelector = document.getElementById('daySelector');
    const addDayButton = document.getElementById('addDayButton');
    const selectedDaysDisplay = document.getElementById('selectedDaysDisplay');
    const visitingDaysInput = document.getElementById('visiting_days');

    addDayButton.addEventListener('click', () => {
        const selectedDay = daySelector.value;
        if (!selectedDays.has(selectedDay)) {
            selectedDays.add(selectedDay);

            // Update the display
            selectedDaysDisplay.innerHTML = Array.from(selectedDays)
                .map(day => `<span>${day}</span>`)
                .join(', ');

            // Update the hidden input
            visitingDaysInput.value = Array.from(selectedDays).join(',');
        }
    });
</script>


    </script>
</body>
</html>