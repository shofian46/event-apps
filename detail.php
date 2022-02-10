<?php
include 'lib/db.php';

if (isset($_GET['detail'])) {
	$id = $_GET['detail'];

	$query = mysqli_query($connection, "SELECT * FROM events WHERE id_events='$id'");
	$data = mysqli_fetch_array($query);

	if (isset($_POST['regis'])) {
		$fullname = mysqli_escape_string($connection, $_POST['fullname']);
		$phone = mysqli_escape_string($connection, $_POST['phone']);
		$email = mysqli_escape_string($connection, $_POST['email']);

		$query = mysqli_query($connection, "INSERT INTO user_event(id_event,fullname,phone,email)
										  VALUES ('$id','$fullname','$phone','$email')");

		if ($query) {
			header('Location: index.php');
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

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="index.php">Event Apps</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard/dashboard.php">Dashboard</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <!-- end navbar -->
    <!-- Content -->
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <a href="index.php"
                            class="btn btn-secondary btn-sm badge-pill float-right px-4 shadow-sm">Back</a>
                        <div class="card-title">
                            <h3 class="text-center"><?= $data['event_name']; ?></h3>
                            <p class="card-text">
                                <?= $data['event_description']; ?>
                            </p>
                            <span>Tanggal Event: <?= $data['event_date']; ?></span>
                            <h3 class="text-center mt-1">Form Registration</h3>
                            <form action="" method="post" autocomplete="off">
                                <div class="form-group">
                                    <label for="fullname">Fullname</label>
                                    <input type="text" class="form-control" name="fullname" id="fullname" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="telephone">No. Handphone</label>
                                    <input type="number" class="form-control" name="phone" id="phone" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-sm"
                                        name="regis">Send</button>
                                </div>
                            </form>
                        </div>
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