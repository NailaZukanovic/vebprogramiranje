<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verifcation</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Styles/global.css"/>
</head>
<body> -->
    <?php include 'header.php' ?>

    <?php
        session_start();

        require './PHPMailer-master/src/Exception.php';
        require './PHPMailer-master/src/PHPMailer.php';
        require './PHPMailer-master/src/SMTP.php';

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        $mail = new PHPMailer(true);

        $name = $_SESSION['created']['name'];
        $lastname = $_SESSION['created']['lastname'];
        $email = $_SESSION['created']['email'];
        $type = $_SESSION['created']['type'];

        $id = $_SESSION['created']['id'];
        $for = $_SESSION['created']['for'];

        try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.live.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'jakicmilicaa@gmail.com';                     // SMTP username
            $mail->Password   = 'Umomsrcurastekopriva';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('jakicmilicaa@gmail.com', 'noreply@jakicmilicaa@gmail.com');
            $mail->addAddress($email, `{$name} {$lastname}`);     // Add a recipient
            $mail->addReplyTo('jakicmilicaa@gmail.com', 'NoReply');

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Verifikacija naloga';
            $mail->Body = "
            <html xmlns=\"http://www.w3.org/1999/xhtml\">
            <head>
                <meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0;\">
                <meta name=\"format-detection\" content=\"telephone=no\"/>
            
                <!-- Responsive Mobile-First Email Template by Konstantin Savchenko, 2015.
                https://github.com/konsav/email-templates/  -->
            
                <style>
            /* Reset styles */ 
            body { margin: 0; padding: 0; min-width: 100%; width: 100% !important; height: 100% !important;}
            body, table, td, div, p, a { -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; }
            table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse !important; border-spacing: 0; }
            img { border: 0; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
            #outlook a { padding: 0; }
            .ReadMsgBody { width: 100%; } .ExternalClass { width: 100%; }
            .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }
            
            /* Rounded corners for advanced mail clients only */ 
            @media all and (min-width: 560px) {
                .container { border-radius: 8px; -webkit-border-radius: 8px; -moz-border-radius: 8px; -khtml-border-radius: 8px;}
            }
            
            /* Set color for auto links (addresses, dates, etc.) */ 
            a, a:hover {
                color: #127DB3;
            }
            .footer a, .footer a:hover {
                color: #999999;
            }
            
                </style>
            
                <!-- MESSAGE SUBJECT -->
                <title>Verifikacija naloga</title>
            
            </head>
            
            <!-- BODY -->
            <!-- Set message background color (twice) and text color (twice) -->
            <body topmargin=\"0\" rightmargin=\"0\" bottommargin=\"0\" leftmargin=\"0\" marginwidth=\"0\" marginheight=\"0\" width=\"100%\" style=\"border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
                background-color: #F0F0F0;
                color: #000000;\"
                bgcolor=\"#ff4d4f\"
                text=\"#000000\">
            
            <!-- SECTION / BACKGROUND -->
            <!-- Set message background color one again -->
            <table width=\"100%\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;\" class=\"background\"><tr><td align=\"center\" valign=\"top\" style=\"border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;\"
                bgcolor=\"#F0F0F0\">
            
            <!-- WRAPPER -->
            <!-- Set wrapper width (twice) -->
            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\"
                width=\"560\" style=\"border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
                max-width: 560px;\" class=\"wrapper\">
            
                <tr>
                    <td align=\"center\" valign=\"top\" style=\"border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
                        padding-top: 20px;
                        padding-bottom: 20px;\">
            
                        <!-- LOGO -->
                        <!-- Image text color should be opposite to background color. Set your url, image src, alt and title. Alt text should fit the image size. Real image size should be x2. URL format: http://domain.com/?utm_source={{Campaign-Source}}&utm_medium=email&utm_content=logo&utm_campaign={{Campaign-Name}} -->
                        <a target=\"_blank\" style=\"text-decoration: none;\"
                            href=\"#\"><img height=\"64\" border=\"0\" vspace=\"0\" hspace=\"0\"
                            src=\"./Assets/Boxing_Logo.png\"
                            width=\"100\" height=\"30\"
                            alt=\"Logo\" title=\"Logo\" style=\"
                            color: #000000;
                            font-size: 10px; margin: 0; padding: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;\" /></a>
            
                    </td>
                </tr>
            
            <!-- End of WRAPPER -->
            </table>
            
            <!-- WRAPPER / CONTEINER -->
            <!-- Set conteiner background color -->
            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\"
                bgcolor=\"#FFFFFF\"
                width=\"560\" style=\"border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
                max-width: 560px;\" class=\"container\">
            
                <!-- HEADER -->
                <!-- Set text color and font family (\"sans-serif\" or \"Georgia, serif\") -->
                <tr>
                    <td align=\"center\" valign=\"top\" style=\"border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 24px; font-weight: bold; line-height: 130%;
                        padding-top: 25px;
                        color: #000000;
                        font-family: sans-serif;\" class=\"header\">
                            Potvrdite vas email!
                    </td>
                </tr>
                
                <!-- SUBHEADER -->
                <!-- Set text color and font family (\"sans-serif\" or \"Georgia, serif\") -->
                <tr>
                    <td align=\"center\" valign=\"top\" style=\"border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-bottom: 3px; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 18px; font-weight: 300; line-height: 150%;
                        padding-top: 5px;
                        color: #000000;
                        font-family: sans-serif;\" class=\"subheader\">
                            Verifikujte vas nalog
                    </td>
                </tr>
            
                <!-- HERO IMAGE -->
                <!-- Image text color should be opposite to background color. Set your url, image src, alt and title. Alt text should fit the image size. Real image size should be x2 (wrapper x2). Do not set height for flexible images (including \"auto\"). URL format: http://domain.com/?utm_source={{Campaign-Source}}&utm_medium=email&utm_content={{Ìmage-Name}}&utm_campaign={{Campaign-Name}} -->
                
            
                <!-- PARAGRAPH -->
                <!-- Set text color and font family (\"sans-serif\" or \"Georgia, serif\"). Duplicate all text styles in links, including line-height -->
                <tr>
                    <td align=\"center\" valign=\"top\" style=\"border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
                        padding-top: 25px; 
                        color: #000000;
                        font-family: sans-serif;\" class=\"paragraph\">
                            Organizujte ovo ono
                    </td>
                </tr>
            
                <!-- BUTTON -->
                <!-- Set button background color at TD, link/text color at A and TD, font family (\"sans-serif\" or \"Georgia, serif\") at TD. For verification codes add \"letter-spacing: 5px;\". Link format: http://domain.com/?utm_source={{Campaign-Source}}&utm_medium=email&utm_content={{Button-Name}}&utm_campaign={{Campaign-Name}} -->
                <tr>
                    <td align=\"center\" valign=\"top\" style=\"border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
                        padding-top: 25px;
                        padding-bottom: 5px;\" class=\"button\"><a
                        href=\"http://localhost/Boxing-Tournaments/verifyAccount.php?id=$id&for=$for&type=$type\" target=\"_blank\" style=\"text-decoration: underline;\">
                            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"max-width: 240px; min-width: 120px; border-collapse: collapse; border-spacing: 0; padding: 0;\"><tr><td align=\"center\" valign=\"middle\" style=\"padding: 12px 24px; margin: 0; text-decoration: underline; border-collapse: collapse; border-spacing: 0; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; -khtml-border-radius: 4px;\"
                                bgcolor=\"#ff4d4f\"><a target=\"_blank\" style=\"text-decoration: underline;
                                color: #FFFFFF; font-family: sans-serif; font-size: 17px; font-weight: 400; line-height: 120%;\"
                                href=\"http://localhost/Boxing-Tournaments/verifyAccount.php?id=$id&for=$for&type=$type\">
                                    Verifikujte nalog!
                                </a>
                        </td></tr></table></a>
                    </td>
                </tr>
            
                <!-- LINE -->
                <!-- Set line color -->
                <tr>	
                    <td align=\"center\" valign=\"top\" style=\"border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
                        padding-top: 25px;\" class=\"line\"><hr
                        color=\"#E0E0E0\" align=\"center\" width=\"100%\" size=\"1\" noshade style=\"margin: 0; padding: 0;\" />
                    </td>
                </tr>
            
                <!-- PARAGRAPH -->
                <!-- Set text color and font family (\"sans-serif\" or \"Georgia, serif\"). Duplicate all text styles in links, including line-height -->
                <tr>
                    <td align=\"center\" valign=\"top\" style=\"border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
                        padding-top: 20px;
                        padding-bottom: 25px;
                        color: #000000;
                        font-family: sans-serif;\" class=\"paragraph\">
                        <h4>
                            Najbolji softver za organizaciju, pracenje i odrzavanje turnira
                        </h4>
                    </td>
                </tr>
            
            <!-- End of WRAPPER -->
            </table>
            
            <!-- WRAPPER -->
            <!-- Set wrapper width (twice) -->
            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\"
                width=\"560\" style=\"border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
                max-width: 560px;\" class=\"wrapper\">
            
                <!-- SOCIAL NETWORKS -->
                <!-- Image text color should be opposite to background color. Set your url, image src, alt and title. Alt text should fit the image size. Real image size should be x2 -->
                <tr>
                    <td align=\"center\" valign=\"top\" style=\"border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
                        padding-top: 25px;\" class=\"social-icons\"><table
                        width=\"256\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"border-collapse: collapse; border-spacing: 0; padding: 0; font-family: sans-serif;\">
                        <tr>
                            <h4>
                                Drustvene mreze uskoro
                            </h4>
                        </tr>
                        </table>
                    </td>
                </tr>
            
                <!-- FOOTER -->
                <!-- Set text color and font family (\"sans-serif\" or \"Georgia, serif\"). Duplicate all text styles in links, including line-height -->
                <tr>
                    <td align=\"center\" valign=\"top\" style=\"border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 13px; font-weight: 400; line-height: 150%;
                        padding-top: 20px;
                        padding-bottom: 20px;
                        color: #999999;
                        font-family: sans-serif;\" class=\"footer\">
            
                            Ovo vam je poslato jer ste se prijavili da budete clan mreze
                            <!-- ANALYTICS -->
                            <!-- https://www.google-analytics.com/collect?v=1&tid={{UA-Tracking-ID}}&cid={{Client-ID}}&t=event&ec=email&ea=open&cs={{Campaign-Source}}&cm=email&cn={{Campaign-Name}} -->
                            <img width=\"1\" height=\"1\" border=\"0\" vspace=\"0\" hspace=\"0\" style=\"margin: 0; padding: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;\"
                            src=\"https://raw.githubusercontent.com/konsav/email-templates/master/images/tracker.png\" />
            
                    </td>
                </tr>
            
            <!-- End of WRAPPER -->
            </table>
            
            <!-- End of SECTION / BACKGROUND -->
            </td></tr></table>
            
            </body>
            </html>
            ";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo "
                <div style='text-align: center'>
                    <div class='alert bg-success'>
                        <h2>Verifikacija poslana na vas mejl!</h2>

                        <p> Verifikujte svoj profil i sacekajte da vas administrator odobri da bi se prijavili. </p>
                    </div>

                    <button
                        class='size-lg mt-1 bg-success'
                        onClick='location.href = `index.php`'
                    >
                        Pocetna
                    </button>
                </div>
            ";
        } catch (Exception $e) {
            echo "
                <div style='text-align: center'>
                    <div class='alert bg-danger'>
                        <h2>Doslo je do greske!</h2>
                    </div>

                    <button
                        class='size-lg mt-1 bg-danger'
                        onClick='location.href = `index.php`'
                    >
                        Pocetna
                    </button>
                </div>
            ";
        }
    ?>
    <?php include 'footer.php' ?>
<!-- </body>
</html> -->
