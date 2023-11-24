<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
<?php
  include 'Finance.php';
  if (!isset($_SESSION['UserLogin'])) {
    $_SESSION['notification'] = "Need to login first";
    header("location: Index.php", true, 301);
    exit();
}
?>


<h2>History Transaction Menu</h2>

<table>
  <thead>
    <th>Time</th>
    <th>Type</th>
    <th>Debit</th>
    <th>Credit</th>
    <th>Balance</th>
    <th>Description</th>

  </thead>
  <tbody>
  
<?php
$financialStatement = $_SESSION['UserLogin'];
foreach ($financialStatement->showTransactionHistory() as $transaction) 
{
?>
  <tr>
    <td><?=$transaction['time']?></td>
    <td><?=$transaction['type']?></td>
    <td><?=$transaction['debit']?></td>
    <td><?=$transaction['credit']?></td>
    <td><?=$transaction['balance']?></td>
    <td><?=$transaction['description']?></td>
  </tr>
<?php
}
?>
  
  </tbody>
  
</table>


<br>
<button  onclick="window.location.href = 'Main.php'">Back to Main</button>
</body>
</html>

