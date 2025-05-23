<h2>Track Appointment Status</h2>

<form method="post" action="/track">
    <label>Enter your Reference Number:</label><br>
    <input type="text" name="reference_number" required><br>
    <button type="submit">Track</button>
    <button type="button" onclick="window.location.href='public/index'">Return to Home</button>
</form>

<?php if (isset($searched)): ?>
    <?php if ($result): ?>
        <h4>Status Found:</h4>
        <p><strong>Name:</strong> <?= esc($result['fullname']) ?></p>
        <p><strong>Purpose:</strong> <?= esc($result['purpose']) ?></p>
        <p><strong>Scheduled:</strong> <?= esc($result['preferred_date']) ?> @ <?= esc($result['preferred_time']) ?></p>
        <p><strong>Status:</strong> <?= ucfirst($result['status']) ?></p>
    <?php else: ?>
        <p style="color:red;">No matching record found.</p>
    <?php endif; ?>
<?php endif; ?>
