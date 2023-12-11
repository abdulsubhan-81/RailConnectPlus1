<?php
session_start();
$email=$_SESSION['user'];
?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" integrity="sha512-HXXR0l2yMwHDrDyxJbrMD9eLvPe3z3qL3PPeozNTsiHJEENxx8DH2CxmV05iwG0dwoz5n4gQZQyYLUNt1Wdgfg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>

body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    background-image:url('https://pikwizard.com/pw/medium/8bd91d25f36637aa3c269550dbeab0b5.avif');
    background-repeat:no-repeat;
    background-size:cover;
    margin: 0;
    padding: 0;
}

.intro {
    background-color: #007bff;
    color: #fff;
    padding: 10px;
    text-align: center;
}

.intro h2 {
    margin: 0;
}
.column{
    display:flex;
    flex-direction:row;
    justify-content:space-between;
    margin:0 80px;
}
.navigation_bar {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

.navigation_bar div {
    margin: 0 10px;
}
h3,h2{
    color:white;
}
.pic{
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='64' height='64'%3E%3Cpath d='M21.0082 3C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H21.0082ZM20 5H4V19H20V5ZM18 15V17H6V15H18ZM12 7V13H6V7H12ZM18 11V13H14V11H18ZM10 9H8V11H10V9ZM18 7V9H14V7H18Z'%3E%3C/path%3E%3C/svg%3E");
}
.navigation_bar button {
    width:120px;
    height:60px;
    font-size:20px;
    font-weight: bold;
    border:none;
    background-color:inherit;
    color:white;
    border-radius:10px;
    margin:10px;
}
section {
    background-color:rgba(70,29,79,0.23);
    padding: 20px;
    margin: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ccc;
}

table th, table td {
    padding: 10px;
    text-align: left;
}

table th {
    background-color: #007bff;
    font-size:22px;
    color: #fff;
}
table td{
    color: #fff;
    font-size:20px;
    font-weight:bolder;
}

button:hover{
    border:solid 1px white;
}
button {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    margin-top: 10px;
}

footer {
    background-color: #333;
    color: #fff;
    padding: 20px;
}

.contact {
    display: flex;
    justify-content: space-between;
}

.contact .part_1 {
    flex: 1;
}

.contact .part_1 div {
    margin-bottom: 10px;
}

.contact .part_2 {
    flex: 2;
}

.contact .part_2 ul {
    list-style-type: none;
    padding: 0;
}

.contact .part_2 li {
    margin-bottom: 5px;
}

.contact .part_2 a {
    color: #fff;
    text-decoration: none;
}

.contact .part_3 {
    flex: 1;
}
a{
    color:white;
    text-decoration:none;
}
a:hover{
    color:red;
}
.contact .part_3 a {
    display: block;
    margin-bottom: 5px;
}

.contact .part_4 {
    flex: 1;
}

.contact h3 {
    margin: 0;
}
    </style>
    <title>RailConnect+</title>
</head>
<body>
    <div class="intro">
        <div style="display:inline">
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/8/83/Indian_Railways.svg/640px-Indian_Railways.svg.png" width="75px" height="75px">
                <b style="font-size:26px;padding:10px;position:relative;top:-20px;">RailConnect+</b>
            </div>
        <div class="navigation_bar">
            <div><a href="miniproject.php"><button>Home</button></a></div>
            <div><button onclick="view()">Services</button></div>
            <div><a href="booking.php"><button>My Bookings</button></a></div>
            <div><a href="book.php"><button>Book Ticket</button></a></div>
            <div><a href="profile.php"<button>Profile</button></a></div>
        </div>
    </div>
    <section>
    <h2>User Information</h2>
    <?php
    $db_hostname = "localhost";
    $db_username = "id21110799_railconnect";
    $db_password = "Railconnect+1";
    $db_name = "id21110799_stations";
    $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

    if (!$conn) {
        echo "Failed to connect: " . mysqli_connect_error();
        exit;
    }
    $query = "SELECT * FROM railusers WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        $name = $row['name']; 
        $userPhone = $row['phone'];     
        echo '<div class="column">
            <div><h3>Welcome, ' . $name . '</h3>';
        echo '<h3>Email: ' . $email . '</h3>';
        echo '<h3>Phone: ' . $userPhone . '</h3></div>
        </div>';
    } else {
        echo 'User not found';
    }
} else {
    echo 'Failed to retrieve user information';
}

?>
    </section>
    <section>
    <h2>Booking History</h2>
    <table>
        <?php
        $querya = "SELECT * FROM booking WHERE id = '$email'";
        $resulta = mysqli_query($conn, $querya);
        if (mysqli_num_rows($resulta) > 0) {
        $rowa = mysqli_fetch_assoc($result);
        }
        echo'
        <thead>
            <tr>
                <th>date</th>
                <th>Train No</th>
                <th>source</th>
                <th>destination</th>
                <th>Passenger</th>
                <th>age</th>
                <th>gender</th>
            </tr>
        </thead>';
        while ($rowa = mysqli_fetch_assoc($resulta)) {
        echo '
        <tr>
            <td>' . $rowa['date'] . '</td>
            <td>' . $rowa['train_no'] . '</td>
            <td>' . $rowa['source'] . '</td>
            <td>' . $rowa['destination'] . '</td>
            <td>' . $rowa['passenger'] . '</td>
            <td>' . $rowa['age'] . '</td>
            <td>' . $rowa['gender'] . '</td>
        </tr>
        ';
    }
        ?>
    </table>
    <a href="logout.php"><button>logout</button></a>
    </section>
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
                    <li><a href="luggage.html">Luggage Lost</a></li>
                    <li><a href="Help.html">Report Issue</a></li>
                    <li>Ticket Booking</li>
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