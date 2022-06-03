<?php

namespace Sprint\Migration;


use Bitrix\Main\Loader;
use CRubric;

class Version20210513144857 extends Version
{
    protected $description = "Рассылка для категории \"Поштучно\"";
    
    protected $moduleVersion = "3.28.3";
    
    public function up()
    {
        Loader::includeModule('subscribe');
        $result = CRubric::GetList([], ['CODE' => 'poshtuchno']);
        if (! $result || ! $result->Fetch()) {
            $rubric = new CRubric();
            $rubricFields = [
                "ACTIVE" => 'Y',
                'VISIBLE' => 'Y',
                "NAME" => 'Поштучно',
                "SORT" => 100,
                'CODE' => 'poshtuchno',
                "LID" => 's1'
            ];
            if (! $rubric->Add($rubricFields)) {
                throw new \Exception('Ошибка создания рассылки: ' . $rubric->LAST_ERROR);
            }
        }
    }
    
    public function down()
    {
        Loader::includeModule('subscribe');
        $result = CRubric::GetList([], ['CODE' => 'poshtuchno']);
        if ($result && $existedRubric = $result->Fetch()) {
            CRubric::Delete($existedRubric['ID']);
        }
    }
}
