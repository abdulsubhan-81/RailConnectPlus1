<html>
    <head>
        <title>IRCTC Home</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <link rel="stylesheet" href="irctc.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" integrity="sha512-HXXR0l2yMwHDrDyxJbrMD9eLvPe3z3qL3PPeozNTsiHJEENxx8DH2CxmV05iwG0dwoz5n4gQZQyYLUNt1Wdgfg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    </head>
    <nav>
        <div class="intro">
                <div class="intro">
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/8/83/Indian_Railways.svg/640px-Indian_Railways.svg.png" width="75px" height="75px">
                    <b style="font-size:26px;padding:10px;">RailConnect+</b>
                </div>
                <div class="intro">
                        <div><button onclick="view()">Services</button></div>
                        <div><a href="bookings.php"><button>My Bookings</button></a></div>
                        <div><a href="book.php"><button>Book Ticket</button></a></div>
                        <div><a href="profile.php"><button>Profile</button></a></div>
                </div>
        </div>
    </nav>
    <body>
        <div class="content">
            <form class="search" method="POST">
                <div><h3>Train Search</h3></div>
                <div><input type="text" name="source" placeholder="Enter Source station"></div>
                <div><input type="text" name="destination" placeholder="Enter Destination"></div>
                <div><button>Search</button></div>
            </form>
        </div>
    </body>
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
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $source = $_POST['source'];
                $destination = $_POST['destination'];
                $source = mysqli_real_escape_string($conn, $source);
                $destination = mysqli_real_escape_string($conn, $destination);

                $sql = "SELECT * FROM $source s JOIN $destination d ON s.train_number = d.train_number";
                $sqla="SELECT * FROM $destination d JOIN $source s ON s.train_number = d.train_number";

                $result = mysqli_query($conn, $sql);
                $resulta=mysqli_query($conn, $sqla);

                if (!$result) {
                    echo "Error: " . mysqli_error($conn);
                    exit;
                }

                echo "<div id='result'><div style='font-size:35px;'>Train Information:</div><b><br/><div style='font-size:40px;'>". $source."  ➔  ".$destination."</b></div>";
        while ($row = mysqli_fetch_assoc($result) and $rowa=mysqli_fetch_assoc($resulta)) {
            echo "<div id='trains'>
            <div>
                <div>
                    <h3>{$row['train_number']}</h3>
                </div>
                <div>
                    <h3>{$row['train_name']}</h3>
                </div>
            </div>
            <div>
                <div>
                    <b>Arrival:&nbsp</b>{$row['arr_time']}
                </div>
                <div>
                    <b>Departure:&nbsp</b>{$rowa['dept_time']}
                </div>
            </div>
            <div>
                    <div>
                        <b>SL/FC/Gen/CC</b>
                    </div>
                    <a href='book.php?source={$source}&destination={$destination}&train_number={$row['train_number']}'>
<button>Book➔</button></a>
            </div>
            </div>
            ";
        }

    
            } 
            
            mysqli_close($conn);
            ?>
    <footer>
        <div  class="contact" id="services">
            <div class="part_1">
                <div>RAILCONNECT+</div>
                <div><a href="mailto:railway.help@gmail.com"><i class="ri-mail-line"></i>email</a></div>
                <div><a href="tel:+1234567890"><i class="ri-customer-service-line"></i>customer support</a></div>
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
                <div><i class="ri-instagram-line"></i><div>
            </div>
        </div>
    </footer>
    <script type="text/javascript">
    window.onload = function() {
        var resultSection = document.getElementById('result');
        if (resultSection) {
            resultSection.scrollIntoView({ behavior: 'smooth' });
        }
    };
    function view(){
        var Section = document.getElementById('services');
        if (Section) {
            Section.scrollIntoView({ behavior: 'smooth' });
        }
    }
    
</script>
    
</html>




