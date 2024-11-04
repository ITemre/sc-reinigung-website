document.querySelector('.contact-form').addEventListener('submit', function(e) {
    e.preventDefault();

    // Sammle Daten aus dem Formular
    var formData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        themengebiet: document.getElementById('themengebiet').value
    };

fetch('/contact.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(formData)
})
.then(response => response.json())
.then(data => {
    console.log('Erfolg:', data);
    if (data.status === 'success') {
        alert('Vielen Dank! Ihre Nachricht wurde erfolgreich versendet.');
    } else {
        alert('Fehler beim Senden der Nachricht. Bitte versuchen Sie es erneut.');
    }
})
});
