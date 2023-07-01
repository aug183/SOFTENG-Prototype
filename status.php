<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>sao reservation system</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Multi-Column-icons.css">
    <link rel="stylesheet" href="assets/css/Hero-Carousel-images.css">
</head>

<body>
    <?php 
    session_start();
    
    if (!isset($_SESSION['id'])) {
        header("location: reftrack.php");
        exit;
    }
    
    if (isset($_POST['back_button'])) {
        $_SESSION = array();
        session_destroy();
        header("location: reftrack.php");
        exit;
    }

    require_once('connection.php');
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `reservations` WHERE reservation_code = '$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if (isset($_POST['cancel_button'])) {
        $reservation_code = $row['reservation_code'];
        $password = $row['password'];
        $last_name = $row['last_name'];
        $first_name = $row['first_name'];
        $date_created = $row['date_created'];
        $email = $row['email'];
        $contact = $row['contact'];
        $organization = $row['organization'];
        $services = $row['services'];
        $date_reserved = $row['date_reserved'];
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];
        $purpose = $row['purpose'];
        $reason = clean($_POST['cancellation_reason']);
        $sql = "INSERT INTO `cancellations` (reservation_code, `password`, last_name, first_name, date_created, email, contact, organization, services, date_reserved, start_time, end_time, purpose, reason) 
        VALUES ('$reservation_code', '$password', '$last_name', '$first_name', '$date_created', '$email', '$contact', '$organization', '$services', '$date_reserved', '$start_time', '$end_time', '$purpose', '$reason')";
        if (!mysqli_query($con, $sql)) {
            die('Error: ' . $con -> error);
        } 
        $sql = "DELETE FROM `reservations` WHERE reservation_code = '$id'";
        if (!mysqli_query($con, $sql)) {
            die('Error: ' . $con -> error);
        }
        $_SESSION = array();
        session_destroy();
        header("location: reftrack.php");
        exit;
    }

    function clean($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data); 
        return $data;
    }
    ?>
    <nav class="navbar navbar-light navbar-expand-md fixed-top d-flex" style="box-shadow: 0px 0px 6px 0px rgb(187,187,187);background: #ffffff;padding: 26px 0px;">
        <div class="container-fluid"><a class="navbar-brand" href="index.html" style="margin-left: 46px;color: rgba(17,89,10,0.9);font-weight: bold;font-size: 27px;">SAO Reservation System</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1" style="font-size: 15px;margin-right: 37px;">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="form.php" style="margin-right: 44px;">Room Reservation</a></li>
                    <li class="nav-item"><a class="nav-link active" href="reftrack.php" style="margin-right: 44px;background: #aeeaad;border-radius: 11px;">Status Tracking</a></li>
                    <li class="nav-item"><a class="nav-link" href="AdminLogin.php" style="color: rgba(17,89,10,0.9);border: 1px solid rgb(17,89,10);border-radius: 6px;"><i class="fas fa-sign-in-alt"></i>&nbsp; Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="py-4 py-xl-5" style="background: url(&quot;assets/img/smooth-white-stucco-wall%20(1).jpg&quot;);background-size: contain;">
        <div class="container">
                <section class="py-4 py-xl-5">
                    <div class="container">
                            <section class="py-4 py-xl-5">
                                <div class="container">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4" style="width: 853px;">
                                            <div class="card mb-5">
                                                <div class="card-body p-sm-5" style="box-shadow: 0px 0px 13px rgb(176,176,176);">
                                                    <h2 class="text-center mb-4" style="color: rgb(11,145,8);font-size: 37px;">Reservation Status</h2>
                                                    <form method="POST" action="status.php">
                                                        <div class="mb-3">
                                                            <p><strong>Date Requested: </strong><?php echo date('F j, Y', strtotime($row['date_created']));?></p>
                                                            <p><strong>Reference Number:</strong> <?php echo $row['reservation_code']?></p>
                                                        </div>
                                                        <div class="mb-5"></div>
                                                        <div class="mb-4"><label class="form-label" style="font-size: 22px;font-weight: bold;color: rgb(8,72,26);">Booking Details</label>
                                                            <hr>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p><strong>Name:&nbsp;</strong><?php echo $row['last_name'] . ", " . $row['first_name']?></p>
                                                            <p><strong>DLSL</strong>&nbsp;<strong>Email:&nbsp;</strong> <?php echo $row['email'];?></p>
                                                            <p><strong>Contact Number: </strong><?php echo $row['contact'];?></p>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p><strong>Organization:&nbsp;</strong><?php echo $row['organization']?></p>
                                                                </div>
                                                                <div class="col">
                                                                    <p><strong>Service:&nbsp;</strong><?php echo $row['services']?></p>
                                                                </div>
                                                            </div>
                                                            <p><strong>Date:&nbsp;</strong><?php echo date('F j, Y', strtotime($row['date_reserved']));?></p>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p><strong>Start Time:&nbsp;</strong><?php echo date('h:i A', strtotime($row['start_time']))?></p>
                                                                </div>
                                                                <div class="col">
                                                                    <p><strong>End Time:&nbsp;</strong><?php echo date('h:i A', strtotime($row['end_time']))?></p>
                                                                </div>
                                                            </div>
                                                            <p><strong>Purpose of Reservation:&nbsp;</strong><?php echo $row['purpose']?></p>
                                                        </div>
                                                        
                                                        <div class="mb-4"></div>
                                                        <div class="mb-4"></div>
                                                        <div class="mb-5"></div>
                                                        <button type="submit" class="btn btn-primary" style="background: rgb(27,177,24);" name="back_button">Return</button>
                                                        <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel Reservation</button>
                                                        <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cancellation Reason</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="text" class="form-control" placeholder="Reason for Cancellation" style="margin-bottom: 10px;" maxlength="50" name="cancellation_reason" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-secondary" name="cancel_button">Ok</button>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                    </div>
                </section>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
</body>

</html>