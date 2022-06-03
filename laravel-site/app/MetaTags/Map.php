<?php


namespace App\MetaTags;


use Butschster\Head\Contracts\MetaTags\Entities\TagInterface;
use Butschster\Head\MetaTags\Meta;
use JetBrains\PhpStorm\Pure;

class Map implements TagInterface
{
  public function __construct(private string $src)
  {
  }

  #[Pure]
  public function toHtml(): string
  {
    return sprintf(
      <<<TAG
        <script type="text/javascript">const o=new IntersectionObserver(e=>{if(e[0].isIntersecting){const t=document.createElement("script");t.src="%s",t.defer=!0,document.body.appendChild(t),o.unobserve(e[0].target)}},{threshold:.2});o.observe(document.querySelector(".map"))</script>
      TAG
      ,
      $this->src
    );

  }

  /**
   * @inheritDoc
   */
  public function getPlacement(): string
  {
    return Meta::PLACEMENT_FOOTER;
  }
}
