<?php
session_start();
?>
<html>
    <body>
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" integrity="sha512-HXXR0l2yMwHDrDyxJbrMD9eLvPe3z3qL3PPeozNTsiHJEENxx8DH2CxmV05iwG0dwoz5n4gQZQyYLUNt1Wdgfg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <div class="intro">
            <div style="display:inline">
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/8/83/Indian_Railways.svg/640px-Indian_Railways.svg.png" width="75px" height="75px">
                <b style="font-size:26px;padding:10px;position:relative;top:-20px;">RailConnect+</b>
            </div>
        <div class="navigation_bar">
            <div><a href="check.php"><button><i class="ri-home-line"></i>Home</button></a></div>
        </div>
        </div>
        <form method="post" id="loginForm">
        <div class="users">
            <div class="login">
                <div><h2>LOGIN</h2></div>
               <div> Email&emsp;<input type="text" name="username"/></div>
               <div> Password &emsp;<input type="password" name="password"/></div>
               <div><button>LOGIN</button><a href="#">Forget password?</a></div>
               <div>Don't have account<a href="signup.php"> Register here</a></div>
            </div>
        </div>
        </form>
    </div>

        <?php
session_start();
$db_hostname = "localhost";
$db_username = "id21110799_railconnect";
$db_password = "Railconnect+1";
$db_name = "id21110799_stations";
$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

if (!$conn) {
    echo "Failed to connect: " . mysqli_connect_error();
    exit;
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM railusers WHERE email = '$username'";
    $result = mysqli_query($conn, $query);
    if($username=="admin" &&$password="admin"){
       $_SESSION['loggedin'] = 'a'; 
       echo '<script>window.location.href = "admin.php";</script>';
    }
    else{
    if (!$result) {
        echo "<center>Error executing query: " . mysqli_error($conn) . "</center>";
        exit;
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($password === $row['password']) {
            $_SESSION['loggedin'] = 'y';
            $_SESSION['user']=$username;
            echo '<script>window.location.href = "miniproject.php";</script>';
            exit;
        } else {
             echo '<script>
                alert("Wrong Password");
            </script>';
        }
    } else {
        echo '<script>alert("Account not found");</script>';
    }
    }
}
?>

    </body>
    <footer>
        <div  class="contact">
            <div class="part_1">
                <div>RAILCONNECT+</div>
                <div>contact:<a href="mailto:railway.help@gmail.com"><i class="ri-mail-line"></i></a></div>
            </div>
            <div class="part_2">
                <h4><b>Our Services</b></h4>
                <ul>
                    <li>Food Orders</li>
                    <li>Train Enquiry</li>
                    <li>Report Issue</li>
                    <li>Ticket Booking</li>
                    <li>Search Trains</li>
                </ul>
            </div>
            <div class="part_3">
                <h4>Useful Links</h4>
                <a href="#"></a>
                <a href="#"></a>
                <a href="#"></a>
                <a href="#"></a>
            </div>
            <div class="part_4">
                <h3>Follow us</h3>
                <div><i class="ri-facebook-box-line"></i></div>
                <div><i class="ri-instagram-line"></i><div>
            </div>
        </div>
    </footer>
    
</html>