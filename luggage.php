<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['complaint'])) {
        $db_hostname = "localhost";
        $db_username = "id21110799_railconnect";
        $db_password = "Railconnect+1";
        $db_name = "id21110799_stations";
        $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $tid = mysqli_real_escape_string($conn, $_POST['ticketID']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $iden = mysqli_real_escape_string($conn, $_POST['identificationMarks']);
        $im = isset($_FILES['fileName']['name']) ? mysqli_real_escape_string($conn, $_FILES['fileName']['name']) : null;

        $st = "INSERT INTO luggage (name, ticketID, phone, date, identificationMarks, image) VALUES ('$name', '$tid', '$phone', '$date', '$iden', '$im');";

        if (mysqli_query($conn, $st)) {
            echo 'Data inserted successfully';
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}

?>

<html>
    <title>Booking</title>
    <head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        nav >.intro{
            background-image:linear-gradient(45deg,rgb(0, 128, 128),rgb(0, 57, 155));
        }
        .intro{
            color:white;
            display:flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            padding:10px 10px;
        }
        .video-container {
        position: fixed;
        width: 100%;
        height: 100vh;
        opacity:0.8;
        z-index: -1;
        }

        video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
        footer{
            background-color:rgb(0, 128, 128);
            background-repeat: no-repeat;
            background-position: center;
            color:white;
            font-size:20px;
        }
        .contact{
            display: flex;
            flex-direction:row;
            align-items: center;
            justify-content: space-between;
            padding: 0px 60px;
        }
        .container {
            max-width: 400px;
            margin:80px 30px 100px 900px;
            background-image:linear-gradient(45deg,rgb(0, 128, 128),rgb(0, 57, 155));
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 30px;
            font-size:18px;
            color:white;
            font-weight:bold;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input{
            font-size:18px;
            font-weight:1;
        }
        .form-group {
            margin-bottom: 20px;
            padding:10px;
        }
        .form-group > input{
            border-radius:10px;
        }
        label {
            display: block;
            font-size:18px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border: 2px solid yellow;
        }
        a{
            color:white;
            text-decoration:none;
        }
        a:hover{
            color:red;
        }
        li{
            list-style:none;
        }
        button{
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
        button:hover{
            border:solid 1px white;
        }
    </style>
    </head>
<body>
    <div class="video-container">
        <video autoplay loop muted>
            <source src="https://cdn.pixabay.com/vimeo/157269914/man-2338.mp4?width=640&hash=a3fcc8823d97bff556df4e4d51eb901383e45287" type="video/mp4">
        </video>
    </div>
    <nav>
        <div class="intro">
                <div class="intro">
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/8/83/Indian_Railways.svg/640px-Indian_Railways.svg.png" width="75px" height="75px">
                    <b style="font-size:26px;padding:10px;">RailConnect+</b>
                </div>
                <div class="intro">
                        <div><a href="miniproject.php"><button>Home</button></a></div>
                        <div><button>Services</button></div>
                        <div><a href="profile.php"><button>My Bookings</button></a></div>
                        <div><a href="profile.php"><button>Profile</button></a></div>
                </div>
        </div>

    </nav>
    <div class="container">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input id="name" type="text" name="name" placeholder="Enter Name" required>
        </div>
        <div class="form-group">
            <label for="ticketID">Ticket ID:</label>
            <input id="ticketID" type="text" name="ticketID" placeholder="Enter Ticket ID" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone number:</label>
            <input id="phone" type="text" name="phone" placeholder="Enter Phone number" required>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input id="date" type="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="identificationMarks">Identification Marks:</label>
            <textarea id="identificationMarks" name="identificationMarks" rows="8" cols="38"></textarea>
        </div>
        <div class="form-group">
                <label for="fileName">Ticket Image:</label>
                <input id="fileName" type="file" name="fileName">
            </div>

        <button type="submit" id="complaint" name="complaint" style="background-color: rgb(0, 57, 155); height: 30px; width: 100px">SUBMIT</button>
    </form>
</div>

    </body>
    <footer>
        <div  class="contact">
            <div class="part_1">
                <div>RAILCONNECT+</div>
                <div>contact number</div>
            </div>
            <div class="part_2">
                <h4><b>Our Services</b></h4>
                <ul>
                    <li>Food Orders</li>
                    <li>Report Issue</li>
                    <li>Ticket Booking</li>
                    
                </ul>
            </div>
            <div class="part_3">
                <h4>Useful Links</h4>
                <a href="#"></a>
                <a href="#"></a>
                <a href="#"></a>
            </div>
            <div class="part_4">
                <h3>Follow us</h3>
            </div>
        </div>
    </footer>


</html>
