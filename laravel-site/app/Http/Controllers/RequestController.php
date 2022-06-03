<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModalFormRequest;
use App\Mail\RequestMail;
use App\Models\Request;
use Mail;
use Illuminate\Routing\Controller as BaseController;

class RequestController extends BaseController
{
  public function __invoke(ModalFormRequest $modalFormRequest): void
  {
    $request = Request::create($modalFormRequest->validated());

    Mail::queue(new RequestMail($request));
  }
}
