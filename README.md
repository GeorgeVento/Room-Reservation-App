# 🏨 Hotel Booking Web App

This project is a multi-step web application for processing hotel room reservations. It uses a session-based approach to guide the user through the booking process (details, room choice, summary) and then records the final reservation in a MySQL database. It includes a separate, simple administrator login to view the list of all successful bookings.

🛠️ **Technologies**

* **PHP:** Manages all application logic, session handling, form validation, and database interaction (MySQLi).
* **HTML:** Structures the booking forms, summary pages, and the administrator's booking list.
* **CSS:** Provides simple, clean styling for the user interface.
* **MySQL:** (Assumed) Used for the backend database to store booking records, accessible via PHP's MySQLi extension.

📦 **Content**

* **`CONTACT.php`** — Step 1: Collects the customer's personal details (First Name, Last Name, Phone).
* **`DETAILS.php`** — Step 2: Collects the booking details (Room Type, Arrival Date, Days of stay, Breakfast option).
* **`SUMMARY.php`** — Step 3: Displays the final summary and calculates the total cost. Allows the user to confirm or cancel the booking.
* **`SUCCESS.php`** — The final confirmation page, displayed after the booking is successfully stored in the database.
* **`LOGINBOOKINGS.php`** — The administrative login page to access the list of all bookings.
* **`BOOKINGS.php`** — The administrator view that fetches and displays all booking records from the database.

🧮 **Functionality**

The application provides a three-step booking flow and an administrative view:

* **✔️ Session-Based Flow**
    The user is guided sequentially through the `CONTACT -> DETAILS -> SUMMARY -> SUCCESS` pages, with session variables ensuring data persists between steps.

* **✔️ Input Validation**
    Basic validation is performed on customer and booking details before proceeding to the next step.

* **✔️ Cost Calculation**
    The total cost is calculated in `SUMMARY.php` based on hardcoded room prices and a daily breakfast fee.

* **✔️ Database Storage**
    Confirmed bookings are securely inserted into the `bookings` table in the database.

* **✔️ Admin Access**
    A simple login (`LOGINBOOKINGS.php`) using hardcoded credentials allows access to the list of all reservations (`BOOKINGS.php`).

🚀 **Execution Guide**

This project requires a PHP-enabled web server (like Apache or Nginx) with a MySQL database setup.

**Steps:**
1.  **Set up Database:** Create a database named **`hotel`** and a table named **`bookings`** (you will need to ensure your table structure supports the data fields used in `SUMMARY.php`).
2.  **Place Files:** Ensure all PHP files are placed in the root directory of your web server.
3.  **Configure PHP:** Ensure the database connection details (`localhost`, `root`, ``, `hotel`) in `BOOKINGS.php` and `SUMMARY.php` match your local environment.
4.  **Start Booking:** Navigate to **`CONTACT.php`** in your browser to start a new reservation.
5.  **Admin Access:** Navigate to **`LOGINBOOKINGS.php`** and use the credentials (**Username:** `HotelHost`, **Password:** `HotelCalifornia`) to view the bookings list.

👤 **Creator**

George-Leonidas Ventouratos