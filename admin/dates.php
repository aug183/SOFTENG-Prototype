<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dates</title>
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
    require_once("require.php");
    if (isset($_POST['submit_button'])) {
        //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $inputFields = $_POST['input-field'];
        $mysqli = new mysqli('localhost', 'root', '', 'reservation');
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }
        $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'dates'";
        $result = mysqli_query($mysqli, $sql);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $tableName = "dates";
        $columnNames = "`" . implode("`,`", array_column($result, "COLUMN_NAME")) . "`";
        $placeholders = implode(",", array_fill(0, count($inputFields), "?"));
        $sql = "INSERT INTO `$tableName` ($columnNames) VALUES ($placeholders)";
        $stmt = mysqli_prepare($mysqli, $sql);

        // Bind the parameters dynamically
        $paramTypes = str_repeat("s", count($inputFields));
        $stmt->bind_param($paramTypes, ...$inputFields);
        
        // Execute the SQL statement
        $stmt->execute();

        // Close the statement
        $stmt->close();
        header("Refresh: 0");
    }
    ?>
    <nav class="navbar navbar-light navbar-expand-md py-3" style="border-bottom-color: rgb(14,15,16);box-shadow: 0px 1px 20px rgb(183,183,183);">
        <div class="container"><a class="navbar-brand d-flex align-items-center" style="color: rgb(19,161,7);font-size: 36px;font-weight: bold;"><span style="color: rgb(19, 161, 7);">SAO Reservation System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="navbar-nav ms-auto nav-pills">
                    <li class="nav-item"><a class="nav-link" href="index.php">Reservations</a></li>
                    <li class="nav-item"><a class="nav-link" href="orgs.php">Organizations</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                </ul><a href="logout.php" style="color: rgb(19,161,7);border-width: 1px;border-style: solid;border-radius: 3px;padding: 13px;width: 105px;text-align: center;"><i class="fas fa-sign-in-alt" style="margin-right: 7px;"></i>Logout</a>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                    Dates 
                </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                <div class="accordion-body">
                <div class="container py-5">
                    <table id="table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <?php 
                                require_once('../connection.php');
                                $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'dates'";
                                $result = mysql_query($sql, $con);
                                while ($row = mysql_fetch_array($result)) {
                                    echo "<td>" . $row['COLUMN_NAME'] . "</td>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM dates";
                            $results = mysql_query($sql, $con);
                            while ($row = mysql_fetch_assoc($results)) {
                                echo "<tr>";
                                $count = true;
                                foreach ($row as $column) {
                                    if ($count == true) {
                                        $count = false;
                                        echo "<td>" . date('Y, F j', strtotime($column)) . "</td>";
                                        continue;
                                    } else {
                                        echo "<td>" . $column . "</td>";
                                    }
                                }
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                    Add Date
                </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="container-md shadow min-vh-50">
                        <form class="needs-validation" novalidate action="dates.php" method="POST">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input name="input-field[]" id="Date" class="form-control" type="date" required />
                                        <span id="DateSelected"></span>
                                        <label for="date">Date to exclude</label>
                                        <div class="invalid-feedback">Please select date</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <select class="form-select form-select-sm" aria-label="reason" name="input-field[]" id="reason" required>
                                            <option value="" disabled selected></option>
                                            <option value="Holiday">Holiday</option>
                                            <option value="No School">No School</option>
                                            <option value="Other">Other...</option>
                                        </select>
                                        <label for="reason">Reason</label>
                                        <div class="invalid-feedback">Please select reason</div>
                                    </div>
                                </div>
                            </div>
                            <label class="form-label">Affected:</label>
                            <div class="mb-3 text-center">
                                <?php
                                $sql = "SELECT * FROM offers";
                                $result = mysql_query($sql, $con);
                                while ($row = mysql_fetch_array($result)) {
                                    echo "<div class=\"form-check form-check-inline\">";
                                    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"input-field[]\" value=\"UNAVAILABLE\" id=\"" . $row['offer_name'] . "\" checked>";
                                    echo "<label class=\"form-check-label\" for=\"" . $row['offer_name'] . "\">" . $row['offer_name'] . "</label>";
                                    echo "</div>";
                                }
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4 text-center">
                                    <button type="submit" name="submit_button" id="submit_button" class="btn btn-primary mb-3">Submit</button>
                                </div>
                                <div class="col-4"></div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> 
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>