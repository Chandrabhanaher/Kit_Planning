# Php Codeigitor Fremwork
Using Ajax, Jquery, JavaScript , css.


Using Mysql Database.
Change the database name in database.php file

Create PDF


# Ajax Code

```
$(document).on('click','.priority',function (){
    var SEQ_NO = $(this).attr("id"); 
    $('#loadingmessage').show();
    $('.tab-content').hide();
    $('.nav').hide();
    $('.container-fluid').hide();
    var PP = prompt("Set Priority");
    if(PP != null){
        $.ajax({
            url:"<?php echo base_url().'set_priority'; ?>",  
            method:"POST",  
            data:{SEQ_NO:SEQ_NO,PP:PP},  
            dataType:"json",
            success:function(data){  
                if(data){                        	
                    $('#loadingmessage').hide();
                    alert(data);
                    window.location.href = "<?php echo base_url().'Alls_Fronens';?>";
                    $('.tab-content').show();
                    $('.nav').show();
                    $('.container-fluid').show();
                }  	
            }            
        });
    }
});
```

# PHPMailer - A full-featured email creation and transfer class for PHP
```
 Probably the world's most popular code for sending email from PHP!
 Integrated SMTP support - send without a local mail server
 Send emails with multiple To, CC, BCC and Reply-to addresses
 Multipart/alternative emails for mail clients that do not read HTML email
 Add attachments, including inline
 
```
# A Simple Example
```
<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     // SMTP username
    $mail->Password   = 'secret';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    // Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
```

``
You'll find plenty more to play with in the examples folder.

If you are re-using the instance (e.g. when sending to a mailing list), you may need to clear the recipient list to avoid sending duplicate messages. See the mailing list example for further guidance.

That's it. You should now be ready to use PHPMailer!
``
