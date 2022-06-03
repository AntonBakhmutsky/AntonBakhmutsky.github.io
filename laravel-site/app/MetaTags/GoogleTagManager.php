<?php


namespace App\MetaTags;


use Butschster\Head\Contracts\MetaTags\Entities\TagInterface;
use Butschster\Head\MetaTags\Meta;
use JetBrains\PhpStorm\Pure;

class GoogleTagManager implements TagInterface
{
  public function __construct(private string $counterId, private bool $noscript = false)
  {
  }

  #[Pure]
  public function toHtml(): string
  {
    if ($this->noscript) {
      return sprintf(
        <<<TAG
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=%s"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
TAG
        ,
        $this->counterId
      );
    } else {
      return sprintf(
        <<<TAG
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','%s');</script>
TAG
        ,
        $this->counterId
      );
    }
  }

  public function getPlacement(): string
  {
    if ($this->noscript) {
      return 'body';
    } else {
      return Meta::PLACEMENT_HEAD;
    }
  }
}
