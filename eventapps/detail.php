<?php
include 'lib/db.php';

if (isset($_GET['detail'])) {
    $id = $_GET['detail'];

    $query = mysqli_query($connection, "SELECT * FROM events WHERE id_event='$id'");
    $data = mysqli_fetch_array($query);

    if (isset($_POST['daftar'])) {
        $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
        $phone = mysqli_real_escape_string($connection, $_POST['phone']);
        $email = mysqli_real_escape_string($connection, $_POST['email'],);

        $query = mysqli_query($connection, "INSERT INTO user_event(id_event,fullname,phone,email) VALUES ( '$id', '$fullname', '$phone', '$email')");

        if ($query) {
            header('Location: index.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventApps || Detail Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="index.php">Event Apps</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard/dashboard.php">Dashboard</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-dark" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- content here -->

    <div class="container">

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center"><?= $data['event_name'] ?></h3>
                        </div>
                        <p class="card-text">
                            <?= $data['event_description'] ?>
                        <h3 class="text-center">Form Pendaftaran</h3>
                        <form method="post" autocomplete="off">
                            <div class="form-gruo">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="fullname" required>
                            </div>
                            <div class="form-gruo">
                                <label>No. Telephone</label>
                                <input type="number" class="form-control" name="phone" required>
                            </div>
                            <div class="form-gruo">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-grup">
                                <button class="btn btn-primary btn-btn" type="submit" name="daftar">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>