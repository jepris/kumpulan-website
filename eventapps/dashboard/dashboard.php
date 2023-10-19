<?php
    include '../lib/db.php';

    if (isset($_POST['add_event'])) {
        $eventName = mysqli_real_escape_string($connection, $_POST['event_name']);
        $eventDescription = mysqli_real_escape_string($connection, $_POST['event_description']);
        $eventDate = mysqli_real_escape_string($connection, $_POST['event_date']);

        $query = mysqli_query($connection, "INSERT INTO events (event_name, event_description, event_date) 
        VALUES ('$eventName', '$eventDescription', '$eventDate')");

        if ($query) {
            $notif = '<div class="alert alert-success">Berhasil tambah data</div>';
        }else{
            $notif = '<div class="alert alert-danger">Gagal tambah data</div>';
        }
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $query = mysqli_query($connection, "DELETE FROM events WHERE id_event='$id'");
        if ($query) {
            $notifDelete = '<div class="alert alert-success">Berhasil hapus data</div>';
        }else {
            $notifDelete = '<div class="alert alert-danger">Gagal hapus data</div>';
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

    <style>
        span{
            font-weight: bold;
            color: blue;
        }
    </style>
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
            <div class="col-md-7">
                <div class="card border-0 shadow-lg">
                    <?php 
                    if (isset($notif)) {
                        echo $notif;
                    }else if(isset($notifDelete)) {
                        echo $notifDelete;
                    }
                    
                    ?>
                    <div class="card-body">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalevent">Tambah Event
                        </button>
                        <a href="../index.php" class="btn btn-dark">Lihat Website</a>
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Nama Event</th>
                                    <th>Deskripsi Event</th>
                                    <th>Tanggal Event</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $query = mysqli_query($connection, 'SELECT * FROM events');
                                while($data = mysqli_fetch_array($query)){
                                ?>
                                <tr>
                                    <td><?php echo $data['event_name'] ?></td>
                                    <td><?php echo $data['event_description'] ?></td>
                                    <td><?php echo $data['event_date'] ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="actionbtn" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action Button
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionbtn">
                                                <li><a class="dropdown-item" href="edit.php?edit=<?php echo $data['id_event'] ?>">Edit</a></li>
                                                <li><a class="dropdown-item" href="dashboard.php?delete=<?php echo $data['id_event'] ?>">Hapus</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <div class="card-title">
                            <h3>Lihat User Event</h3>
                        </div>
                        <ul class="list-group">
                            <?php
                                $query = mysqli_query($connection, "SELECT * FROM user_event INNER JOIN events on events.id_event = user_event.id_event");
                                while($data = mysqli_fetch_array($query)){
                            ?>
                            <li class="list-group-item"><span><?= $data['event_name']?></span>/ <?php echo $data['fullname'] ?> / <?php echo $data['email'] ?></li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalevent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Event</label>
                            <input type="text" class="form-control" name="event_name" required>
                        </div>
                        <div class="form-group">
                        <label>Deskripsi Event</label>
                        <textarea name="event_description" class="form-control" id="" cols="30" rows="10" required></textarea>
                    </div>
                        <div class="form-group">
                            <label>Tanggal Event</label>
                            <input type="date" class="form-control" name="event_date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="add_event">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end content here -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>