document.addEventListener("DOMContentLoaded", function () {
    const kwotaInput = document.querySelector("input[name='kwota']");
    const form = document.querySelector("form");
    const errorMessage = document.createElement("p");

    // Dynamiczne efekty dla formularzy
    document.querySelectorAll("form").forEach(form => {
        form.addEventListener("mouseenter", () => {
            form.style.boxShadow = "0px 0px 15px rgba(0, 140, 186, 0.3)";
        });

        form.addEventListener("mouseleave", () => {
            form.style.boxShadow = "0px 4px 10px rgba(0, 0, 0, 0.2)";
        });
    });

    // Walidacja kwoty
    errorMessage.style.color = "red";
    errorMessage.style.display = "none";
    kwotaInput.parentElement.appendChild(errorMessage);

    kwotaInput.addEventListener("input", function () {
        const kwota = parseFloat(kwotaInput.value);

        if (isNaN(kwota) || kwota <= 0) {
            errorMessage.textContent = "Podaj poprawną, dodatnią kwotę!";
            errorMessage.style.display = "block";
        } else {
            errorMessage.style.display = "none";
        }
    });

    // Walidacja przed wysłaniem formularza
    form.addEventListener("submit", function (event) {
        const kwota = parseFloat(kwotaInput.value);

        if (isNaN(kwota) || kwota <= 0) {
            event.preventDefault();
            alert("Podaj poprawną kwotę przed wykonaniem operacji!");
        }
    });

    // Podświetlanie najnowszej operacji w historii
    let firstTransaction = document.querySelector("ul li:first-child");
    if (firstTransaction) {
        firstTransaction.style.background = "#ffeb3b";
        firstTransaction.style.fontWeight = "bold";
    }

    // Animacje dla przycisków
    document.querySelectorAll("button, .history-button, .logout-button").forEach(button => {
        button.addEventListener("mouseenter", () => {
            button.style.transform = "scale(1.08)";
            button.style.boxShadow = "0px 6px 12px rgba(0, 140, 186, 0.5)";
        });

        button.addEventListener("mouseleave", () => {
            button.style.transform = "scale(1)";
            button.style.boxShadow = "0px 4px 8px rgba(0, 140, 186, 0.3)";
        });
    });
});