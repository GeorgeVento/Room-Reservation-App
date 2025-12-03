<?php
session_start();

// Check if basic customer details are set in the session. If not, redirect to the contact page (Step 1).
if (!isset($_SESSION['name'], $_SESSION['surname'], $_SESSION['phone'])) {
    header("Location: CONTACT.php");
    exit();
}

$errors = [];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve form data
    $room_type = trim($_POST['room_type'] ?? '');
    $arrival_date = trim($_POST['arrival_date'] ?? '');
    $days = (int)($_POST['days'] ?? 0);
    $breakfast = $_POST['breakfast'] ?? '';

    // Validation checks
    if (empty($room_type)) $errors[] = "Please select a room type.";
    if (empty($arrival_date)) $errors[] = "Please enter an arrival date.";
    if ($days <= 0) $errors[] = "Please enter a valid number of days.";
    if (empty($breakfast)) $errors[] = "Please select if you want breakfast.";

    // If no validation errors, store booking details in the session and proceed to summary (Step 3)
    if (empty($errors)) {
        // Store booking details in the session
        $_SESSION['room_type'] = $room_type;
        $_SESSION['arrival_date'] = $arrival_date;
        $_SESSION['days'] = $days;
        $_SESSION['breakfast'] = $breakfast;

        header("Location: SUMMARY.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Room Booking - Step 2</title>
    <style>
        /* CSS styling for the booking details form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f4f8;
            padding: 30px;
        }

        .box {
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
            display: inline-block;
        }

        form label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="date"],
        form select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-top: 8px;
            margin-bottom: 20px;
        }

        .radio-group label {
            font-weight: normal;
        }

        button {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background-color: #28a745;
            border: none;
            color: white;
            border-radius: 6px;
        }

        button:hover {
            background-color: #218838;
        }

        ul {
            margin-top: 20px;
            color: red;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Booking Details (Step 2 of 3)</h2>

    <p><strong>First Name:</strong> <?= $_SESSION['name'] ?></p>
    <p><strong>Last Name:</strong> <?= $_SESSION['surname'] ?></p>
    <p><strong>Phone:</strong> <?= $_SESSION['phone'] ?></p>

    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $e): ?>
                <li><?= $e ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="" method="post">
        <label for="room_type">Room Type:</label>
        <select name="room_type" id="room_type" required>
            <option value="">-- Select --</option>
            <option value="single" <?= (($_POST['room_type'] ?? '') === 'single') ? 'selected' : '' ?>>Single</option>
            <option value="double" <?= (($_POST['room_type'] ?? '') === 'double') ? 'selected' : '' ?>>Double</option>
            <option value="triple" <?= (($_POST['room_type'] ?? '') === 'triple') ? 'selected' : '' ?>>Triple</option>
            <option value="quad" <?= (($_POST['room_type'] ?? '') === 'quad') ? 'selected' : '' ?>>Quad</option>
        </select>

        <label for="arrival_date">Arrival Date:</label>
        <input type="date" id="arrival_date" name="arrival_date" value="<?= $_POST['arrival_date'] ?? '' ?>" required>

        <label for="days">Number of Days:</label>
        <input type="number" id="days" name="days" min="1" value="<?= $_POST['days'] ?? '' ?>" required>

        <label>Breakfast:</label>
        <div class="radio-group">
            <label>
                <input type="radio" name="breakfast" value="YES" <?= (($_POST['breakfast'] ?? '') === 'YES') ? 'checked' : '' ?> required> YES
            </label>
            <label>
                <input type="radio" name="breakfast" value="NO" <?= (($_POST['breakfast'] ?? '') === 'NO') ? 'checked' : '' ?>> NO
            </label>
        </div>

        <button type="submit">Next</button>
    </form>
</div>
</body>
</html>