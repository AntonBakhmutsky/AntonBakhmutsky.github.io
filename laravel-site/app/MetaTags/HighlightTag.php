<?php


namespace App\MetaTags;


class HighlightTag extends ContentTag
{
  public function toHtml(): string
  {
    return "<h1>{$this->content}</h1>";
  }
}
