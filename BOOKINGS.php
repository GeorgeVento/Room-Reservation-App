<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Bookings</title>
    <style>
        /* CSS styling for the bookings table page */
        body {
            font-family: sans-serif;
            background-color: #eef2f3;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1000px;
        }

        h2 {
            text-align: center;
            margin-top: 0;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f7f7f7;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: white;
            background-color: #3498db;
            padding: 8px 16px;
            border-radius: 4px;
        }

        a:hover {
            background-color: #2980b9;
        }

        .link-center {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>List of Bookings</h2>
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Room</th>
            <th>Arrival</th>
            <th>Days</th>
            <th>Breakfast</th>
            <th>Cost</th>
        </tr>
        <?php
        // Database connection setup
        $conn = new mysqli("localhost", "root", "", "hotel");
        
        // Fetch records from the 'bookings' table, ordered by ID descending
        $result = $conn->query("SELECT * FROM bookings ORDER BY id DESC");
        
        // Loop through the results and display each booking as a table row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["first_name"]."</td>";
            echo "<td>".$row["last_name"]."</td>";
            echo "<td>".$row["phone"]."</td>";
            echo "<td>".$row["room_type"]."</td>";
            echo "<td>".$row["arrival_date"]."</td>";
            echo "<td>".$row["days"]."</td>";
            // Display 'YES' if 'breakfast' is true (1), 'NO' otherwise (0)
            echo "<td>".($row["breakfast"] ? "YES" : "NO")."</td>";
            echo "<td>".$row["total_cost"]." €</td>";
            echo "</tr>";
        }
        // Close the database connection
        $conn->close();
        ?>
    </table>
    <div class="link-center">
        <a href="CONTACT.php">New Booking</a>
    </div>
</div>
</body>
</html>