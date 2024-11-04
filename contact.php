<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $name = htmlspecialchars($data["name"]);
    $email = htmlspecialchars($data["email"]);
    $message = htmlspecialchars($data["message"]);
    $phone = htmlspecialchars($data["phone"]); //
    $themengebiet = htmlspecialchars($data["themengebiet"]);

    // Empfänger-E-Mail-Adresse
    $to = "info@sc-reinigung.de";

    // Betreff der E-Mail
    $subject = "Reinigungs-Anfrage von: $name";

   // E-Mail-Inhalt mit HTML und CSS
   $body = "
   <html>
    <body style='font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px; text-align: center;'>
        <div style='max-width: 600px; margin: auto; background: #E3F2FD; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>
            <h2 style='color: #0277BD;'>Neue Reinigungsanfrage</h2>
            <p style='color: #01579B;'><strong>Name:</strong> $name</p>
            <p style='color: #01579B;'><strong>E-Mail:</strong> $email</p>
            <p style='color: #01579B;'><strong>Telefon:</strong> $phone</p>
            <p style='color: #01579B;'><strong>Interessiert an:</strong> $themengebiet</p>
        </div>
    </body>
    </html>";

    // Header Informationen inklusive Absender E-Mail
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";


    // E-Mail senden
    $success = mail($to, $subject, $body, $headers);

    // Überprüfen, ob die E-Mail erfolgreich gesendet wurde
    if ($success) {
        // Erfolgsmeldung
        echo json_encode(array('status' => 'success', 'message' => 'Vielen Dank! Ihre Nachricht wurde erfolgreich versendet.'));
    } else {
        // Fehlermeldung
        echo json_encode(array('status' => 'error', 'message' => 'Fehler beim Senden der Nachricht. Bitte versuchen Sie es erneut.'));
    }
} else {
    // Wenn die Seite direkt aufgerufen wird, ohne dass das Formular gesendet wurde
    echo json_encode(array('status' => 'error', 'message' => 'Ungültige Anfrage.'));
}
?>
