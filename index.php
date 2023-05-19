<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAO Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
  <body>
    <?php 
        require_once("connection.php");
        if(isset($_POST['submit_button'])){
            $last_name = $_POST['lastName'];
            $first_name = $_POST['firstName'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $organization = $_POST['Organization'];
            $service = $_POST['reserveItem'];
            $date = $_POST['date'];
            $start_time = $_POST['startTime'];
            $end_time = $_POST['end_time'];
            $purpose = $_POST['purpose'];
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
    ?>
    <div class="container-md shadow min-vh-100 py-2">
        <form class="needs-validation" novalidate action="index.php" method="POST">
            <h1>SAO Reservation Form</h1>
            <h6>Please fill out the form</h6>
            <hr>
            <div class="row mb-3">
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Last Name" name="lastName" id="lastName" required>
                        <label for="lastName">Last Name</label>
                        <div class="invalid-feedback">This a required field.</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="First Name" name="firstName" id="firstName" required>
                        <label for="lastName">First Name</label>
                        <div class="invalid-feedback">This a required field.</div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="email@dlsl.edu.ph" name="email" id="email" pattern="[a-z0-9._%+-]+@dlsl.edu.ph" required>
                        <label for="email">DLSL Email</label>
                        <div class="invalid-feedback">Please input DLSL email</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" placeholder="0999-999-9999" name="contact" id="contact" pattern="09\d{9}" required>
                        <label for="contact">Contact Number</label>
                        <div class="invalid-feedback">11-digit number starting with 09</div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <div class="form-floating">
                        <select class="form-select form-select-sm" aria-label="Organization" name="Organization" id="organization" required>
                            <option value="" disabled selected></option>
                            <?php 
                                $result = mysql_query("SELECT * FROM organizations");
                                while($row = mysql_fetch_array($result))
                                {
                                    echo "<option value=\"" . $row['Acronym'] . "\">" . $row['Organization Name'] . "</option>";
                                }
                            ?>
                        </select>
                        <label for="organization">Select Organization</label>
                        <div class="invalid-feedback">Please select organization.</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        <select class="form-select form-select-sm" aria-label="To Reserve" name="reserveItem" id="reserveItem" required>
                            <option value="" disabled selected></option>
                            <?php 
                                $result = mysql_query("SELECT offer_name FROM offers");
                                while($row = mysql_fetch_array($result))
                                {
                                    echo "<option value=\"" . $row['offer_name'] . "\">" . $row['offer_name'] . "</option>";
                                }
                            ?>
                        </select>
                        <label for="reserveItem">Select Service</label>
                        <div class="invalid-feedback">Please select service.</div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-md-4 mb-3">
                    <div class="form-floating">
                        <input name="date" id="Date" class="form-control" type="date" required/>
                        <span id="DateSelected"></span>
                        <label for="date">Date</label>
                        <div class="invalid-feedback">Please select date</div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="cs-form">
                        <div class="form-floating">
                            <input name="startTime" type="time" class="form-control" value="" id="startTime" required/>
                            <label for="startTime">Start Time</label>
                            <div class="invalid-feedback">Please select start time.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="cs-form">
                        <div class="form-floating">
                            <input name="end_time" type="time" class="form-control" value="" id="endTime" required/>
                            <label for="endTime">End Time</label>
                            <div class="invalid-feedback">Please select end time.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Purpose" name="purpose" id="purpose" style="height: 100px" required></textarea>
                <label for="purpose">Purpose</label>
                <div class="invalid-feedback">Required</div>
            </div>
            <div class="form-check mb-3" style="font-size: 12px; font-style: oblique;">
                <input class="form-check-input" type="checkbox" value="" id="consent" required>
                <label class="form-check-label" for="consent">
                I understand that by accomplishing this form, I am allowing the College SAO to collect, use,
                and process my personal data submitted for legitimate purposes.
                </label>
                <div class="invalid-feedback">You must agree before submitting.</div>
            </div>
            <div class="row">
                <div class="col-4">
                </div>
                <div class="col-4 text-center">
                    <button type="submit" class="btn btn-primary mb-3" id="submit_button" name="submit_button">Submit</button>
                </div>
                <div class="col-4">
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="script.js"></script>
  </body>
</html>