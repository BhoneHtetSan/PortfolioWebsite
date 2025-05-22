<?php

// Get Values from JS
$php_name 		= isset($_POST['ajax_name']) ? $_POST['ajax_name'] : '';
$php_email 		= isset($_POST['ajax_email']) ? $_POST['ajax_email'] : '';
$php_emailto	= isset($_POST['ajax_emailto']) ? $_POST['ajax_emailto'] : '';
$php_message 	= isset($_POST['ajax_message']) ? $_POST['ajax_message'] : '';
$php_phone 		= isset($_POST['ajax_phone']) ? $_POST['ajax_phone'] : '';

// Sanitize all inputs
$php_name_safe 		= htmlspecialchars($php_name, ENT_QUOTES, 'UTF-8');
$php_email_safe 	= filter_var($php_email, FILTER_SANITIZE_EMAIL);
$php_emailto_safe 	= filter_var($php_emailto, FILTER_SANITIZE_EMAIL);
$php_message_safe 	= htmlspecialchars($php_message, ENT_QUOTES, 'UTF-8');
$php_phone_safe 	= htmlspecialchars($php_phone, ENT_QUOTES, 'UTF-8');

// Basic validation for empty fields after sanitization
if (empty($php_name_safe) || empty($php_email_safe) || empty($php_message_safe) || empty($php_phone_safe) || empty($php_emailto_safe)) {
    echo "<span class='contact_error'>* All fields are required. *</span>";
} else if (!filter_var($php_email_safe, FILTER_VALIDATE_EMAIL)) {
    echo "<span class='contact_error'>* Invalid sender email *</span>";
} else if (!filter_var($php_emailto_safe, FILTER_VALIDATE_EMAIL)) {
    echo "<span class='contact_error'>* Invalid recipient email configuration *</span>";
} else {
    // Proceed if emails are valid and fields are not empty
    $php_subject  = "Message from contact form by " . $php_name_safe;
    
    // To send HTML mail, the Content-type header must be set
    $php_headers  = 'MIME-Version: 1.0' . "\r\n";
    $php_headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n"; // Use UTF-8
    $php_headers .= 'From: ' . $php_email_safe . "\r\n"; // Sender's Email
    $php_headers .= 'Reply-To: ' . $php_email_safe . "\r\n";
    // $php_headers .= 'Cc:' . $php_email_safe . "\r\n"; // Optional: Carbon copy to Sender

    $php_template = '<div style="padding:50px; font-family: Arial, sans-serif; line-height: 1.6;">'
    . 'Hello ' . $php_name_safe . ',<br/><br/>'
    . 'Thank you for contacting us. We have received your message and will get back to you as soon as possible.<br/><br/>'
    . '<strong>Here is a copy of your message:</strong><br/>'
    . '<div style="border-left: 3px solid #f00a77; padding-left: 15px; margin-left: 5px; background-color: #f9f9f9;">'
    . '<p><strong style="color:#f00a77;">Name:</strong>  ' . $php_name_safe . '</p>'
    . '<p><strong style="color:#f00a77;">Email:</strong>  ' . $php_email_safe . '</p>'
    . '<p><strong style="color:#f00a77;">Phone:</strong>  ' . $php_phone_safe . '</p>'
    . '<p><strong style="color:#f00a77;">Message:</strong><br/>' . nl2br($php_message_safe) . '</p>'
    . '</div><br/>'
    . 'Best regards,'
    . '<br/>'
    . 'Your Website Team</div>';
    $php_sendmessage = "<div style=\"background-color:#f5f5f5; color:#333;\">" . $php_template . "</div>";
    
    // message lines should not exceed 70 characters (PHP rule), so wrap it - less relevant for HTML
    // $php_sendmessage = wordwrap($php_sendmessage, 70); 
    
    // Send mail by PHP Mail Function
    if (mail($php_emailto_safe, $php_subject, $php_sendmessage, $php_headers)) {
        echo ""; // Success
    } else {
        echo "<span class='contact_error'>* Unable to send email. Please try again later. *</span>";
    }
}

?>