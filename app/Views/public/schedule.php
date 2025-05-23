<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule Appointment | iAssess</title>
    
    <!-- Bootstrap 5 (linked but not used) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <h2>Schedule Your Appointment</h2>

    <!-- Flash messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?= isset($validation) ? '<div>' . $validation->listErrors() . '</div>' : '' ?>

    <form id="appointmentForm" method="post" action="/schedule">
        <div>
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname" id="fullname" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="contact_number">Contact Number</label>
            <input type="text" name="contact_number" id="contact_number" required>
        </div>

        <div>
            <label for="preferred_date">Preferred Date</label>
            <input type="date" name="preferred_date" id="preferred_date" required>
        </div>

        <div>
            <label for="preferred_time">Preferred Time</label>
            <input type="time" name="preferred_time" id="preferred_time" required>
        </div>

        <div>
            <label for="purpose">Purpose of Appointment</label>
            <textarea name="purpose" id="purpose" rows="3" required></textarea>
        </div>

        <button type="submit">Submit Appointment</button>
        <button type="button" onclick="window.location.href='public/index'">cancel</button>

    </form>

</body>
</html>
