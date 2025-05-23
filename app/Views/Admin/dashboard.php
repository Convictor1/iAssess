<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>iAssess Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: 700;
        }

        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, .15);
        }

        .chart-container {
            max-width: 300px;
            /* narrower width */
            margin: 0 auto 30px auto;
            /* center horizontally & add spacing below */
            background: #fff;
            border-radius: 0.25rem;
            box-shadow: 0 0.15rem 1.75rem rgba(58, 59, 69, .15);
            padding: 20px;
        }

        footer {
            padding: 15px 0;
            text-align: center;
            color: #6c757d;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">iAssess Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminNavbar"
            aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a class="nav-link" href="/admin"><i class="bi bi-speedometer2"></i>
                        Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/appointments"><i class="bi bi-calendar-check"></i>
                        Appointments</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/gis"><i class="bi bi-geo-alt"></i> GIS Viewer</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="/admin/documents"><i class="bi bi-file-earmark-text"></i>
                        Documents</a></li>
                <li class="nav-item"><a class="nav-link" href="/logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container my-4">

        <h1 class="mb-4">Dashboard</h1>

        <div class="row text-center">

            <div class="col-md-3 mb-3">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="card-title text-success"><i class="fa fa-calendar-check-o"></i> Total Appointments
                        </h5>
                        <h3><?= $totalAppointments ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="card-title text-success"><i class="fa fa-check-circle"></i> Approved</h5>
                        <h3><?= $approvedAppointments ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="card-title text-danger"><i class="fa fa-times-circle"></i> Declined</h5>
                        <h3><?= $declinedAppointments ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="card-title text-warning"><i class="fa fa-clock-o"></i> Pending</h5>
                        <h3><?= $pendingAppointments ?></h3>
                    </div>
                </div>
            </div>

        </div>

        <div class="row text-center">

            <div class="col-md-4 mb-3">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="card-title text-primary"><i class="fa fa-file-text-o"></i> Total Documents</h5>
                        <h3><?= $totalDocuments ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="card-title text-info"><i class="fa fa-check"></i> Verified</h5>
                        <h3><?= $verifiedDocuments ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="card-title text-danger"><i class="fa fa-times"></i> Rejected</h5>
                        <h3><?= $rejectedDocuments ?></h3>
                    </div>
                </div>
            </div>
            <div class="chart-container">

                <canvas id="appointmentChart" width="400" height="200"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="documentChart" width="400" height="200"></canvas>

            </div>



        </div>
        <!-- 
        <div class="chart-container">
 
        </div> -->



    </div>

    <footer>
        <small>© <?= date('Y') ?> iAssess. All rights reserved.</small>
    </footer>

    <!-- Bootstrap & dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Appointment Status Chart
        const appointmentChart = document.getElementById('appointmentChart').getContext('2d');
        new Chart(appointmentChart, {
            type: 'pie',
            data: {
                labels: ['Approved', 'Declined', 'Pending'],
                datasets: [{
                    label: 'Appointments',
                    data: [<?= $approvedAppointments ?>, <?= $declinedAppointments ?>, <?= $pendingAppointments ?>],
                    backgroundColor: ['#28a745', '#dc3545', '#ffc107'],
                    borderWidth: 1
                }]
            }
        });

        // Document Status Chart
        const documentChart = document.getElementById('documentChart').getContext('2d');
        new Chart(documentChart, {
            type: 'bar',
            data: {
                labels: ['Verified', 'Rejected'],
                datasets: [{
                    label: 'Documents',
                    data: [<?= $verifiedDocuments ?>, <?= $rejectedDocuments ?>],
                    backgroundColor: ['#007bff', '#dc3545'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: { beginAtZero: true }
                    }]
                }
            }
        });
    </script>

</body>

</html>