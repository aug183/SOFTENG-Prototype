<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
</head>

<body>
    <?php
    require_once("../connection.php");

    if (isset($_POST['submit_button'])) {
        $date = $_POST['date'];
        if (isset($_POST['Working_Area'])) {
            $Working = $_POST["Working_Area"];
        } else $Working = "AVAILABLE";

        if (isset($_POST['Meeting_Room_1'])) {
            $Meeting1 = $_POST["Meeting_Room_1"];
        } else $Meeting1 = "AVAILABLE";

        if (isset($_POST['Meeting_Room_2'])) {
            $Meeting2 = $_POST["Meeting_Room_2"];
        } else $Meeting2 = "AVAILABLE";

        if (isset($_POST['Open_Space'])) {
            $OpenSpace = $_POST["Open_Space"];
        } else $OpenSpace = "AVAILABLE";

        if (isset($_POST['North_Wing'])) {
            $NorthWing = $_POST["North_Wing"];
        } else $NorthWing = "AVAILABLE";

        if (isset($_POST['South_Wing'])) {
            $SouthWing = $_POST["South_Wing"];
        } else $SouthWing = "AVAILABLE";

        if (isset($_POST['Zoom_Account'])) {
            $Zoom = $_POST["Zoom_Account"];
        } else $Zoom = "AVAILABLE";

        $reason = $_POST['reason'];


        $sql = "INSERT INTO `dates` (`dates`, `Working area`, `Meeting Room 1`, `Meeting Room 2`, `Open Space`, `North Wing`, `South Wing`, `Zoom Account`, reason)
                VALUES
                ('$date', '$Working', '$Meeting1', '$Meeting2', '$OpenSpace', '$NorthWing', '$SouthWing', '$Zoom', '$reason')
                ";

        if (!mysql_query($sql, $con)) {
            die('Error: ' . mysql_error());
        }
    }
    ?>

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
                                <td>Date</td>
                                <td>Reason</td>
                                <td>Working Area</td>
                                <td>Meeting Room 1</td>
                                <td>Meeting Room 2</td>
                                <td>Open Space</td>
                                <td>North Wing</td>
                                <td>South Wing</td>
                                <td>Zoom Account</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM dates";
                            $results = mysql_query($sql, $con);
                            while ($row = mysql_fetch_array($results)) {
                                echo "<tr>";
                                echo "<td>" . $row['dates'] . "</td>";
                                echo "<td>" . $row['reason'] . "</td>";
                                echo "<td>" . $row['Working area'] . "</td>";
                                echo "<td>" . $row['Meeting Room 1'] . "</td>";
                                echo "<td>" . $row['Meeting Room 2'] . "</td>";
                                echo "<td>" . $row['Open Space'] . "</td>";
                                echo "<td>" . $row['North Wing'] . "</td>";
                                echo "<td>" . $row['South Wing'] . "</td>";
                                echo "<td>" . $row['Zoom Account'] . "</td>";
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
                    <div class="container-md shadow min-vh-100">
                        <form action="dates.php" method="POST">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input name="date" id="Date" class="form-control" type="date" required />
                                        <span id="DateSelected"></span>
                                        <label for="date">Date to exclude</label>
                                        <div class="invalid-feedback">Please select date</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <select class="form-select form-select-sm" aria-label="reason" name="reason" id="reason" required>
                                            <option value="" disabled selected></option>
                                            <option value="Holiday">Holiday</option>
                                            <option value="No School">No School</option>
                                            <option value="Other">Other...</option>
                                        </select>
                                        <label for="reason">Reason</label>
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
                                    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"" . $row['offer_name'] .  "\" value=\"UNAVAILABLE\" id=\"" . $row['offer_name'] . "\" checked>";
                                    echo "<label class=\"form-check-label\" for=\"" . $row['offer_name'] . "\">" . $row['offer_name'] . "</label>";
                                    echo "</div>";
                                }
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4 text-center">
                                    <button type="submit" name="submit_button" id="submit_button" class="btn btn-primary">Submit</button>
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
    <script src="../script.js"></script>
</body>
</html>