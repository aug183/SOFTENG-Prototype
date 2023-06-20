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
        require_once("connection.php");
        $last_nameErr = $first_nameErr = $emailErr = $contactErr = $organizationErr = $service = $dateErr = $startTimeErr = $endTimeErr = $purposeErr = "";
        if(isset($_POST['submit_button'])){
            $last_name = clean($_POST['lastName']);
            $first_name = clean($_POST['firstName']);
            $email = clean($_POST['email']);
            $contact = clean($_POST['contact']);
            $organization = clean($_POST['Organization']);
            $service = clean($_POST['reserveItem']);
            $date = clean($_POST['date']);
            $start_time = clean($_POST['startTime']);
            $end_time = clean($_POST['end_time']);
            $purpose = clean($_POST['purpose']);
            $overlap = false;

            if ($start_time > $end_time)
            {
                echo '<script type="text/javascript">';
                echo ' alert("Your start time is later than your end time.")';
                echo '</script>';
            }
            else
            {
                $sql = "SELECT * FROM reservations WHERE 
                (start_time BETWEEN '$start_time' AND '$end_time') OR (end_time BETWEEN '$start_time' AND '$end_time')";
                $result = mysql_query($sql, $con);

                while($row = mysql_fetch_array($result))
                {
                    $existingDate = $row['date_reserved'];
                    $existingServices = $row['services'];

                    if ($existingDate == $date && $existingServices == $service)
                    {
                        $overlap = true;
                        break;
                    }
                }

                if ($overlap){
                    echo '<script type="text/javascript">';
                    echo ' alert("Your time overlap with an existing reservation.")';
                    echo '</script>';
                    header("Refresh:0");
                    die();
                }
                else{
                    $sql = "INSERT INTO reservations (last_name, first_name, email, contact, organization, services, date_reserved, start_time, end_time, purpose)
                    VALUES
                    ('$last_name', '$first_name', '$email', '$contact', '$organization', '$service', '$date', '$start_time', '$end_time', '$purpose')";
                    
                    if (!mysql_query($sql, $con))
                    {
                        die('Error: ' . mysql_error());
                    }
                }
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
                    <li class="nav-item"><a class="nav-link active" href="#" style="background: #aeeaad;margin-right: 44px;border-radius: 11px;">Room Reservation</a></li>
                    <li class="nav-item"><a class="nav-link" href="reftrack.php" style="margin-right: 44px;">Status Tracking</a></li>
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
                                        <div class="card-body p-sm-5" style="box-shadow: 0px 0px 13px rgb(176,176,176);"><i class="fab fa-wpforms text-center d-flex justify-content-center align-items-center" style="font-size: 111px;color: rgb(17,137,36);"></i>
                                            <h2 class="text-center mb-4" style="color: rgb(11,145,8);font-size: 37px;">SAO Reservation Form</h2>
                                            <form class="needs-validation" novalidate action="form.php" method="POST">
                                                <div class="mb-4"><label class="form-label" style="font-size: 22px;font-weight: bold;color: rgb(8,72,26);">Personal Details</label>
                                                    <hr style="border: none;border-top: 2px solid #ccc;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" style="color: #08481a;">First Name</label>
                                                    <input class="form-control <?php echo $first_nameErr?>" type="text" id="firstName" name="firstName" required>
                                                    <div class="invalid-feedback">This a required field.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" style="color: rgb(8,72,26);">Last Name</label>
                                                    <input class="form-control" type="text" id="lastName" name="lastName" required>
                                                    <div class="invalid-feedback">This a required field.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" style="color: rgb(8,72,26);">DLSL Email</label>
                                                    <input class="form-control" type="email" placeholder="email@dlsl.edu.ph" name="email" id="email" pattern="[a-z_.]+@dlsl.edu.ph" required>
                                                    <div class="invalid-feedback">Please input DLSL email</div>
                                                </div>
                                                <div class="mb-5">
                                                    <label class="form-label" style="color: rgb(8,72,26);">Contact Number</label>
                                                    <input type="tel" class="form-control" placeholder="0999-999-9999" name="contact" id="contact" pattern="09\d{9}" required>
                                                    <div class="invalid-feedback">11-digit number starting with 09</div>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" style="font-size: 22px;font-weight: bold;color: rgb(8,72,26);">Event Details</label>
                                                    <hr>
                                                </div>
                                                <div class="mb-3"></div>
                                                <div class="mb-4">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col">
                                                                    <select class="form-select" aria-label="Organization" name="Organization" id="organization" style="padding: 11px 12px;" required>
                                                                        <option value="" disabled selected>Organization</option>
                                                                        <?php 
                                                                            $result = mysql_query("SELECT * FROM organizations");
                                                                            while($row = mysql_fetch_array($result))
                                                                            {
                                                                                echo "<option value=\"" . $row['Acronym'] . "\">" . $row['Organization Name'] . "</option>";
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                    <div class="invalid-feedback">Please select organization.</div>
                                                            </div>
                                                            <div class="col">
                                                                <select class="form-select form-select-sm" aria-label="To Reserve" name="reserveItem" id="reserveItem" style="padding: 11px 12px;" required>
                                                                    <option value="" disabled selected>Service</option>
                                                                    <?php 
                                                                        $result = mysql_query("SELECT offer_name FROM offers");
                                                                        while($row = mysql_fetch_array($result))
                                                                        {
                                                                            echo "<option value=\"" . $row['offer_name'] . "\">" . $row['offer_name'] . "</option>";
                                                                        }
                                                                    ?>
                                                                </select>
                                                                <div class="invalid-feedback">Please select service.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="col">
                                                        <label for="date" style="color: rgb(8,72,26);">Date</label>
                                                        <input class="form-control" type="date" name="date" id="Date" required>
                                                        <div class="invalid-feedback">Please select date</div>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <label class="form-label" style="color: rgb(8,72,26);">Start Time</label>
                                                            <input name="startTime" type="time" class="form-control" value="" id="startTime" style="width: 179.5px;" required/>
                                                            <div class="invalid-feedback">Please select start time.</div>
                                                        </div>
                                                        <div class="col">
                                                            <label class="form-label" style="color: rgb(8,72,26);" for="endTime">End Time</label>
                                                            <input name="end_time" type="time" class="form-control" value="" id="endTime" style="width: 179.5px;" required/>
                                                            <div class="invalid-feedback">Please select end time.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="mb-4"></div>
                                                    <label class="form-label" style="color: rgb(8,72,26);" for="purpose">Purpose of Reservation</label>
                                                    <textarea class="form-control" id="purpose" name="purpose" rows="6" required></textarea>
                                                    <div class="invalid-feedback">Required</div>
                                                </div>
                                                <div class="mb-5">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="consent" required>
                                                        <label class="form-check-label" for="consent">
                                                            <em>I understand that by accomplishing this form, I am allowing SAO to collect, use, and process my personal data submitted for legitimate purposes.</em>
                                                        </label>
                                                        <div class="invalid-feedback">You must agree before submitting.</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4"></div>
                                                    <div class="col-4 text-center">
                                                        <button class="btn btn-primary" type="submit" style="background: rgb(27,177,24);border-color: rgba(255,255,255,0);width: 125px;" id="submit_button" name="submit_button">Submit</button>
                                                    </div>
                                                    <div class="col-4"></div>
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
    <script src="assets/js/script.js"></script>
</body>

</html>