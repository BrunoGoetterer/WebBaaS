// Fügt einen Event-Listener für das "submit"-Event des Formulars mit der ID "profileForm" hinzu
document.getElementById('profileForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Verhindert das Standardverhalten des Formular-Submits

    var form = this; // Speichert das Formular-Element in einer Variablen
    var xhr = new XMLHttpRequest(); // Erstellt eine neue XMLHttpRequest-Instanz
    xhr.open('POST', form.action, true); // Initialisiert die Anfrage mit der Methode POST und der URL des Formulars
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Setzt den Content-Type-Header

    // Event-Handler für die Antwort der Anfrage
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Lädt die Seite neu, nachdem das Formular erfolgreich übermittelt wurde
            location.reload();
        } else {
            // Fehlerbehandlung
            console.error('Form submission failed:', xhr.status, xhr.statusText);
        }
    };

    // Sendet die Formulardaten als URL-encoded-String
    xhr.send(new URLSearchParams(new FormData(form)).toString());
});
