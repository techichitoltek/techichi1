<?php
/*require_once('Phpmailer/class.html2text.inc');
require_once('Phpmailer/class.phpmailer.php');*/
require_once ('Phpmailer/PHPMailerAutoload.php');
class App_Mail
{

    protected $_viewSubject;
    protected $_layout ;
    protected $_viewContent;
    protected $templateVariables = array();
    protected $templateName;
    /**
     * @var PHPMailer instance
     */
    protected $_mail;

    /**
     * @var Email
     */
    protected $_email;

    /**
     *
     * @var EmailLog
     */
    protected $_emailLog;

    protected $recipient;

    public function __construct($mailName)
    {
        $this->_mail = new PHPMailer();
        $this->_email = new Email($mailName,true,"email_name");
        $this->_emailLog = new EmailLog();

        if($this->_email->getEmail_module() == 'app'){
            $emailPath = ROOT_PATH . '/library/App/Mail/Templates';
        }else{
            $emailPath = APPLICATION_PATH . '/modules/' . $this->_email->getEmail_module() . '/views/emails';
        }

        $this->_layout = new Zend_Layout() ;
        $this->_layout->setLayoutPath($emailPath);
        if($this->_email->getEmail_layout()){
            $this->_layout->setLayout($this->_email->getEmail_layout().".layout");
        }else{
            $this->_layout->setLayout("default.layout");
        }

        $this->_viewSubject = new Zend_View();
        $this->_viewSubject->setScriptPath($emailPath);

        $this->_viewContent = new Zend_View();
        $this->_viewContent->setScriptPath($emailPath);

        $this->templateName = $this->_email->getEmail_template();

        // on charge les chemins d'aides de vue spécifié dans la vue courante
        // on peut alors utiliser toutes les aides de vue dans nos e-mails
        $helper_paths = Zend_Layout::getMvcInstance()->getView()->getHelperPaths() ;
        foreach ($helper_paths as $prefix => $paths)	{
            foreach ($paths as $path) {
                $this->_viewContent->addHelperPath($path, $prefix) ;
            }
        }
    }

    /**
     * Set variables for use in the templates
     *
     * @param string $name  The name of the variable to be stored
     * @param mixed  $value The value of the variable
     */
    public function __set($name, $value)
    {
        $this->templateVariables[$name] = $value;
    }

    /**
     * Set the template file to use
     *
     * @param string $filename Template filename
     */
    public function setTemplate($filename)
    {
        $this->templateName = $filename;
    }

    /**
     * Set the recipient address for the email message
     *
     * @param string $email Email address
     */
    public function setRecipient($email)
    {
        $this->recipient = $email;
    }

