<?php
session_start();

// Check if the booking was confirmed flag is set. If not, redirect back to CONTACT.php (Step 1).
if (!isset($_SESSION['confirmed']) || $_SESSION['confirmed'] !== true) {
    header("Location: CONTACT.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Successful</title>
    <style>
        /* CSS styling for the success page */
        body {
            font-family: Arial, sans-serif;
            background-color:  #009900; /* Green background */
            padding: 40px;
        }

        .success-box {
            background-color: white;
            max-width: 600px;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 12px lightgreen;
        }

        h2 {
            color: green;
            text-align: center;
        }

        p {
            font-size: 16px;
            margin: 8px 0;
        }

        strong {
            display: inline-block;
            width: 160px;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
        }

        .back-button {
            margin-top: 30px;
            text-align: center;
        }

        .back-button a {
            padding: 10px 25px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .back-button a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="success-box">
    <h2>Your Booking is Confirmed!</h2>

    <p><strong>First Name:</strong> <?= $_SESSION['name'] ?></p>
    <p><strong>Last Name:</strong> <?= $_SESSION['surname'] ?></p>
    <p><strong>Phone:</strong> <?= $_SESSION['phone'] ?></p>
    <p><strong>Room Type:</strong> <?= ucwords($_SESSION['room_type']) ?></p>
    <p><strong>Arrival Date:</strong> <?= $_SESSION['arrival_date'] ?></p>
    <p><strong>Days:</strong> <?= $_SESSION['days'] ?></p>
    <p><strong>Breakfast:</strong> <?= $_SESSION['breakfast'] ?></p>

    <p class="total">Total Cost: <?= number_format($_SESSION['total_cost'], 2) ?> EUR</p>

    <div class="back-button">
        <a href="CONTACT.php">Return to home page</a>
    </div>
     <div class="back-button">
        <a href="LOGINBOOKINGS.php">View Bookings (Admin)</a>
    </div>
</div>

</body>
</html>

<?php
// Destroy all session data after successful display to clear the booking process
session_destroy();
?>