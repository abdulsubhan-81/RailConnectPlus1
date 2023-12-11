<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" integrity="sha512-HXXR0l2yMwHDrDyxJbrMD9eLvPe3z3qL3PPeozNTsiHJEENxx8DH2CxmV05iwG0dwoz5n4gQZQyYLUNt1Wdgfg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .intro {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            background-image: linear-gradient(45deg, rgb(0, 128, 128), rgb(0, 80, 155));
            align-items: center;
            padding: 10px;
            background-color: #333;
            color: white;
        }

        .navigation_bar {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: none;
            color: white;
        }

        .navigation_bar button {
            width: 120px;
            height: 40px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            background-color: inherit;
            color: white;
            border-radius: 5px;
            margin: 5px;
        }

        .navigation_bar button:hover {
            border: solid 1px white;
        }

        .chat {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .chat h1 {
            text-align: center;
            color: #333;
        }

        .chat button {
            width: 100%;
            height: 40px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            margin: 10px 0;
            cursor: pointer;
        }

        .message-box {
            display: none;
        }

        a {
            color: white;
            text-decoration: none;
        }

        a:hover {
            color: red;
            text-decoration: none;
        }

        .message-box textarea {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .message-box button {
            width: 100%;
            height: 40px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .contact {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: #333;
            color: white;
            padding: 20px;
            margin-bottom: 0px;
        }

        .contact div {
            text-align: center;
        }

        .part_2 ul {
            list-style: none;
            padding: 0;
        }

        .part_2 ul li {
            margin: 5px 0;
        }

        .part_3 a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 5px 0;
        }

        .part_4 h3 {
            margin: 0;
        }

        #note {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 0px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            position: fixed;
            top: 10px;
            right: 10px;
        }

        #note i {
            font-size: 24px;
        }
    </style>
    <title>Help Desk</title>
</head>

<body>

    <div class="intro">
        <div style="display:inline">
            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/8/83/Indian_Railways.svg/640px-Indian_Railways.svg.png" width="75px" height="75px">
            <b style="font-size:26px;padding:10px;position:relative;top:-20px;">RailConnect+</b>
        </div>
        <div class="navigation_bar">
            <div><a href="miniproject.php"><button>Home</button></a></div>
            <div><a href="bookings.php"><button>My Bookings</button></a></div>
            <div><a href="profile.php"><button>My Profile</button></a></div>
            <div><a href="book.php"><button>Book Ticket</button></a></div>
        </div>
    </div>
    <button id='note'><i class="ri-notification-line"></i></button>
    <div class="chat">
        <h1>Help Desk</h1>
        <div><a href="luggage.html"><button>Luggage Lost</button></a></div>
        <div><button>Payment Failure</button></div>
        <div><button>Report harassment and misbehavior</button></div>
        <div><button onclick="showMessageBox()">Can't Find a Solution</button></div>
        <form id="messageForm" method="post">
            <div class="message-box" id="messageBox">
                <textarea id="user-message" name="user-message" placeholder="Type your message..." rows="4" cols="50"></textarea>
                <button type="button" onclick="sendMessage()">Send</button>
            </div>
        </form>

        <!-- Display the chat conversation -->
        <div id="conversation"></div>
    </div>

    <script>
        function showMessageBox() {
            const messageBox = document.getElementById('messageBox');
            messageBox.style.display = messageBox.style.display === 'block' ? 'none' : 'block';
        }

        function sendMessage() {
            console.log('sendMessage function called');
            const messageInput = document.getElementById('user-message');
            const conversation = document.getElementById('conversation');

            const messageText = messageInput.value.trim();

            if (messageText === '') return;

            const messageDiv = document.createElement('div');
            messageDiv.className = 'message user';
            messageDiv.innerText = messageText;

            conversation.appendChild(messageDiv);
            messageInput.value = '';
            conversation.scrollTop = conversation.scrollHeight;

            // Send the message to the server using AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true); // Empty string indicates the current page
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            const params = `user-message=${encodeURIComponent(messageText)}`;
            xhr.send(params);

            xhr.onload = function () {
                // Handle the server response if needed
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                }
            };

            // For demonstration purposes, simulate an admin response after a delay
            setTimeout(() => {
                const adminMessageDiv = document.createElement('div');
                adminMessageDiv.className = 'message admin';
                adminMessageDiv.innerText = 'Thank you for your message! Our team will get back to you shortly.';
                conversation.appendChild(adminMessageDiv);
                conversation.scrollTop = conversation.scrollHeight;
            }, 500);
        }
    </script>

    <?php
    $db_hostname = "localhost";
    $db_username = "id21110799_railconnect";
    $db_password = "Railconnect+1";
    $db_name = "id21110799_stations";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $fromUser = $_SESSION['user'];
        $toUser = "admin";
        $message = mysqli_real_escape_string($conn, $_POST['user-message']);

        $insertQuery = "INSERT INTO chat (sender, message, receiver) VALUES ('$fromUser', '$message', '$toUser')";

        if (mysqli_query($conn, $insertQuery)) {
            echo 'Message inserted successfully';
        } else {
            echo 'error' . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    ?>
</body>

<footer>
    <div class="contact" id="services">
        <div class="part_1">
            <div>RAILCONNECT+</div>
            <div>contact:<a href="mailto:railway.help@gmail.com"><i class="ri-mail-line"></i></a></div>
        </div>
        <div class="part_2">
            <h4><b>Our Services</b></h4>
            <ul>
                <li><a href="http://mj3prem.000webhostapp.com/GOFOOD.html">Food Orders</a></li>
                <li><a href="luggage.php">Luggage Lost</a></li>
                <li><a href="Help.php">Report Issue</a></li>
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
            <div><i class="ri-instagram-line"></i></div>
        </div>
    </div>
</footer>

</html>
