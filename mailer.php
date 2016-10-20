<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = strip_tags(trim($_POST["name"]));
                $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);
        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }
        $recipient = "roger-sport@roger-sport.com";
        $subject = "| R O G E R   S P O R T | Email de $name";
        $email_content = "Nombre: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Mensaje:\n$message\n";
        $email_headers = "De: $name <$email>";
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            http_response_code(200);
            echo "GRACIAS :)";  
        } else {
            http_response_code(500);
            echo "Oops! Intentelo de nuevo.";
        }

    } else {
        http_response_code(403);
        echo "Oops! Intentelo de nuevo.";
    }
?>
