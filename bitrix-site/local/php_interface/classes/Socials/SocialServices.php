<?php


namespace ITLeague\Socials;


use Bitrix\Main\Application;

class SocialServices
{
    public static function getDefaultIconPath(): string
    {
        return Application::getDocumentRoot() . SITE_TEMPLATE_PATH . "/assets/img/global/facebook.svg";
    }
    
    public static function onAuthServicesBuildList(): array
    {
        return [
            "ID" => "Facebook",
            "CLASS" => Facebook::class,
            "NAME" => "Facebook",
            "ICON" => "facebook",
        ];
    }
}
