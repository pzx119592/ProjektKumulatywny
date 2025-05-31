<?php
class Uzytkownik {
    private $imie;
    private $nazwisko;
    private $haslo;

    public function __construct($imie, $nazwisko, $haslo) {
        $this->imie = trim($imie);
        $this->nazwisko = trim($nazwisko);
        $this->haslo = trim($haslo);
    }

    public function walidujDane() {
        return !empty($this->imie) && !empty($this->nazwisko) && !empty($this->haslo);
    }

    public function zaloguj() {
        if ($this->haslo === "bank123") { 
            session_start();
            $_SESSION['imie'] = htmlspecialchars($this->imie);
            $_SESSION['nazwisko'] = htmlspecialchars($this->nazwisko);
            setcookie("imie", $this->imie, time() + (86400 * 30), "/");
            setcookie("nazwisko", $this->nazwisko, time() + (86400 * 30), "/");
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Niepoprawne hasło!'); window.location.href='login.php';</script>";
            exit();
        }
    }
}
?>