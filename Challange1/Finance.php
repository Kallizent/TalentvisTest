<?php
session_start();
class FinancialStatement {
    public $balance;
    

    public function __construct() {

        $this->balance = 0;
    }

    public function deposit($amount) {
        $this->balance += $amount;
        $_SESSION['notification'] = "{$amount} cash successfully deposit";
    }

    public function withdraw($amount) {
        if ($amount > $this->balance) {
            $_SESSION['notification'] = "Your balance is insufficient";
        } else {
            $this->balance -= $amount;
            $_SESSION['notification'] = "{$amount} cash successfully withdrawn";
        }
    }


    public function checkBalance() {
        return $this->balance;
    }
}

// Initialize or retrieve FinancialStatement object from session
if (!isset($_SESSION['Challange1'])) {
    $_SESSION['Challange1'] = new FinancialStatement();
}

$financialStatement = $_SESSION['Challange1'];

// Handling user actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'deposit':
                $amount = $_POST['amount'];
                $financialStatement->deposit($amount);
                header("location: Index.php", true, 301);
                break;

            case 'withdraw':
                $amount = $_POST['amount'];
                $financialStatement->withdraw($amount);
                header("location: Index.php", true, 301);
                break;

            case 'check_balance':
                $balance = $financialStatement->checkBalance();
                $_SESSION['notification'] = "Your balance: {$balance}";
                break;
        }
    }
}
?>
