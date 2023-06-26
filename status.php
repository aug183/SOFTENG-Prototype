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
            <form>
                <section class="py-4 py-xl-5">
                    <div class="container">
                        <form>
                            <section class="py-4 py-xl-5">
                                <div class="container">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4" style="width: 853px;">
                                            <div class="card mb-5">
                                                <div class="card-body p-sm-5" style="box-shadow: 0px 0px 13px rgb(176,176,176);">
                                                    <h2 class="text-center mb-4" style="color: rgb(11,145,8);font-size: 37px;">Reservation Status</h2>
                                                    <form method="post">
                                                        <div class="mb-3">
                                                            <p><strong>Date Requested:</strong></p>
                                                            <p><strong>Reference Number:</strong></p>
                                                            <p><strong>Status of Reservation:&nbsp;</strong></p>
                                                        </div>
                                                        <div class="mb-5"></div>
                                                        <div class="mb-4"><label class="form-label" style="font-size: 22px;font-weight: bold;color: rgb(8,72,26);">Booking Details</label>
                                                            <hr>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p><strong>Name:&nbsp;</strong></p>
                                                            <p><strong>DLSL</strong>&nbsp;<strong>Email:&nbsp;</strong></p>
                                                            <p><strong>Contact Number:</strong></p>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p><strong>Organization:&nbsp;</strong></p>
                                                                </div>
                                                                <div class="col">
                                                                    <p><strong>Service:&nbsp;</strong></p>
                                                                </div>
                                                            </div>
                                                            <p><strong>Date:&nbsp;</strong></p>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p><strong>Start Time:&nbsp;</strong></p>
                                                                </div>
                                                                <div class="col">
                                                                    <p><strong>End Time:&nbsp;</strong></p>
                                                                </div>
                                                            </div>
                                                            <p><strong>Purpose of Reservation:&nbsp;</strong></p>
                                                        </div>
                                                        <div class="mb-4"></div>
                                                        <div class="mb-4"></div>
                                                        <div class="mb-5"></div>
                                                    </form><button class="btn btn-primary" type="button" style="background: rgb(27,177,24);">Cancel Reservation</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </form>
                    </div>
                </section>
            </form>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
</body>

</html>