    /**
     * Send email
     * if $log=true => log en base
     *
     * @param boolean $log
     */
    public function send($log=true)
    {
        if($this->_email->checkVars()){
            foreach ($this->_email->getVars() as $key => $value)
            {
                if (!array_key_exists($key, $this->templateVariables)) {
                    $this->{$key} = $value;
                }
            }
        }

        foreach ($this->templateVariables as $key => $value) {
            $this->_viewSubject->{$key} = $value;
        }
        $subject = $this->_viewSubject->render($this->templateName . ".subject.phtml");

        foreach ($this->templateVariables as $key => $value) {
            $this->_viewContent->{$key} = $value;
        }
        $html = $this->_viewContent->render($this->templateName . ".phtml");

        foreach ($this->templateVariables as $key => $value) {
            $this->_layout->{$key} = $value;
        }
        $this->_layout->content = $html;

        $body = $this->_layout->render() ;

        /////////////////
        switch (ParamCustom::param("MAIL.SEND_METHOD","FRAMEWORK")) {
            case "smtp":
                $this->_mail->IsSMTP(); // telling the class to use smtp transport
                // Préparation du mail
                $this->_mail->Host = ParamCustom::param("MAIL.SMTP_HOST","FRAMEWORK");
                if(ParamCustom::param("MAIL.SMTP_AUTH","FRAMEWORK")){
                    $this->_mail->SMTPAuth   = true;                  // enable SMTP authentication
                }
                if(ParamCustom::param("MAIL.SMTP_SECURE","FRAMEWORK")){
                    $this->_mail->SMTPSecure = ParamCustom::param("MAIL.SMTP_SECURE","FRAMEWORK");
                }
                $this->_mail->Port       = ParamCustom::param("MAIL.SMTP_PORT","FRAMEWORK");
                $this->_mail->Username   = ParamCustom::param("MAIL.SMTP_USERNAME","FRAMEWORK");
                $this->_mail->Password   = ParamCustom::param("MAIL.SMTP_PASSWORD","FRAMEWORK");
                break;
            case "mail":
                $this->_mail->IsMail(); // telling the class to use mail method
                break;
            case "qmail":
                $this->_mail->IsQmail(); // telling the class to use Qmail transport
                break;
            default:
            case "sendmail":
                $this->_mail->IsSendmail(); // telling the class to use SendMail transport
                break;
        }

        $this->_mail->CharSet	= "UTF-8";
        $this->_mail->IsHTML(true);

        // Reprise des infos custom
        if($this->_email->getEmail_fromMail()){
            $this->_mail->From 	= $this->_email->getEmail_fromMail();
        }else{
            $this->_mail->From 	= ParamCustom::param("MAIL.ROBOT.FROM_EMAIL","FRAMEWORK");
        }

        if($this->_email->getEmail_fromName()){
            $this->_mail->FromName = $this->_email->getEmail_fromName();
        }else{
            $this->_mail->FromName 	= ParamCustom::param("MAIL.ROBOT.FROM_USERNAME","FRAMEWORK");
        }

        // Reprise des infos custom
        if($this->_email->getEmail_replyToName()){
            $addressReplyTo 	= $this->_email->getEmail_replyToName();
        }else{
            $addressReplyTo 	= ParamCustom::param("MAIL.ROBOT.REPLY_TO_NAME","FRAMEWORK");
        }

        if($this->_email->getEmail_replyToMail()){
            $nameReplyTo = $this->_email->getEmail_replyToMail();
        }else{
            $nameReplyTo 	= ParamCustom::param("MAIL.ROBOT.REPLY_TO_MAIL","FRAMEWORK");
        }
        if($addressReplyTo) $this->AddReplyTo($addressReplyTo,$nameReplyTo);

        // Reprise des infos custom
        if($this->_email->getEmail_ccMail()){
            $tabAdresse = extractEmailsFromString($this->_email->getEmail_ccMail());
            foreach($tabAdresse as $addresse){
                $this->AddCC($addresse);
            }
        }

        if($this->_email->getEmail_bccMail()){
            $tabAdresse = extractEmailsFromString($this->_email->getEmail_bccMail());
            foreach($tabAdresse as $addresse){
                $this->AddBCC($addresse);
            }
        }

        // On convertit le HTML en texte pour les webmails
        //$html2text = new html2text($body);
        //$altBody = $html2text->get_text();

        $this->_mail->Subject	= $subject;
        $this->_mail->Body		= $body;
        //$this->_mail->AltBody	= $altBody;

        try {
            if($log){
                $this->_emailLog->loadEmail($this->_mail, $this->_email);
                $this->_emailLog->save(true);
            }
            $res = $this->_mail->Send();
            if($log){
                if($res){
                    $this->_emailLog->setEmailLog_sent(1);
                }else{
                    $this->_emailLog->setEmailLog_sent(0);
                    $this->_emailLog->setEmailLog_log($this->_mail->ErrorInfo);
                }
                $this->_emailLog->save();
            }
            //Zend_Debug::dump($this->_mail);
            //Zend_Debug::dump($res);
        } catch (phpmailerException $e) {
          echo $e->errorMessage(); //Pretty error messages from PHPMailer
          //myLogTD("tdmail","Mailer Error: " . $e->errorMessage(),Zend_Log::INFO);
          //$return = false;
        } catch (Exception $e) {
          echo $e->getMessage(); //Boring error messages from anything else!
          //myLogTD("tdmail","Mailer Error: " . $e->getMessage(),Zend_Log::INFO);
          //$return = false;
        }
        return $res;

    }

    /////////////////////
    /////////////////////
    /*
    Pièces jointes
    $mail->AddAttachment('./mon_fichier_joint.zip');


    Exemple envoi pièce jointe si image dans template
    $mail->AddEmbeddedImage('images/logo.png','mon_logo', 'logo.png');
    dans le template :
    '....<img src="cid:mon_logo" alt="Logo"/>...';
    Il suffit donc d'insérer dans le src cid: suivi de l'identifiant de votre image.

    */
    /////////////////////////////////////////////////
    // METHODS, RECIPIENTS
    /////////////////////////////////////////////////

    /**
     * Adds a "To" address.
     * @param string $address
     * @param string $name
     * @return boolean true on success, false if address already used
     */
    public function AddAddress($address, $name = '') {
        $this->_emailLog->setEmailLog_to($this->_emailLog->getEmailLog_to().$address.";");
        return $this->_mail->AddAddress($address, $name);
    }

    /**
     * Adds a "Cc" address.
     * Note: this function works with the SMTP mailer on win32, not with the "mail" mailer.
     * @param string $address
     * @param string $name
     * @return boolean true on success, false if address already used
     */
    public function AddCC($address, $name = '') {
        $this->_emailLog->setEmailLog_cc($this->_emailLog->getEmailLog_cc().$address.";");
        return $this->_mail->AddCC($address, $name);
    }

    /**
     * Adds a "Bcc" address.
     * Note: this function works with the SMTP mailer on win32, not with the "mail" mailer.
     * @param string $address
     * @param string $name
     * @return boolean true on success, false if address already used
     */
    public function AddBCC($address, $name = '') {
        $this->_emailLog->setEmailLog_bcc($this->_emailLog->getEmailLog_bcc().$address.";");
        return $this->_mail->AddBCC($address, $name);
    }

