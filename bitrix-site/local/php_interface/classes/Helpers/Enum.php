<?php


namespace ITLeague\Helpers;


use CUserFieldEnum;

class Enum
{
    public static function getXmlId(?int $value): ?string
    {
        if (is_null($value) || ! ($enum = CUserFieldEnum::GetList([], ['ID' => $value])->Fetch())) {
            return null;
        }
        
        return $enum['XML_ID'];
    }
}
