<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Organizations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet"><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme&amp;display=swap">
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
    if (isset($_POST['submit_button'])) {
        $acronym = clean($_POST['acronym']);
        $name = clean($_POST['name']);
        $sql = "INSERT INTO organizations (`Acronym`, `Organization Name`) VALUES ('$acronym', '$name')";
        if (!mysql_query($sql, $con)) {
            die('Error: ' . mysql_error());
        } else {
            header("Refresh:0");
        }
    }

    function clean($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>
    <nav class="navbar navbar-light navbar-expand-md py-3" style="border-bottom-color: rgb(14,15,16);box-shadow: 0px 1px 20px rgb(183,183,183);">
        <div class="container"><a class="navbar-brand d-flex align-items-center"style="color: rgb(19,161,7);font-size: 36px;font-weight: bold;"><span style="color: rgb(19, 161, 7);">SAO Reservation System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="navbar-nav ms-auto nav-pills">
                    <li class="nav-item"><a class="nav-link" href="index.php">Reservations</a></li>
                    <li class="nav-item"><a class="nav-link" href="dates.php">Dates</a></li>
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
                    Organizations
                </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                <div class="accordion-body">
                <div class="container py-5">
                    <table id="table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <td>Acronym</td>
                                <td>Name</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM organizations";
                                $result = mysql_query($sql, $con);
                                while($row = mysql_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row['Acronym'] . "</td>";
                                    echo "<td>" . $row['Organization Name'] . "</td>";
                                    echo "<td><button class=\"btn btn-danger\" onclick=\"deleteOrg('". $row['Organization Name']. "')\">Delete</button></td>";
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
                    Add Organization
                </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="container-md shadow min-vh-50 py-2">
                        <form class="needs-validation" novalidate action="orgs.php" method="POST">
                            <div class="mb-3">
                                <label for="acronym" class="form-label">Acronym</label>
                                <input name="acronym" id="acronym" class="form-control" type="text" placeholder="DLSL &quot;ACRONYM&quot;" pattern="DLSL +[A-Z]{2,}" required />
                                <div class="invalid-feedback">Please input valid org acronym</div>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Org Name</label>
                                <input name="name" id="name" class="form-control" type="text" placeholder="Organization Name" required />
                                <div class="invalid-feedback">Please input org name</div>
                            </div>
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4 text-center">
                                    <button type="submit" name="submit_button" id="submit_button" class="btn btn-primary mb-3">Add</button>
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