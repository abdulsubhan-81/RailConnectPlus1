<?php
session_start();
$email = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            height: 100vh;
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

        .ticket {
            width: 60%;
            margin: 20px auto;
            background-color: #d8bfd8;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
        }

        .ticket-header {
            text-align: center;
            padding: 20px 0;
        }

        .ticket-header h2 {
            font-size: 24px;
            color: #fff; /* Set text color to white to contrast with the logo */
        }

        .ticket-content {
            margin-top: 20px;
        }

        .ticket-content p {
            margin: 10px 0;
        }

        .download-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            margin: 0 auto;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        footer a {
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="intro">
        <div>
            <h2>RailConnect+</h2>
        </div>
    </div>

    <?php
    if (isset($_GET['ticketId'])) {
        $ticketId = $_GET['ticketId'];

        $db_hostname = "localhost";
        $db_username = "id21110799_railconnect";
        $db_password = "Railconnect+1";
        $db_name = "id21110799_stations";
        $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

        if (!$conn) {
            echo "Failed to connect: " . mysqli_connect_error();
            exit;
        }

        $query = "SELECT * FROM booking WHERE ticketid = '$ticketId' ";

        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $rowa = mysqli_fetch_assoc($result);
    ?>
                <div class="ticket">
                    <div class="ticket-header">
                        <h2>Ticket</h2>
                    </div>
                    <div class="ticket-content">
                        <p><strong>Ticket ID:</strong> <?php echo $rowa['ticketid']; ?></p>
                        <p><strong>Date:</strong> <?php echo $rowa['date']; ?></p>
                        <p><strong>Train No:</strong> <?php echo $rowa['train_no']; ?></p>
                        <p><strong>Source:</strong> <?php echo $rowa['source']; ?></p>
                        <p><strong>Destination:</strong> <?php echo $rowa['destination']; ?></p>
                        <p><strong>Passenger:</strong> <?php echo $rowa['passenger']; ?></p>
                        <p><strong>Age:</strong> <?php echo $rowa['age']; ?></p>
                        <p><strong>Gender:</strong> <?php echo $rowa['gender']; ?></p>
                    </div>
                </div>

                <button class="download-button" onclick="downloadTicket()">Download Ticket</button>

                <footer>
                    <p>RAILCONNECT+ | Contact: <a href="mailto:railway.help@gmail.com">railway.help@gmail.com</a></p>
                </footer>

                <script>
                    function downloadTicket() {
                        const ticketContent = document.querySelector('.ticket-content').outerHTML;
                        const blob = new Blob([ticketContent], {
                            type: 'text/html'
                        });

                        const a = document.createElement('a');
                        a.href = window.URL.createObjectURL(blob);
                        a.download = 'ticket.html';

                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                    }
                </script>

            <?php
            } else {
                echo "Ticket not found for the provided ID or unauthorized access.";
            }
        } else {
            echo "Debug: Query execution failed - " . mysqli_error($conn) . "<br>";
        }

        mysqli_close($conn);
    } else {
        echo "Debug: No ticket ID found in URL.<br>";
    }
    ?>
</body>

</html>
