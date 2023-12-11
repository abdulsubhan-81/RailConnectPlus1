<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>RailConnect+</title>
</head>
<body>
    <div class="intro">
        <div style="display:inline">
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/8/83/Indian_Railways.svg/640px-Indian_Railways.svg.png" width="75px" height="75px">
                <b style="font-size:26px;padding:10px;position:relative;top:-20px;">RailConnect+</b>
            </div>
        <div class="navigation_bar">
            <div><a href="check.php"><button>Home</button></a></div>
        </div>
    </div>
    <img src=""/>
    <form method="post">
        <div class="users">
            <div class="login">
                <div><h2>SIGNUP</h2></div>
                <div> Name <input type="text" name="name" required/></div>
                <div> Email <input type="text" name="username" required/></div>
                <div> Password <input type="password" name="password" required/></div>
                <div> Phone Number <input type="text" name="phone" required/></div>
                <div>Have Account? <a href="users.php">Login</a></div>
                <div><button>SIGNUP</button></div>
            </div>
        </div>
    </form>

    <?php
$db_hostname = "localhost";
$db_username = "id21110799_railconnect";
$db_password = "Railconnect+1";
$db_name = "id21110799_stations";

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $phone = $conn->real_escape_string($_POST['phone']);
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script>alert("Invalid email address");</script>';
        } else if (strpos($email, '@gmail.com') === false && strpos($email, '@anits.edu.in') === false) {
            echo '<script>alert("Please use a Gmail address");</script>';
        }
        else if (strlen($phone) != 10) {
            echo '<script>alert("Phone number must be 10 digits");</script>';
        }else {
            $sql = "INSERT INTO railusers (name, email, password, phone) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $email, $password, $phone);

            if ($stmt->execute()) {
                echo '<script>window.location.href = "users.php";</script>';
                exit();
            } else {
                die("Error: " . $conn->error);
            }

            $stmt->close();
        }
    }

$conn->close();
?>


    <footer>
        <div class="contact">
                <div class="part_1">
                <div>RAILCONNECT+</div>
                <div>contact:<a href="mailto:railway.help@gmail.com"><i class="ri-mail-line"></i></a></div>
            </div>
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
</body>
</html>
