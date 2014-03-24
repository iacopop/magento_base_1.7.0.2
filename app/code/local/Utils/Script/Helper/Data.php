<?php

class Utils_Script_Helper_Data extends Mage_Core_Helper_Abstract {
    
    public function test(){
        Mage::log("test helper");
    }

    public function sendMail($subject, $message = "", $mailFrom, $fromName, $mailTo, $fullfilepath, $filename) {

        $mail = new Zend_Mail('utf-8');

        $recipients = array(
            $mailTo
        );

        $mail->setBodyHtml($message)
                ->setSubject($subject)
                ->addTo($recipients)
                ->setFrom($mailFrom, $fromName);

        //file content is attached
        $file = $fullfilepath;
        $attachment = file_get_contents($file);
        $mail->createAttachment(
                $attachment, Zend_Mime::TYPE_OCTETSTREAM, Zend_Mime::DISPOSITION_ATTACHMENT, Zend_Mime::ENCODING_BASE64, $filename
        );


        try {
            $mail->send();
        } catch (Exception $e) {
            Mage::logException($e);
        }
    }

}
