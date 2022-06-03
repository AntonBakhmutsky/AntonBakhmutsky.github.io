<?php


namespace App\MetaTags;


use Butschster\Head\Contracts\MetaTags\Entities\TagInterface;
use Butschster\Head\MetaTags\Meta;
use JetBrains\PhpStorm\Pure;

class CallTouch implements TagInterface
{

  public function __construct(private string $modId)
  {
  }

  #[Pure]
  public function toHtml(): string
  {
    return sprintf(
      <<<TAG
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript"> (function(w,d,n,c){w.CalltouchDataObject=n;w[n]=function(){w[n]
["callbacks"].push(arguments)}; if(!w[n]["callbacks"]){w[n]["callbacks"]=[]}w[n]["loaded"]=false; if(typeof c!=="object"){c=[c]}w[n]["counters"]=c;for(var i=0;i<c.length;i+=1){p(c[i])} function p(cId){var a=d.getElementsByTagName("script")
[0], s=d.createElement("script"),i=function(){a.parentNode.insertBefore(s,a)}; s.type="text/javascript";s.async=true;s.src="https://mod.calltouch.ru/init.js?id="+cId; if(w.opera=="[object Opera]"){d.addEventListener("DOMContentLoaded",i,false)}else{i()}} })(window,document,"ct","%s")</script>
<script>window.ct('modules','widgets','subscribeToEvent',[{object:'request',action:'create',callback:function(event){if (event.data.widgetType=='request'){ym(53579479,'reachGoal','calltouch-smart-request');}}}])</script>
TAG
      ,
      $this->modId
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
