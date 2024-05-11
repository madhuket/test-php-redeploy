<?php
    session_start();

    $servername = getenv('DB_HOST');
    $username = getenv('DB_USER');
    $password = getenv('DB_PASSWORD');
    $database = getenv('DB_NAME');

    $conn = mysqli_connect($servername, $username, $password, $database);
    $query = 'SELECT *, c.Name as countryName FROM user u JOIN country c ON u.country = c.Id';
    $result = mysqli_query($conn, $query);
?>

<html>
    <head>
        <!-- Bootstrap CSS Link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- jQUery CDN Link -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <title>User List</title>
    </head>
    <body>
        <div class="container">
            <div class="row mt-2">
                <div class="col-md-6"><h4>User List</h4></div>
                <div class="col-md-6"><a href="add_user.php"><button type="button" class="btn btn-primary">Add User</button></a></div>
            </div>
            
            <hr />
            <?php
                if(isset($_SESSION['flash_message'])) {
                    ?>
                    <div class="alert alert-success alert-dismissible fade show usrMsg" role="alert">
                        <?php echo $_SESSION['flash_message']; ?>
                    </div>
                    <?php
                    unset($_SESSION['flash_message']);
                }
            ?>
            
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Sr. No.</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Country</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i=1;
                        while($row = mysqli_fetch_assoc(($result))){
                            ?>
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td><?php echo $row['Fullname'] ?></td>
                                <td><?php echo $row['Email'] ?></td>
                                <td><?php echo $row['countryName'] ?></td>
                            </tr>
                            <?php
                            $i++;
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Bootstrap JS Link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>