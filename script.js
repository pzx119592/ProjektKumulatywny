// Animacje dla formularzy (index.html)
document.addEventListener("DOMContentLoaded", function () {
    let forms = document.querySelectorAll("form");

    forms.forEach(form => {
        form.addEventListener("mouseover", function () {
            form.style.transition = "0.3s";
            form.style.transform = "scale(1.05)";
        });

        form.addEventListener("mouseout", function () {
            form.style.transform = "scale(1)";
        });
    });
});

// Weryfikacja danych użytkownika (index.html)
document.addEventListener("DOMContentLoaded", function () {
    let inputKwota = document.querySelector("input[name='kwota']");
    let buttons = document.querySelectorAll("button");

    buttons.forEach(function (button) {
        button.addEventListener("click", function (event) {
            let akcja = button.value;

            if (akcja === "wplac" || akcja === "wyplac") {
                let kwota = parseFloat(inputKwota.value);
                
                if (isNaN(kwota) || kwota <= 0) {
                    event.preventDefault();
                    alert("Podaj poprawną kwotę (większą niż 0)!");
                }
            }
        });
    });
});

// Animacja pola wyników (result.html)
document.addEventListener("DOMContentLoaded", function () {
    let container = document.querySelector(".container");

    container.addEventListener("mouseover", function () {
        container.style.transition = "0.3s";
        container.style.transform = "scale(1.05)";
    });

    container.addEventListener("mouseout", function () {
        container.style.transform = "scale(1)";
    });
});

// Historia transakcji (result.html)
document.addEventListener("DOMContentLoaded", function () {
    let wynik = sessionStorage.getItem("wynik");
    let historia = JSON.parse(localStorage.getItem("historia")) || [];

    if (wynik) {
        document.getElementById("wynik").innerHTML = wynik;

        // Dodanie wyniku do historii
        historia.push(wynik);
        localStorage.setItem("historia", JSON.stringify(historia));
    }

    // Wyświetlenie historii operacji
    let historiaDiv = document.createElement("div");
    historiaDiv.innerHTML = "<h2>Historia transakcji:</h2>";
    historia.forEach(entry => {
        historiaDiv.innerHTML += `<p>${entry}</p>`;
    });

    document.body.appendChild(historiaDiv);

    // Obsługa czyszczenia historii
    let clearButton = document.getElementById("wyczysc-historie");
    clearButton.addEventListener("click", function () {
        localStorage.removeItem("historia");
        historiaDiv.innerHTML = "<p>Historia została wyczyszczona.</p>";
    });
});