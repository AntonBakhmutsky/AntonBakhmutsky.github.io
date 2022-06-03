<?php


namespace App\Http\Admin\Controllers;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use SleepingOwl\Admin\Contracts\AdminInterface;
use SleepingOwl\Admin\Http\Controllers\AdminController;

abstract class Controller extends AdminController
{
  public function __construct(Request $request, AdminInterface $admin, Application $application)
  {
    parent::__construct($request, $admin, $application);
    foreach ($this->breadCrumbsData as $breadcrumb) {
      $this->registerBreadcrumb($breadcrumb['title'], $breadcrumb['parent'], $breadcrumb['id'], $breadcrumb['url']);
    }
  }
}
