<?php
require 'dbconn.php';

// Create table if not exists
$pdo->exec("CREATE TABLE IF NOT EXISTS loan_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    loan_amount INT NOT NULL,
    interest_rate INT NOT NULL,
    months INT NOT NULL,
    monthly_interest FLOAT NOT NULL,
    monthly_payment FLOAT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Fetch past results
$stmt = $pdo->query("SELECT * FROM loan_records ORDER BY created_at DESC");
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Loan Monthly Payment Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">

<div class="container py-4">
    <h1 class="text-center mb-4">Loan Monthly Payment Calculator</h1>

    <!-- Form Card -->
    <div class="card shadow-sm p-4 mb-4">
        <form id="loanForm" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Loan Amount</label>
                <input type="number" id="loan_amount" name="loan_amount" class="form-control" placeholder="Enter amount" min="1" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Interest Rate (%)</label>
                <input type="number" id="interest_rate" name="interest_rate" class="form-control" placeholder="Enter rate" min="1" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Months to Pay</label>
                <input type="number" id="months" name="months" class="form-control" placeholder="Enter months" min="1" required>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary px-4 mt-2">Calculate Monthly Payment</button>
            </div>
        </form>
        <div id="result" class="alert alert-info text-center mt-3 d-none"></div>
    </div>

    <!-- History Table -->
    <div class="card shadow-sm p-3">
        <h4 class="mb-3">Past Loan Calculations</h4>
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Loan Amount</th>
                        <th>Interest Rate (%)</th>
                        <th>Months</th>
                        <th>Monthly Interest</th>
                        <th>Monthly Payment</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $row): ?>
                    <tr>
                        <td>₹<?= number_format($row['loan_amount']) ?></td>
                        <td><?= $row['interest_rate'] ?></td>
                        <td><?= $row['months'] ?></td>
                        <td>₹<?= number_format($row['monthly_interest'], 2) ?></td>
                        <td>₹<?= number_format($row['monthly_payment'], 2) ?></td>
                        <td><?= $row['created_at'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($records)): ?>
                    <tr><td colspan="6">No records found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.getElementById("loanForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let loan_amount = document.getElementById('loan_amount').value;
    let interest_rate = document.getElementById('interest_rate').value;
    let months = document.getElementById('months').value;

    if (!loan_amount || !interest_rate || !months) {
        alert("All fields are mandatory.");
        return;
    }

    let formData = new FormData();
    formData.append("loan_amount", loan_amount);
    formData.append("interest_rate", interest_rate);
    formData.append("months", months);

    fetch("save_loan.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        let resultDiv = document.getElementById("result");
        resultDiv.innerHTML = data;
        resultDiv.classList.remove("d-none");
        setTimeout(() => location.reload(), 1500);
    });
});
</script>

</body>
</html>
