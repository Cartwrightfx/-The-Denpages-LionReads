<?php
 // Set session cookie lifetime to 30 minutes (adjust as needed)
$sessionLifetime = 2300; // 5 minutes in seconds
session_set_cookie_params($sessionLifetime);
 
// start the session
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
 
// Check if the session expiration time is set
if (isset($_SESSION['expire_time'])) {
  // Check if the session has expired
  if (time() > $_SESSION['expire_time']) {
      // Redirect to logout.php
      header("Location: logout.php");
      exit();
  }
}

// Set the new expiration time
$_SESSION['expire_time'] = time() + $sessionLifetime;

 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=JetBrains Mono">
    <script src="https://kit.fontawesome.com/ff24e75514.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../img/LionReads-logo.png" type="image/x-icon">
    <title>Pending Transactions | LionReads</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: 'JetBrains Mono', monospace;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <!-- Admin Navbar include -->
    <?php include 'adminSidepanel.php';?>

    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Amount</th>
                <th scope="col">Order Number</th>
                <th scope="col">Pickup Status</th>
                <th scope="col">Pickup Location</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../config.php";
            $sql = "SELECT * FROM Transactions WHERE pickup_status = 'incomplete'";
            $result = mysqli_query($con, $sql);
            $rowcount = mysqli_num_rows($result);
            if ($rowcount > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $description = $row['payment_description'];
                    $payment = $row['payment_status'];
                    $amount = $row['amount'];
                    $order_number = $row['order_number'];
                    $pickup_status = $row['pickup_status'];
                    $location = $row['pickup_location'];
                    $date = $row['payment_date'];
                    echo '
            <tr>
                <td>' . $id . '</td>
                <td>' . $name . '</td>
                <td>' . $description . '</td>
                <td>' . $payment . '</td>
                <td>' . $amount . '</td>
                <td>' . $order_number . '</td>
                <td>' . $pickup_status . '</td>
                <td>' . $location .'</td>
                <td>' . $date . '</td>
            </tr>';
                }
            }
            else{
                 echo '<tr><td colspan="10">No pending transactions.</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <script>
        /* Set the width of the sidebar to 250px (show it) */
        function openNav() {
            document.getElementById("mySidepanel").style.width = "75%";
        }
        /* Set the width of the sidebar to 0 (hide it) */
        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
    </script>
</body>
</html>