<?php


namespace App\MetaTags;


class HtmlTag extends ContentTag
{
  public function toHtml(): string
  {
    return "<div class='content'><div class='container'>{$this->content}</div></div>";
  }
}
