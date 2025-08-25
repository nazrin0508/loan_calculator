<?php
require 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loan_amount = (int) $_POST['loan_amount'];
    $interest_rate = (int) $_POST['interest_rate'];
    $months = (int) $_POST['months'];

    if ($loan_amount <= 0 || $interest_rate <= 0 || $months <= 0) {
        echo "All fields are mandatory and must be positive numbers.";
        exit;
    }

    // Calculate monthly interest
    $monthly_interest = ($loan_amount * $interest_rate) / (100 * $months);

    // Calculate monthly payment
    $monthly_payment = ($loan_amount / $months) + $monthly_interest;

    // Insert into DB
    $stmt = $pdo->prepare("INSERT INTO loan_records 
        (loan_amount, interest_rate, months, monthly_interest, monthly_payment) 
        VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$loan_amount, $interest_rate, $months, $monthly_interest, $monthly_payment]);

    echo "Your Monthly Payment is <b>₹" . number_format($monthly_payment, 2) . "</b>";
}
?>
