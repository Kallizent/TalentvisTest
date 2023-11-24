<!DOCTYPE html>
<html>
<body>
<?php

include 'Finance.php';
?>
<h1>Silahkan memilih proses</h1>

<ol>
  <li><button  onclick="window.location.href = 'deposit.php'">Deposit</button></li> <br>

  <li><button  onclick="window.location.href = 'Withdraw.php'">Withdraw</button></li> <br>

  <li><form method="post">
          <input type="hidden" name="action" value="check_balance">
          <button type="submit">Check Balance</button>
      </form>
  </li><br>
  <li><button  onclick="window.location.href = 'History.php'">Check History Transaction</button></li> <br>
</ol>

<br>

<?php
if (isset($_SESSION['notification'])) {
?>
<h2><?=$_SESSION['notification']?></h2>

<?php 
unset($_SESSION['notification']);
}
?>

</body>
</html>