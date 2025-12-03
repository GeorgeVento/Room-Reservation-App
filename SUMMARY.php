<?php
session_start();

// Check that all necessary session variables for the booking steps are present. If not, redirect to Step 2.
if (!isset($_SESSION['name'], $_SESSION['surname'], $_SESSION['phone'],
          $_SESSION['room_type'], $_SESSION['arrival_date'], $_SESSION['days'], $_SESSION['breakfast'])) {
    header("Location: DETAILS.php");
    exit();
}

// Check if the Confirm button was clicked
if (isset($_POST['confirm'])) {
    // Database connection setup
    $conn = new mysqli("localhost", "root", "", "hotel");
    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

    // Convert 'YES'/'NO' to 1/0 for database storage
    $breakfast_db = ($_SESSION['breakfast'] === 'YES') ? 1 : 0;

    // Room price list (per night)
    $room_prices = [
        'single'   => 50.00,
        'double'     => 80.00,
        'triple'    => 100.00,
        'quad'  => 150.00
    ];

    $breakfast_price_per_day = 10.00;
    $room_type = $_SESSION['room_type'];
    $days = $_SESSION['days'];

    // Input validation for room type
    if (!isset($room_prices[$room_type])) {
        die("Unknown room type.");
    }

    // Calculate total cost
    $base_cost = $room_prices[$room_type] * $days;
    $breakfast_cost = $breakfast_db ? ($breakfast_price_per_day * $days) : 0;
    $total_cost = $base_cost + $breakfast_cost;

    // Prepare SQL statement to insert the booking record
    $stmt = $conn->prepare("INSERT INTO bookings (first_name, last_name, phone, room_type, arrival_date, days, breakfast, total_cost) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    // Bind parameters: ssssiiid = string, string, string, string, string, integer, integer, double
    $stmt->bind_param("sssssiid", $_SESSION['name'], $_SESSION['surname'], $_SESSION['phone'], $room_type, $_SESSION['arrival_date'], $days, $breakfast_db, $total_cost);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['confirmed'] = true; // Set flag for success page access
        $_SESSION['total_cost'] = $total_cost; // Store total cost
        header("Location: SUCCESS.php");
        exit();
    } else {
        // Handle database insertion failure
        $error = "Registration failed.";
    }

    $stmt->close();
    $conn->close();
}

// Check if the Cancel button was clicked
if (isset($_POST['cancel'])) {
    session_unset(); // Clear all session variables
    $canceled = true; 
    header("Location: CONTACT.php?canceled=1"); // Redirect back to Step 1 with a canceled flag
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Summary</title>
    <style>
        /* CSS styling for the booking summary page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f4f8;
            padding: 30px;
        }

        .summary-box {
            background: white;
            max-width: 500px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
        }

        strong {
            width: 140px;
        }

        .confirm-button {
            margin-top: 30px;
            text-align: center;
        }

        .confirm-button button {
            background-color: #28a745;
            color: white;
            padding: 12px 30px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
        }

        .confirm-button button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<?php if (isset($canceled) && $canceled): ?>
    <div style="background: #ffdddd; color: #a94442; border: 1px solid #a94442; padding: 12px; margin-bottom: 20px; border-radius: 6px; text-align: center;">
        The booking was canceled.
    </div>
<?php endif; ?>

<?php if (!isset($canceled) || !$canceled): ?>
<div class="summary-box">
    <h2>Booking Summary (Step 3 of 3)</h2>
    <p><strong>First Name:</strong> <?= $_SESSION['name'] ?></p>
    <p><strong>Last Name:</strong> <?= $_SESSION['surname'] ?></p>
    <p><strong>Phone:</strong> <?= $_SESSION['phone'] ?></p>
    <p><strong>Room Type:</strong> <?= ucwords($_SESSION['room_type']) ?></p>
    <p><strong>Arrival Date:</strong> <?= $_SESSION['arrival_date'] ?></p>
    <p><strong>Days:</strong> <?= $_SESSION['days'] ?></p>
    <p><strong>Breakfast:</strong> <?= $_SESSION['breakfast'] ?></p>

    <form method="post" class="confirm-button">
        <button type="submit" name="confirm">Confirm</button>
        <button type="submit" name="cancel" style="background-color: #dc3545; margin-left: 10px;">Cancel</button>
    </form>

    <?php if (isset($error)): ?>
        <p style="color: red; text-align:center; margin-top:20px;"><?= $error ?></p>
    <?php endif; ?>
</div>
<?php endif; ?>
</body>
</html>