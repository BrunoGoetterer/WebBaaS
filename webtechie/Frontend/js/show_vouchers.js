document.addEventListener("DOMContentLoaded", async function() {
    const response = await fetch(`http://localhost/webtechie/Backend/api.php?resource=vouchers`)
    const data = await response.json();

    if (data.length === 0) {
        document.getElementById('voucherTableBody').innerHTML = 'No vouchers found.';
        return;
    }

    let output = '';

    for (let i = 0; i < data.length; i++) {
        const status = data[i].status;
        const shouldHighlight = status === 'used' || status === 'expired';

        output += `
            <tr class=${shouldHighlight ? 'highlight' : ''}>
                <td>${data[i].id}</td>
                <td>${data[i].code}</td>
                <td>${data[i].discount}</td>
                <td>${data[i].expiry_date}</td>
                <td>${data[i].status}</td>
                <td>${data[i].created_at}</td>
            </tr>
        `;
    }

    document.getElementById('voucherTableBody').innerHTML = output;
});

// Dieser Code lädt beim Laden der Seite eine Liste von Gutscheinen von einer API und zeigt sie dynamisch in einer Tabelle auf der Webseite an.