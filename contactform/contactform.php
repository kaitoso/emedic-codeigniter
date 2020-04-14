<? 

    $to      = 'contacto@e-medic.cl'; 
    $subject = $_POST['subject']; 
    $message = $_POST['name'].' escribio: '.$_POST['message']; 
    $headers = 'From: '.$_POST['email'] . "\r\n" . 
        'Reply-To: contacto@e-medic.cl' . "\r\n" . 
        'X-Mailer: PHP/' . phpversion(); 
    mail($to, $subject, $message, $headers);
?>   