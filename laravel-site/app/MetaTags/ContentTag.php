<?php


namespace App\MetaTags;


use Butschster\Head\Contracts\MetaTags\Entities\TagInterface;

abstract class ContentTag implements TagInterface
{
  public function __construct(protected string $content)
  {
  }

  abstract public function toHtml(): string;

  public function getPlacement(): string
  {
    return 'body';
  }

  public function __toString(): string
  {
    return $this->toHtml();
  }
}
