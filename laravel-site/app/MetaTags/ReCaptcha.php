<?php


namespace App\MetaTags;


use Butschster\Head\Contracts\MetaTags\Entities\TagInterface;
use Butschster\Head\MetaTags\Meta;
use JetBrains\PhpStorm\Pure;

class ReCaptcha implements TagInterface
{

  public function __construct(private string $key)
  {
  }

  #[Pure]
  public function toHtml(): string
  {
    return sprintf(
      <<<TAG
<script type="text/javascript">!function(e,t){const n=t.getElementsByTagName("script")[0],o=t.createElement("script"),r=function(){setTimeout(n.parentNode.insertBefore(o,n),100)};o.type="text/javascript",o.defer=!0,o.src="https://www.google.com/recaptcha/api.js?render=6Lc1lVMaAAAAAPG2NX8Gs-VWMqienTiFil04kAvv","[object Opera]"===e.opera?t.addEventListener("DOMContentLoaded",r,!1):r()}(window,document);</script>
TAG
      ,
      $this->key
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
