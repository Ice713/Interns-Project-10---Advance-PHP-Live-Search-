<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Search using PHP and Ajax</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container bg-secondary">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 bg-light mt-2 rounded ph-3">
                <h1 class="text-primary p-2">Live Search Using PHP, MYSQLI, & AJAX</h1>
                <hr>
                <div class="form-inline"><label for="search" class="font-weight-bold lead text-dark">Search Record</label></div>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" name="search" id="search_text" class="form-control form-control-lg rounded-0 border-primary" placeholder="Search...">
            </div>
            <hr>
            <?php
                include 'config.php';
                $stmt=$conn->prepare("SELECT * FROM data");
                $stmt->execute();
                $result=$stmt->get_result();
            ?>
            <table class="table table-hover table-light table-striped" id="table-data">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row=$result->fetch_assoc()){ ?>
                        <tr>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['location']; ?></td>
                        </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#search_text").keyup(function(){
                var search = $(this).val();
                $.ajax ({
                    url:'action.php',
                    method:'post',
                    data:{query:search},
                    success:function(response){
                        $("#table-data").html(response);
                    }
                })
            });
        });
    </script>
</body>
</html>