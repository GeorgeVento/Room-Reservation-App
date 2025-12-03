<?php
session_start();
?>

<?php if (isset($_GET['canceled'])): ?>
    <div style="background: #ffdddd; color: #a94442; border: 1px solid #a94442; padding: 12px; margin-bottom: 20px; border-radius: 6px; text-align: center;">
        The booking was canceled.
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Customer Contact Form</title>

    <style>
        /* CSS styles for the contact form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f4f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 300px;
            background: white;
            margin: 60px auto;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #007BFF;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        ul {
            margin-top: 20px;
            color: red;
        }

        li {
            font-size: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Customer Details (Step 1 of 3)</h2>

    <form action="" method="post">
        <input type="text" name="name" placeholder="First Name" required>
        <input type="text" name="surname" placeholder="Last Name" required>
        <input type="text" name="phone" placeholder="Phone Number (10 digits)" maxlength="10" minlength="10" required>
        <input type="submit" name="submit" value="Next">
    </form>

    <?php
    // Check if the form has been submitted
    if (isset($_POST['submit'])) {
        // Sanitize and retrieve form data
        $name = ($_POST['name']);
        $surname = ($_POST['surname']);
        $phonenum = ($_POST['phone']);
        $errors = [];

        // Validation checks for empty fields
        if (empty($name)) {
            $errors[] = "The First Name field is empty!";
        }
        if (empty($surname)) {
            $errors[] = "The Last Name field is empty!";
        }
        if (empty($phonenum)) {
            $errors[] = "The Phone Number field is empty!";
        }

        // If no validation errors, store data in session and redirect to the next step
        if (empty($errors)) {
            $_SESSION['name'] = $name;
            $_SESSION['surname'] = $surname;
            $_SESSION['phone'] = $phonenum;

            header("Location: DETAILS.php");
            exit();
        } else {
            // Display validation errors
            echo "<ul>";
            foreach ($errors as $msg) {
                echo "<li>$msg</li>";
            }
            echo "</ul>";
        }
    }
    ?>
</div>

</body>
</html>