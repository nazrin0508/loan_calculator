CREATE DATABASE IF NOT EXISTS loan_db;
USE loan_db;

CREATE TABLE IF NOT EXISTS loan_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    loan_amount INT NOT NULL,
    interest_rate INT NOT NULL,
    months INT NOT NULL,
    monthly_interest FLOAT NOT NULL,
    monthly_payment FLOAT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
