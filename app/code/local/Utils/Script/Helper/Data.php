<?php

class Utils_Script_Helper_Data extends Mage_Core_Helper_Abstract {

    public function test() {
        Mage::log("test helper");
    }

    public function sendTransactionalEmail($subject, $message, $mailFrom, $fromName, $mailTo, $fullfilepath, $filename) {
        try {
            // Transactional Email Template's ID
            $templateId = 1;

            // Set sender information          
            $senderName = $fromName;
            $senderEmail = $mailFrom;
            $sender = array('name' => $senderName,
                'email' => $senderEmail);

            // Set recepient information
            $recepientEmail = $mailTo;
            $recepientName = 'Sun68';

            // Get Store ID    
            $storeId = Mage::app()->getStore()->getId();

            // Set variables that can be used in email template
            $vars = array();

            $translate = Mage::getSingleton('core/translate');

            // Send Transactional Email
            $transactionalEmail = Mage::getModel('core/email_template')->setDesignConfig(array('area' => 'frontend', 'store' => 0));

            $fileContents = file_get_contents($fullfilepath);

            $transactionalEmail->getMail()->createAttachment($fileContents, 'text/csv')->filename = $filename;

            $transactionalEmail->sendTransactional($templateId, $sender, $recepientEmail, $recepientName, $vars, $storeId);

            $translate->setTranslateInline(true);
        } catch (Exception $e) {
            Mage::log($e->getMessage(), null, 'exporter.log');
        }
    }

}
