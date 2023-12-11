<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css"
        integrity="sha512-HXXR0l2yMwHDrDyxJbrMD9eLvPe3z3qL3PPeozNTsiHJEENxx8DH2CxmV05iwG0dwoz5n4gQZQyYLUNt1Wdgfg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-image: url('https://images.unsplash.com/uploads/1413387158190559d80f7/6108b580?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8cmFpbHdheXxlbnwwfHwwfHx8MA%3D%3D');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .message {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .message>button {
            font-size: 26px;
            width: 100px;
            height: 50px;
        }

        h2 {
            text-align: center;
            color: #3498db;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            color: white;
            background-color: #3498db;
        }

        #inbox,
        #exit,
        #luggage {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 24px;
            margin-right: 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        #inbox:hover,
        #exit:hover,
        #luggage:hover {
            background-color: #2980b9;
        }

        #luggage-content {
            display: none;
            float: left;
        }

        #inbox-message {
            display: none;
            float: left;
            margin-top: 20px;
            padding: 20px;
            background-color: rgba(52, 152, 219, 0.8);
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="message">
        <button id='inbox' onclick="toggleInbox()">
            <i class="ri-inbox-line"></i>
        </button>
        <button onclick="logout()" id='exit'>
            <i class="ri-logout-box-r-line"></i>
        </button>
        <a href="#" id="luggage" onclick="toggleLuggage()">Luggage Lost</a>
    </div>
    <div id="inbox-message">
        <!-- Display inbox messages here -->
        <?php
        // Connect to the database and fetch inbox messages
        $db_hostname = "localhost";
        $db_username = "id21110799_railconnect";
        $db_password = "Railconnect+1";
        $db_name = "id21110799_stations";

        $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $inboxQuery = "SELECT * FROM chat WHERE receiver='admin' LIMIT 5";
        $inboxResult = mysqli_query($conn, $inboxQuery);

        if (mysqli_num_rows($inboxResult) > 0) {
            while ($row = mysqli_fetch_assoc($inboxResult)) {
                echo "<p><strong>{$row['sender']}</strong>: {$row['message']}</p>";
            }
        } else {
            echo "<p>No messages in the inbox.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>
    <br><br><br><br><br>
    <h2>Recent Bookings</h2>
    <table border="1">
        <!-- Display recent bookings here -->
        <?php
        $db_hostname = "localhost";
        $db_username = "id21110799_railconnect";
        $db_password = "Railconnect+1";
        $db_name = "id21110799_stations";

        $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
        $currentDate = date("Y-m-d");
        $querya = "DELETE FROM booking WHERE date < $currentDate;";
        mysqli_query($conn, $querya);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $query = "SELECT train_no,ticketid, passenger, id, source, destination FROM booking ORDER BY ticketid DESC LIMIT 10";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['train_no'] . "</td>";
                echo "<td>" . $row['ticketid'] . "</td>";
                echo "<td>" . $row['passenger'] . "</td>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['source'] . "</td>";
                echo "<td>" . $row['destination'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No recent bookings found.</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>

    <div id="luggage-content">
        <!-- Display luggage content here -->
        <?php
        $db_hostname = "localhost";
        $db_username = "id21110799_railconnect";
        $db_password = "Railconnect+1";
        $db_name = "id21110799_stations";

        $conn = new mysqli($db_hostname, $db_username, $db_password, $db_name);

        $sql = "SELECT * FROM luggage";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Name</th><th>Ticket ID</th><th>Phone</th><th>Date</th><th>Identification Marks</th><th>image</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['ticketID'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['identificationMarks'] . "</td>";
                echo "<td><img src='Myfiles/" . $row['image'] . "' width='150' height='150'></td>";

                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No records found.";
        }

        $conn->close();
        ?>
    </div>

    <script>
        function logout() {
            window.location.href = 'logout.php';
        }

        function toggleLuggage() {
            var luggageContent = document.getElementById('luggage-content');
            if (luggageContent.style.display === 'none') {
                luggageContent.style.display = 'block';
            } else {
                luggageContent.style.display = 'none';
            }
        }

        function toggleInbox() {
            var inboxMessage = document.getElementById('inbox-message');
            if (inboxMessage.style.display === 'none') {
                inboxMessage.style.display = 'block';
            } else {
                inboxMessage.style.display = 'none';
            }
        }
    </script>
</body>

</html>