    /**
     * Adds a "Reply-to" address.
     * @param string $address
     * @param string $name
     * @return boolean
     */
    public function AddReplyTo($address, $name = '') {
        $this->_emailLog->setEmailLog_replyTo($this->_emailLog->getEmailLog_replyTo().$address.";");
        return $this->_mail->AddReplyTo($address, $name);
    }

    /////////////////////////////////////////////////
    // CLASS METHODS, MESSAGE RESET
    /////////////////////////////////////////////////

    /**
     * Clears all recipients assigned in the TO array.  Returns void.
     * @return void
     */
    public function ClearAddresses() {
        $this->_emailLog->setEmailLog_to("");
        $this->_mail->ClearAddresses();
    }

    /**
     * Clears all recipients assigned in the CC array.  Returns void.
     * @return void
     */
    public function ClearCCs() {
        $this->_emailLog->setEmailLog_cc("");
        $this->_mail->ClearCCs();
    }

    /**
     * Clears all recipients assigned in the BCC array.  Returns void.
     * @return void
     */
    public function ClearBCCs() {
        $this->_emailLog->setEmailLog_bcc("");
        $this->_mail->ClearBCCs();
    }

    /**
     * Clears all recipients assigned in the ReplyTo array.  Returns void.
     * @return void
     */
    public function ClearReplyTos() {
        $this->_emailLog->setEmailLog_replyTo("");
        $this->_mail->ClearReplyTos();
    }

    /**
     * Clears all recipients assigned in the TO, CC and BCC
     * array.  Returns void.
     * @return void
     */
    public function ClearAllRecipients() {
        $this->_emailLog->setEmailLog_to("");
        $this->_emailLog->setEmailLog_cc("");
        $this->_emailLog->setEmailLog_bcc("");
        $this->_mail->ClearAllRecipients();
    }

    /**
     * Clears all previously set filesystem, string, and binary
     * attachments.  Returns void.
     * @return void
     */
    public function ClearAttachments() {
        $this->_mail->ClearAttachments();
    }

    /**
     * Clears all custom headers.  Returns void.
     * @return void
     */
    public function ClearCustomHeaders() {
        $this->_mail->ClearCustomHeaders();
    }


    /////////////////////////////////////////////////
    // CLASS METHODS, ATTACHMENTS
    /////////////////////////////////////////////////

    /**
     * Adds an attachment from a path on the filesystem.
     * Returns false if the file could not be found
     * or accessed.
     * @param string $path Path to the attachment.
     * @param string $name Overrides the attachment name.
     * @param string $encoding File encoding (see $Encoding).
     * @param string $type File extension (MIME) type.
     * @return bool
     */
    public function AddAttachment($path, $name = '', $encoding = 'base64', $type = 'application/octet-stream') {
        return $this->_mail->AddAttachment($path, $name, $encoding, $type);
    }

    /**
     * Return the current array of attachments
     * @return array
     */
    public function GetAttachments() {
        return $this->_mail->attachment;
    }


    /**
     * Encodes string to requested format.
     * Returns an empty string on failure.
     * @param string $str The text to encode
     * @param string $encoding The encoding to use; one of 'base64', '7bit', '8bit', 'binary', 'quoted-printable'
     * @access public
     * @return string
     */
    public function EncodeString($str, $encoding = 'base64') {
        return $this->_mail->EncodeString($str, $encoding);
    }

    /**
     * Adds a string or binary attachment (non-filesystem) to the list.
     * This method can be used to attach ascii or binary data,
     * such as a BLOB record from a database.
     * @param string $string String attachment data.
     * @param string $filename Name of the attachment.
     * @param string $encoding File encoding (see $Encoding).
     * @param string $type File extension (MIME) type.
     * @return void
     */
    public function AddStringAttachment($string, $filename, $encoding = 'base64', $type = 'application/octet-stream') {
        $this->_mail->AddStringAttachment($string, $filename, $encoding, $type);
    }

    /**
     * Adds an embedded attachment.  This can include images, sounds, and
     * just about any other document.  Make sure to set the $type to an
     * image type.  For JPEG images use "image/jpeg" and for GIF images
     * use "image/gif".
     * @param string $path Path to the attachment.
     * @param string $cid Content ID of the attachment.  Use this to identify
     *        the Id for accessing the image in an HTML form.
     * @param string $name Overrides the attachment name.
     * @param string $encoding File encoding (see $Encoding).
     * @param string $type File extension (MIME) type.
     * @return bool
     */
    public function AddEmbeddedImage($path, $cid, $name = '', $encoding = 'base64', $type = 'application/octet-stream') {
        $this->_mail->AddEmbeddedImage($path, $cid, $name, $encoding, $type);
    }

    public function AddStringEmbeddedImage($string, $cid, $filename = '', $encoding = 'base64', $type = 'application/octet-stream') {
        $this->_mail->AddStringEmbeddedImage($string, $cid, $filename, $encoding, $type);
    }





}