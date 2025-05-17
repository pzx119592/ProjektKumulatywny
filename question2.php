<?php
class BankAccount {
    private $accountNumber;
    private $owner;
    private $balance;

    public function __construct($accountNumber, $owner, $balance = 0.0) {
        $this->accountNumber = $accountNumber;
        $this->owner = $owner;
        $this->balance = $balance;
    }

    //Wpłacanie środków na konto
    public function deposit($amount) {
        if ($amount > 0) {
            $this->balance += $amount;
            echo "Wpłacono: " . number_format($amount, 2) . " PLN<br>";
        } else {
            echo "Kwota wpłaty musi być większa od zera.<br>";
        }
    }

    //Wypłacanie środków z konta
    public function withdraw($amount) {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            echo "Wypłacono: " . number_format($amount, 2) . " PLN<br>";
        } else {
            echo "Nieprawidłowa kwota wypłaty lub niewystarczające środki.<br>";
        }
    }

    //Bieżące saldo konta
    public function getBalance() {
        return $this->balance;
    }

    //Informacje o koncie
    public function displayAccountInfo() {
        echo "Numer konta: " . $this->accountNumber . "<br>";
        echo "Właściciel: " . $this->owner . "<br>";
        echo "Saldo: " . number_format($this->balance, 2) . " PLN<br>";
    }
}

// Przykład użycia
$account1 = new BankAccount("1234567890", "Michal Graczyk", 500.00);

echo "<h2>Informacje o koncie początkowe:</h2>";
$account1->displayAccountInfo();

echo "<h2>Operacje na koncie:</h2>";
$account1->deposit(200);
$account1->withdraw(150);
$account1->withdraw(600);

echo "<h2>Informacje o koncie końcowe:</h2>";
$account1->displayAccountInfo();
?>