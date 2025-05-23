<h2>Appointment Requests</h2>

<?php if (session()->getFlashdata('success')): ?>
    <div><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Purpose</th>
        <th>Date</th>
        <th>Time</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($appointments as $app): ?>
        <tr>
            <td><?= $app['id'] ?></td>
            <td><?= esc($app['fullname']) ?></td>
            <td><?= esc($app['purpose']) ?></td>
            <td><?= esc($app['preferred_date']) ?></td>
            <td><?= esc($app['preferred_time']) ?></td>
            <td><?= ucfirst($app['status']) ?></td>
            <td>
                <?php if ($app['status'] == 'pending'): ?>
                    <a href="/admin/appointments/updateStatus/<?= $app['id'] ?>/approved">Approve</a> |
                    <a href="/admin/appointments/updateStatus/<?= $app['id'] ?>/declined">Decline</a>
                <?php else: ?>
                    <em>Finalized</em>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
