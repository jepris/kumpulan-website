<?php
include '../lib/db.php';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $query = mysqli_query($connection, "SELECT * FROM events WHERE id_event = '$id'");
    $data = mysqli_fetch_array($query);

    if (isset($_POST['update_event'])){
        $eventName = mysqli_real_escape_string($connection, $_POST['event_name']);
        $eventDescription = mysqli_real_escape_string($connection, $_POST['event_description']);
        $eventDate = mysqli_real_escape_string($connection, $_POST['event_date']);
    
        $query = mysqli_query($connection, "UPDATE events SET event_name='$eventName', event_description='$eventDescription', event_date='$eventDate' WHERE id_event='$id'");
        header('location: dashboard.php');    
    //     if ($query) {
    //     }
    // }
}
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <!-- content here -->

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <h1 class="text-center">Dashboard Event</h1>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <a class="btn btn-primary" href="dashboard.php">Kembali ke dashboard Event
                        </a>
                        <a href="../index.php" class="btn btn-dark">Lihat Website</a>
                        <h1 class="text-center">Form Edit Event</h1>
                        <form method="post">
                            <div class="form-group">
                                <label>Nama Event</label>
                                <input type="text" class="form-control" name="event_name" value="<?php echo $data['event_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Event</label>
                                <textarea name="event_description" class="form-control" id="" cols="30" rows="10"><?php echo $data['event_description'] ?>"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Event</label>
                                <input type="date" class="form-control" name="event_date" value="<?php echo $data['event_date'] ?>">
                            </div>

                            <button type="submit" class="btn btn-warning" name="update_event">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>