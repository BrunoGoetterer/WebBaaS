// Holt das Formular-Element mit der ID "add-voucher-form"
const form = document.getElementById("add-voucher-form");

// Asynchrone Funktion zum Senden des Formulars
async function submitAddVoucherForm() {
  // Holt die Formulardaten und konvertiert sie in ein JSON-Objekt
  const formData = new FormData(form);
  const body = JSON.stringify(Object.fromEntries(formData));

  // Sendet die Daten an die API
  const response = await fetch(
    "http://localhost/webtechie/Backend/api.php?resource=voucher",
    {
      method: "POST", // HTTP-Methode POST
      body: body, // Körper der Anfrage mit den Formulardaten
    }
  );

  // Lädt die Seite neu, nachdem die Anfrage gesendet wurde
  window.location.reload();
}

// Fügt einen Event-Listener für das "submit"-Event des Formulars hinzu
form.addEventListener("submit", (event) => {
  event.preventDefault(); // Verhindert das Standardverhalten des Formular-Submits

  submitAddVoucherForm(); // Ruft die Funktion zum Senden des Formulars auf
});
