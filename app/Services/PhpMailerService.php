<?php

namespace App\Services;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class PHPMailerService
{
  protected $mailer;

  public function __construct()
  {
    $this->mailer = new PHPMailer(true);
    $this->configureMailer();
  }

  private function configureMailer()
  {
    $this->mailer->isSMTP();
    $this->mailer->Host = env('MAIL_HOST', 'smtp.example.com');
    $this->mailer->SMTPAuth = true;
    $this->mailer->Username = env('MAIL_USERNAME', 'your_username');
    $this->mailer->Password = env('MAIL_PASSWORD', 'your_password');
    $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $this->mailer->Port = env('MAIL_PORT', 587);
    $this->mailer->setFrom(env('MAIL_FROM_ADDRESS', 'no-reply@example.com'), env('MAIL_FROM_NAME', 'Example App'));
  }

  public function sendEmail($recipients, $subject, $viewName, $viewData = [], $attachments = [])
  {
    try {
      // Render the Blade view into an HTML string
      $body = View::make($viewName, $viewData)->render();

      // Add recipients
      if (is_array($recipients)) {
        foreach ($recipients as $email) {
          $this->mailer->addAddress($email);
        }
      } else {
        $this->mailer->addAddress($recipients);
      }

      // Set email content
      $this->mailer->isHTML(true);
      $this->mailer->Subject = $subject;
      $this->mailer->Body = $body;

      // Add attachments if any
      foreach ($attachments as $filePath) {
        $this->mailer->addAttachment($filePath);
      }

      $this->mailer->send();
      return true;
    } catch (Exception $e) {
      Log::error('Email sending failed: ' . $e->getMessage());
      return 'Mailer Error: ' . $this->mailer->ErrorInfo;
    }
  }
}
