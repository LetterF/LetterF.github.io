<?php
if (isset($_POST['Email'])) {

    $email_to = "fathanzahirx@gmail.com";
    $email_subject = "New form submissions";

    function problem($error)
    {
        echo "Maaf, tapi kelihatannya ada masalah dengan form anda. ";
        echo "Berikut adalah pesan error<br><br>";
        echo $error . "<br><br>";
        echo "Mohon untuk menyelesaikan error tersebut.<br><br>";
        die();
    }

    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Message'])
    ) {
        problem('Maaf, tapi kelihatannya ada masalah dengan form anda.');
    }

    $name = $_POST['Name']; 
    $email = $_POST['Email']; 
    $message = $_POST['Message']; 

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'Alamat email tidak valid.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'Nama tidak valid.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'Pesan yang anda masukkan tidak valid.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";

    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>


    Terima kasih telah mengontak saya. Saya akan mengabari anda nanti

<?php
}
?>