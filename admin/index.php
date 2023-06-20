<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAO Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="../assets/css/Dark-footer-with-social-media-icons.css">
    <link rel="stylesheet" href="../assets/css/Footer-with-social-media-icons.css">
    <link rel="stylesheet" href="../assets/css/Hero-Carousel-images.css">
    <link rel="stylesheet" href="../assets/css/Navbar-Right-Links-icons.css">
    <link rel="stylesheet" href="../assets/css/style1.css">
    </head>
    <body>
        <?php
            require_once("../connection.php");
            require_once("require.php");
        ?>
        <nav class="navbar navbar-light navbar-expand-md py-3" style="border-bottom-color: rgb(14,15,16);box-shadow: 0px 1px 20px rgb(183,183,183);">
        <div class="container"><a class="navbar-brand d-flex align-items-center" style="color: rgb(19,161,7);font-size: 36px;font-weight: bold;"><span style="color: rgb(19, 161, 7);">SAO Reservation System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="navbar-nav ms-auto nav-pills">
                <li class="nav-item"><a class="nav-link" href="dates.php">Dates</a></li>
                <li class="nav-item"><a class="nav-link" href="orgs.php">Organizations</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                </ul><a href="logout.php" style="color: rgb(19,161,7);border-width: 1px;border-style: solid;border-radius: 3px;padding: 13px;width: 105px;text-align: center;"><i class="fas fa-sign-in-alt" style="margin-right: 7px;"></i>Logout</a>
            </div>
        </div>
    </nav>
        <div class="container py-5">
            <table id="table" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Organization</th>
                        <th>Reserved</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Purpose</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql = "SELECT * FROM reservations";
                        $results = mysql_query($sql, $con);
                        while($row = mysql_fetch_array($results))
                        {
                            echo "<tr>";
                            echo "<td>" . $row['last_name'] . ", " . $row['first_name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['contact'] . "</td>";
                            echo "<td>" . $row['organization'] . "</td>";
                            echo "<td>" . $row['services'] . "</td>";
                            echo "<td>" . date('Y, F j', strtotime($row['date_reserved'])) . " " . date('h:i A', strtotime($row['start_time'])) . "</td>";
                            echo "<td>" . date('Y, F j', strtotime($row['date_reserved'])) . " " . date('h:i A', strtotime($row['end_time'])) . "</td>";
                            echo "<td>" . $row['purpose'] . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> 
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="../assets/js/script.js"></script>
    </body>
</html>