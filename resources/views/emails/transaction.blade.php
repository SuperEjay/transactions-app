<!DOCTYPE html>
<html>

<head>
    <title>Transaction Logs - Email</title>
</head>

<body>
    <p>Hello, {{ $customers }}</p>
    <p>Thank you for your transaction, here are the details:</p>

    <p>Transaction Type: {{ $transactionTypes }}</p>
    <p>Transaction Date: {{ $transactionDate }}</p>
    <p>Transaction Amount: Php {{ $transactionAmount }}</p>
</body>
