<!DOCTYPE html>
<html>
<head>
    <title>iAssess System Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { border: 1px solid #444; padding: 6px; text-align: left; }
    </style>
</head>
<body>

<h2>iAssess System Report</h2>

<h3>Appointment Summary</h3>
<table>
    <tr><th>Type</th><th>Count</th></tr>
    <tr><td>Total</td><td><?= $totalAppointments ?></td></tr>
    <tr><td>Approved</td><td><?= $approvedAppointments ?></td></tr>
    <tr><td>Declined</td><td><?= $declinedAppointments ?></td></tr>
    <tr><td>Pending</td><td><?= $pendingAppointments ?></td></tr>
</table>

<h3>Document Summary</h3>
<table>
    <tr><th>Type</th><th>Count</th></tr>
    <tr><td>Total</td><td><?= $totalDocuments ?></td></tr>
    <tr><td>Verified</td><td><?= $verifiedDocuments ?></td></tr>
    <tr><td>Rejected</td><td><?= $rejectedDocuments ?></td></tr>
</table>

</body>
</html>
