<?php
session_start();
class FinancialStatement {
    public $balance;
    public $transactionHistory;    

    public function __construct() {

        $this->balance = 0;
        $this->transactionHistory = [];
    }

    public function deposit($amount) {
        $this->balance += $amount;
        $this->addTransaction('Deposit', $amount);
        $_SESSION['notification'] = "{$amount} cash successfully deposit";
    }

    public function withdraw($amount) {
        if ($amount > $this->balance) {
            $_SESSION['notification'] = "Your balance is insufficient";
        } else {
            $this->balance -= $amount;
            $this->addTransaction('Withdraw', $amount);
            $_SESSION['notification'] = "{$amount} cash successfully withdrawn";
        }
    }

    public function checkBalance() {
        return $this->balance;
    }

    private function addTransaction($type, $amount) {
        $transaction = [
            'time' => date('Y-m-d H:i:s'),
            'type' => $type,
            'debit' => $type == 'Deposit' ? $amount : '',
            'credit' => $type == 'Withdraw' ? $amount : '',
            'balance' => $this->balance,
        ];
        $this->transactionHistory[] = $transaction;
    }

    public function showTransactionHistory() {
        return $this->transactionHistory;
    }
}

// Initialize or retrieve FinancialStatement object from session
if (!isset($_SESSION['Challange2'])) {
    $_SESSION['Challange2'] = new FinancialStatement();
}

$financialStatement = $_SESSION['Challange2'];

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
