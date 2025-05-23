<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Uploaded Documents - Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
</head>
<body class="bg-light">

<div class="container my-5">
    <h2 class="mb-4">Uploaded Documents</h2>

    <div class="table-responsive shadow-sm bg-white rounded">
        <table class="table table-striped table-hover mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>File</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($documents)): ?>
                    <?php foreach ($documents as $doc): ?>
                    <tr>
                        <td><?= esc($doc['fullname']) ?></td>
                        <td><?= esc($doc['email']) ?></td>
                        <td><?= esc($doc['doc_type']) ?></td>
                        <td><a href="/uploads/<?= esc($doc['file_name']) ?>" target="_blank" class="btn btn-sm btn-primary">View</a></td>
                        <td>
                            <?php
                            $status = strtolower($doc['status']);
                            $badgeClass = 'secondary';
                            if ($status === 'verified') $badgeClass = 'success';
                            elseif ($status === 'rejected') $badgeClass = 'danger';
                            elseif ($status === 'pending') $badgeClass = 'warning';
                            ?>
                            <span class="badge badge-<?= $badgeClass ?> text-capitalize"><?= esc($doc['status']) ?></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No documents found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
