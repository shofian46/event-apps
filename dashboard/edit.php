<?php require '../lib/db.php';
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];

  $query = mysqli_query($connection, "SELECT * FROM events WHERE id_events='$id'");
  $data = mysqli_fetch_array($query);

  if (isset($_POST['update_event'])) {
    $event_name = mysqli_escape_string($connection, $_POST['event_name']);
    $event_description = mysqli_escape_string($connection, $_POST['event_description']);
    $event_date = mysqli_escape_string($connection, $_POST['event_date']);

    $query = mysqli_query($connection, "UPDATE events SET event_name='$event_name',
                                                       event_description='$event_description',
                                                       event_date='$event_date'
                                                       WHERE id_events='$id'");
    if ($query) {
      header('Location: dashboard.php');
    }
  }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <title>Event Apps</title>
</head>

<body bg-light>
    <!-- Content -->
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <h1 class="text-center">Dashboard Event</h1>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <a href="../dashboard/dashboard.php"
                            class="btn btn-sm btn-outline-primary badge-pill shadow-sm mb-1 "><i
                                class="bi bi-caret-left"></i> Back to
                            Event</a>
                        <h1 class="text-center">Form Update Events</h1>

                        <form method="post">
                            <div class="form-group">
                                <label for="event_name">Event Name</label>
                                <input type="text" class="form-control" name="event_name" id="event_name"
                                    value="<?= $data['event_name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="event_description">Description</label>
                                <textarea name="event_description" id="event_description" class="form-control" rows="1"
                                    required><?= $data['event_description']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="event_date">Event Date</label>
                                <input type="date" name="event_date" id="event_date" class="form-control"
                                    value="<?= $data['event_date']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-warning badge-pill btn-sm btn-block"
                                name="update_event" id="update_event">Update</button>
                            <button type="cancel" class="btn btn-danger badge-pill btn-sm btn-block"
                                data-dismiss="modal">Cancell</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>