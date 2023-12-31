<?php session_start() ?>
<?php include "functions.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Website</title>
    <!--Link to CSS-->
    <link rel="stylesheet" href="updated.css">
    <!--Box Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

</head>
<body>
    <!-- Header -->
    <header>
        <a href="index.php" class="logo">Cars<span>GO</span></a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="reservation.php">Reservation</a></li>
            <li><a href="record.php">Records</a></li>
        </ul>
        <!-- Drop down menu -->
        <?php
        // Check if user is logged in and retrieve user information
        if (isset($_SESSION['username'])) {
            $mysqli = new mysqli('localhost', 'root', '', 'COMP1044_database');
            $username = $_SESSION['username'];
            $sql = "SELECT * FROM staff WHERE username='$username'";
            $result = $mysqli->query($sql);
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $username = $row['username'];
                $staff_ID = $row['staff_ID'];
                $position = $row['position'];
                $contact_no = $row['contact_no'];
            }
            $mysqli->close();
        }
        ?>
        <div class="header-btn">
          <a href="#" class="profile-btn"><i class="bx bxs-user" onclick="toggleMenu()"></i></a>
        </div>
    </div>
    <div class="sub-menu-wrap" id="subMenu">
    <div class="sub-menu">
        <div class="user-info">
            <img src="user_img/profile.png">
            <?php        
            // Check if user is logged in and retrieve user information
            if (isset($_SESSION['username'])) {
                $mysqli = new mysqli('localhost', 'root', '', 'COMP1044_database');
                $username = $_SESSION['username'];
                $sql = "SELECT * FROM staff WHERE username='$username'";
                $result = $mysqli->query($sql);
                if ($result->num_rows === 1) {
                    $row = $result->fetch_assoc();
                    $fname = $row['first_name'];
                    $lname = $row['last_name'];
                    $staff_ID = $row['staff_ID'];
                    $position = $row['position'];
                    $contact_no = $row['contact_no'];
                    echo "<h4>$username</h4>";
                    echo "<h6>Name:<span>$fname $lname</span></h6>";
                    echo "<h6>Staff ID:<span>$staff_ID</span></h6>";
                    echo "<h6>Position:<span>$position</span></h6>";
                    echo "<h6>Contact No: <span>$contact_no</span></h6>";
                }
                $mysqli->close();
                ?>
                <hr>
                <form action="logout.php" method="post">
                    <button type="submit" class="sub-menu-link" name="logout">
                        <img src="user_img/logout.png">
                        <p>Logout</p>
                        <span> > </span>
                    </button>
                </form>
                <?php
            } else {
                // User is not logged in, display default text
                echo '<a href="login.php" class="login-link"><h5>Login</h5></a>';
            }
            ?>
        </div>
    </div>
</div>
    </header>

    <!-- Main page -->
    <section class="main" id="main">
        <div class="heading">
            <span>How It Works</span>
            <h1>Select Your Course of Actions</h1>
        </div>
        <div class="main-container">
            <a href="reservation.php">
                <div class="box">
                    <i class="bx bxs-car"></i>
                    <h2>Make New Reservation</h2>
                </div>
            </a>

            <a href="update.php" id="open-popup-btn-change">  
                <div class="box">
                    <i class="bx bxs-calendar-check"></i>
                    <h2>Change/Update Reservation</h2>
        
                </div>
            </a>

            <a href="delete.php" id="open-popup-btn">
                <div class="box">
                    <i class="bx bxs-calendar-star"></i>
                    <h2>Cancel Reservation</h2>
                </div>
            </a>
        </div>
    </section>

    <!-- Update Form -->
    <div class="popup-delete center">
    <div class="close-icon"><a href="index.php">&#x2715;</a></div>
    <h2>Cars<span>GO</span></h2>
    <div class="title">
      Reservation Updated!
    </div>
    <!-- Notify the user on the newly updated dates -->
    <div class="description">
        <input type="hidden" name="reservation-id" value="<?php echo $reservation['reservation_ID']?>"></input>
        <div class="description-inner">
            <h3>Updated Pickup Date</h3>
            <p><?php echo $_SESSION['pickup_date']?></p>
        </div>
        <div class="description-inner"> 
            <h3>Updated Dropoff Date</h3>
            <p><?php echo $_SESSION['dropoff_date']?></p>
        </div>
  </div>
    
    <!-- ScollReveal -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <!-- Link to JS -->
    <script src="script2.js"></script>
</body>
</html>