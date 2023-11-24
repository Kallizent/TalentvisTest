<!DOCTYPE html>
<html>
<body>

<?php
include 'Finance.php';
if (!isset($_SESSION['UserLogin'])) {
    $_SESSION['notification'] = "Need to login first";
    header("location: Index.php", true, 301);
    exit();
}
$userlogin = $_SESSION['UserLogin'];
?>
<h1>Transfer Menu</h1>

<h3>Your Balance : <?=$userlogin->balance?></h3>
    <form method="post">      
        <input type="hidden" name="action" value="transfer">
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" required>
        <label for="receiver">Transfer To :</label>
        <select name="receiver" id="receiver" required>
          <option value="">-Select Option-</option>
          <?php
          
          foreach ($SessionDB->CheckUser() as $user) 
          {
                if($userlogin->username != $user->username)
                {
          ?>
                  <option value="<?=$user->username?>"><?=$user->username?></option>
          <?php                
                }
          }
          ?>
        </select>
        <button type="submit">Submit</button>
    </form>
    
<br>
<button  onclick="window.location.href = 'main.php'">Back to Main</button>
</body>
</html>