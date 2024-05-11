<?php
    session_start();
    
    $servername = getenv('DB_HOST');
    $username = getenv('DB_USER');
    $password = getenv('DB_PASSWORD');
    $database = getenv('DB_NAME');
    
    $conn = mysqli_connect($servername, $username, $password, $database);

    $query = 'SELECT * FROM country';
    $result = mysqli_query($conn, $query);

    if(isset($_POST['btnSubmit'])){
        $fullname = $_POST['fullname'];
        $emailaddress = $_POST['emailaddress'];
        $country = $_POST['country'];
        $password = md5($_POST['password']);

        $insQuery = "INSERT INTO user (`Fullname`, `Email`, `Country`, `Password`) VALUES('".$fullname."', '".$emailaddress."', ".$country.", '".$password."')";

        $insRes = mysqli_query($conn, $insQuery);

        if($insRes){
            $_SESSION['flash_message'] = "User Record Inserted Successfully.";
            header("Location: index.php");
        }
    }
?>

<html>
    <head>
        <!-- Bootstrap CSS Link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- jQUery CDN Link -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <title>Add User</title>
    </head>
    <body>
        <div class="container">
            <h4>Add User</h4>
            <hr />
            
            <form method="post">
                <div class="form-group mt-2">
                    <label for="fullname">Full Name*</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter Full Name" required>
                </div>
                <div class="form-group mt-2">
                    <label for="emailaddress">Email address*</label>
                    <input type="email" class="form-control" id="emailaddress" name="emailaddress" placeholder="Enter email" required>
                </div>

                <div class="form-group mt-2">
                    <label for="country">Country*</label>
                    <select id="country" name="country" class="form-control" required>
                        <option selected>Select Country</option>

                        <?php
                        while($row = mysqli_fetch_assoc(($result))){
                        ?>
                            <option value="<?php echo $row['Id']; ?>"><?php echo $row['Name']; ?></option>  
                        <?php
                            }
                        ?>
                    </select>
                </div>
                
                <div class="form-group mt-2">
                    <label for="exampleInputPassword1">Password*</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required>
                </div>
                
                <button type="submit" class="btn btn-primary mt-2" name="btnSubmit">Submit</button>
                <a href="index.php"><button type="button" class="btn btn-danger mt-2">Cancel</button></a>
            </form>
            
        </div>

        <!-- Bootstrap JS Link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        
    </body>
</html>