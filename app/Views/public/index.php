<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Dashboard</title>
    <!-- Bootstrap CSS CDN, or replace with your own CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h1 class="mb-4">Welcome to Your Dashboard</h1>

        <div class="list-group mb-4" style="max-width: 400px;">
            <a href="<?= base_url('schedule') ?>" class="list-group-item list-group-item-action">
                📅 Schedule an Appointment
            </a>
            <a href="<?= base_url('upload') ?>" class="list-group-item list-group-item-action">
                📤 Submit a Document
            </a>
            <a href="<?= base_url('track') ?>" class="list-group-item list-group-item-action">
                🔍 Track Your Request
            </a>
            <a href="<?= base_url('logout') ?>" class="list-group-item list-group-item-action text-danger">
                🚪 Logout
            </a>
        </div>

        <!-- Optional: Show flash messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success" style="max-width: 400px;">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger" style="max-width: 400px;">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS Bundle CDN (optional for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
