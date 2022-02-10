<?php require '../lib/db.php';

if (isset($_POST['add_event'])) {
	$event_name = mysqli_escape_string($connection, $_POST['event_name']);
	$event_description = mysqli_escape_string($connection, $_POST['event_description']);
	$event_date = mysqli_escape_string($connection, $_POST['event_date']);

	$query = mysqli_query($connection, "INSERT INTO events(event_name,event_description,event_date)
						VALUES ('$event_name','$event_description','$event_date')");

	if ($query) {
		$notif = '<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Congratulation!</strong> Data has been added ✔.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>';
	} else {
		$notif = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Filed!</strong> Data has been failed ❌.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>';
	}
}

if (isset($_GET['delete'])) {
	$id = $_GET['delete'];

	$query = mysqli_query($connection, "DELETE FROM events WHERE id_events='$id'");
	if ($query) {
		$notifDelete = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Congratulation!</strong> Data has been deleted ✔.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
	} else {
		$notifDelete = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Filed!</strong> Data has been failed ❌.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
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
            <div class="col-md-7">
                <div class="card shadow-lg border-0">
                    <?php
					if (isset($notif)) {
						echo $notif;
					} elseif (isset($notifDelete)) {
						echo $notifDelete;
					}
					?>
                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-outline-primary mb-1 " data-toggle="modal"
                            data-target="#buttonEvent">Add New Event</button>
                        <a href="../index.php"
                            class="btn btn-sm btn-outline-secondary badge-pill shadow-sm mb-1 float-right px-4">
                            <i class="bi bi-caret-left"></i> Back
                        </a>
                        <table class="table table-hover table-boredered">
                            <thead>
                                <tr>
                                    <th>Nama event</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								$query = mysqli_query($connection, "SELECT * FROM  events");
								while ($row = mysqli_fetch_array($query)) {
									$id = $row['id_events'];
									$event_name = $row['event_name'];
									$event_description = $row['event_description'];
									$event_date = $row['event_date'];
								?>
                                <tr>
                                    <td><?php echo $event_name; ?></td>
                                    <td><?php echo $event_description; ?></td>
                                    <td><?php echo $event_date; ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button id="btnAction" type="button"
                                                class="btn btn-outline-danger btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Button Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnAction">
                                                <a class="dropdown-item" href="edit.php?edit=<?= $id; ?>">Edit</a>
                                                <a class="dropdown-item"
                                                    href="dashboard.php?delete=<?php echo $id ?>">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <div class="card-title">
                            <h3>List User Event</h3>
                            <ul class="list-group unlist">
                                <?php
								$query = mysqli_query($connection, "SELECT * FROM user_event INNER JOIN events ON events.id_events=user_event.id_event");
								while ($data = mysqli_fetch_array($query)) {
								?>
                                <li class="list-group-item list-unstyled pull-right"><span
                                        class="badge badge-danger badge-sm"><?= $data['event_name']; ?></span> /
                                    <?= $data['fullname']; ?> / <?= $data['email']; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="buttonEvent" tabindex="-1" aria-labelledby="buttonEventLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buttonEventLabel">Form Add Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="event_name">Event Name</label>
                            <input type="text" class="form-control" name="event_name" id="event_name"
                                placeholder="Event Name..." required>
                        </div>
                        <div class="form-group">
                            <label for="event_description">Description</label>
                            <textarea name="event_description" id="event_description" class="form-control" rows="1"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="event_date">Event Date</label>
                            <input type="date" name="event_date" id="event_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="cancel" class="btn btn-secondary btn-sm btn-block"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm btn-block" name="add_event"
                            id="add_event">Save</button>
                    </div>
                </form>
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