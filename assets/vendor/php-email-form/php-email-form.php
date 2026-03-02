<?php
/**
 * PHP Email Form Library
 * BootstrapMade.com
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */

class PHP_Email_Form {
  public $to = '';
  public $from_name = '';
  public $from_email = '';
  public $subject = '';
  public $ajax = false;
  public $smtp = array();

  public $messages = array();

  public function add_message($content, $label = '', $length = 0) {
    $this->messages[] = array('content' => $content, 'label' => $label, 'length' => $length);
  }

  public function send() {
    $message = "";
    foreach ($this->messages as $m) {
      $message .= ($m['label'] != '' ? $m['label'].": " : '') . $m['content'] . "\n";
    }

    $headers  = "From: " . $this->from_name . " <" . $this->from_email . ">\r\n";
    $headers .= "Reply-To: " . $this->from_email . "\r\n";

    if(!empty($this->smtp)) {
      // If you want to use SMTP, you must configure PHPMailer or another SMTP handler here.
      // For now, this just uses the default mail()
    }

    return mail($this->to, $this->subject, $message, $headers);
  }
}
