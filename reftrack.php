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

<body style="background: url(&quot;assets/img/smooth-white-stucco-wall%20(1).jpg&quot;) top / contain;">
<?php 
    session_start();
    if (isset($_SESSION['id'])) {
        header("location: status.php");
        exit;
    }

    require_once('connection.php');
    if (isset($_POST['submit_button'])) {
        $id = (int)clean($_POST['id']);
        $password = clean($_POST['password']);
        $sql = "SELECT * FROM `reservations` WHERE reservation_code = '$id' AND `password` = '$password'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['id'] = $id;
            header("location: status.php");
            exit;
        } else {
            $login_err = "Invalid reference number or password.";
        }
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
                    <li class="nav-item"><a class="nav-link" href="form.php" style="margin-right: 44px;">Room Reservation</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#" style="margin-right: 44px;background: #aeeaad;border-radius: 11px;">Status Tracking</a></li>
                    <li class="nav-item"><a class="nav-link" href="AdminLogin.php" style="color: rgba(17,89,10,0.9);border: 1px solid rgb(17,89,10);border-radius: 6px;"><i class="fas fa-sign-in-alt"></i>&nbsp; Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="py-4 py-xl-5" style="height: 100vh;">
        <section class="py-4 py-xl-9">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-8 col-xl-6 text-center mx-auto"></div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-8 col-xl-6 text-center mx-auto"></div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-8 col-xl-6 text-center mx-auto">
                        <h1 style="color: rgb(0,0,0);">Status Tracking</h1>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="col"></div>
                    <div class="col-md-6 col-xl-4 col-xxl-9">
                        <div class="card mb-5" style="border-radius: 81px;">
                            <div class="card-body d-flex flex-column align-items-center" style="background: rgb(64,169,68);">
                                <form class="text-center" method="post" action="reftrack.php">
                                    <div class="mb-3">
                                        <div class="row mb-5">
                                            <div class="col"></div>
                                            <div class="col-md-8 col-xl-6 text-center mx-auto"></div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                         <?php
                                            if(!empty($login_err)){
                                                echo '<div class="alert alert-danger">' . $login_err . '</div>';
                                            }
                                        ?>
                                        <div class="mb-3"></div>
                                        <div class="input-group">
                                            <span class="input-group-text" style="background: rgb(230,255,176);color: rgb(39,94,44);font-weight: bold;font-family: Archivo, sans-serif;border-style: none;">Reference No.</span>
                                            <input class="form-control" type="tel" name="id" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="mb-3"></div>
                                        <div class="input-group">
                                            <span class="input-group-text" style="background: rgb(230,255,176);color: rgb(39,94,44);font-weight: bold;font-family: Archivo, sans-serif;border-style: none;">Password</span>
                                            <input class="form-control" type="text" name="password" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="submit_button" style="background: rgb(230,255,176);color: rgb(39,94,44);font-weight: bold;font-family: Archivo, sans-serif;border-style: none;">Check</button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </section>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
</body>

</html>