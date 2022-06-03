<?php

namespace App\Mail;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestMail extends Mailable implements ShouldQueue
{
  use Queueable;
  use SerializesModels;

  public function __construct(public Request $request)
  {
  }

  public function build(): RequestMail
  {
    return $this
      ->subject("Заявка №{$this->request->getKey()}")
      ->to(config('mail.to.address'))
      ->view('emails.request');
  }
}
