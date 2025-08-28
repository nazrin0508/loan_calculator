# loan_calculator

"A simple PHP &amp; Bootstrap web app to calculate monthly loan payments with validation."

💰 Loan Monthly Payment Calculator (PHP + MySQL)

    A simple web-based Loan Calculator built with PHP, MySQL, Bootstrap, and JavaScript.
    It allows users to input loan details and calculate the monthly payment, while also saving each calculation to a MySQL database for history tracking.

🚀 Features

    *   Input loan amount, interest rate, and repayment months.

    *   Validation: all fields are mandatory & numeric.

    *   Alerts user if fields are empty.

    *   Calculates Monthly Payment using the formula:

            ->  monthly_interest = (loan_amount * interest_rate) / (100 * months)

            ->  monthly_payment = (loan_amount / months) + monthly_interest

    *   Saves each calculation in the database.

    *   Displays a calculation history table with loan details and results.

    *   Responsive UI designed with Bootstrap 5 + custom CSS.

🛠️ Technologies Used

    *   PHP (Backend processing)

    *   MySQL (Database Storage)

    *   HTML, CSS, JavaScript (Frontend)

    *   Bootstrap 5 (UI styling)

    *   XAMPP / WAMP / LAMP – local development environment

📂 Project Structure

    loan_calculator/
    │── assets/
    │   └── css/
    │       └── style.css        # Custom styles
    |── dbconn.php               # Backend PHP script for DB insert
    │── loan_db.sql              # MySQL database setup
    │── index.php                # Main application file (form + history table)
    │── save_loan.php            # Handles saving loan calculations into DB
    │── README.md                # Documentation

🛠️ Setup Instructions

    1️⃣ Prerequisites

        *   PHP 8+

        *   MySQL 5.7+ / MariaDB

        *   Web server (XAMPP / WAMP / LAMP / MAMP)

    2️⃣ Database Setup

        1.   Create a database, e.g. loan_app.

        2.   Import the SQL from db.sql:

                CREATE TABLE loan_records (
                id INT AUTO_INCREMENT PRIMARY KEY,
                loan_amount INT NOT NULL,
                interest_rate INT NOT NULL,
                months INT NOT NULL,
                monthly_payment DECIMAL(10,2) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                );

        3.     Include your DB credentials i.e. dbconn.php file in save_loan.php:

                    $host = "localhost";
                    $user = "root";
                    $pass = "";
                    $dbname = "loan_db";

    3️⃣ Run Project

        *   Place the project folder in your server root (htdocs for XAMPP).

        *   Start Apache & MySQL.

        *   Open in browser:

            http://localhost/loan_calculator/


📜 License

    This project is for educational purposes only.            
