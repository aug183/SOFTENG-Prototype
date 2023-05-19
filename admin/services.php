<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
</head>

<body>
    <?php
    require_once("../connection.php");
    ?>

    <div class="container py-5">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                    Services
                </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                <div class="accordion-body">
                <div class="container py-5">
                    <table id="table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <td>Services</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
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
                    Add Services
                </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="container-md shadow min-vh-50 py-2">
                        <form action="dates.php" method="POST">
                            <div class="form-floating mb-3">
                                <input name="service" id="service" class="form-control" type="text" placeholder="service" required />
                                <label for="service">New Service</label>
                                <div class="invalid-feedback">Please input new service</div>
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
    <script src="../script.js"></script>
</body>
</html>