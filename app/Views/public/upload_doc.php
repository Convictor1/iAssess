<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Document | iAssess</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="container">
        <h2> Upload Your Document</h2>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/upload') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div>
                <label for="fullname">Full Name:</label>
                <input type="text" name="fullname" id="fullname" required>
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div>
                <label for="doc_type">Document Type:</label>
                <select name="doc_type" id="doc_type" required>
                    <option value="">-- Select Document Type --</option>
                    <option value="tax_declaration">Tax Declaration</option>
                    <option value="land_title">Land Title</option>
                    <option value="building_permit">Building Permit</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div>
                <label for="document">Upload File:</label>
                <input type="file" name="document" id="document" required>
            </div>

            <button type="submit"> Submit</button>
            <button type="button" onclick="window.location.href='public/index'">Return to Home</button>
        </form>
    </div>
</body>
</html>
