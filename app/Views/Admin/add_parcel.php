<h2>Add New Parcel</h2>

<?php if (isset($validation)) : ?>
    <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
<?php endif; ?>

<form method="post" action="<?= base_url('admin/parcels/create') ?>">
    <label>Lot Number</label>
    <input type="text" name="lot_number" required><br>

    <label>Owner Name</label>
    <input type="text" name="owner_name" required><br>

    <label>Barangay</label>
    <input type="text" name="barangay"><br>

    <label>Classification</label>
    <input type="text" name="classification"><br>

    <label>Area (sqm)</label>
    <input type="number" step="0.01" name="area"><br>

    <label>Latitude</label>
    <input type="text" name="latitude"><br>

    <label>Longitude</label>
    <input type="text" name="longitude"><br><br>

    <button type="submit">Add Parcel</button>
</form>
