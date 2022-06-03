<?php

namespace App\Http\Controllers;

use App\Models\Cemetery;
use Butschster\Head\Contracts\MetaTags\MetaInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContactsController extends Controller
{
  protected string $sectionName = 'Контакты';

  protected Collection $cemeteries;

  public function __construct(MetaInterface $meta)
  {
    parent::__construct($meta);
    $this->cemeteries = Cemetery::active()->sorted()->get();
  }

  public function index(): View
  {
    return $this->view('pages.contacts.index', ['cemeteries' => $this->cemeteries]);
  }

  public function cemetery(string $cemeteryCode): View
  {
    if (! ($cemetery = $this->cemeteries->firstWhere('code', $cemeteryCode))) {
      throw (new ModelNotFoundException())->setModel(Cemetery::class, $cemeteryCode);
    }

    $this->setItemMeta($cemetery);
    return $this->view('pages.contacts.cemetery', ['cemeteries' => $this->cemeteries, 'cemetery' => $cemetery]);
  }
}
