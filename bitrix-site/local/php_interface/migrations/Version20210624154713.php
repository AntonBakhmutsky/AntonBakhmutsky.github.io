<?php

namespace Sprint\Migration;


use Bitrix\Main\Application;
use Bitrix\Main\IO\File;

class Version20210624154713 extends Version
{
    protected $description = "Страница размеров";
    
    protected $moduleVersion = "3.28.7";
    
    public function up()
    {
        $documentRoot = Application::getDocumentRoot();
        if (! File::isFileExists($documentRoot . '/include/sizes-bottom.php')) {
            File::putFileContents($documentRoot . '/include/sizes-bottom.php', File::getFileContents(__DIR__ . '/stubs/include/sizes-bottom.php'));
        }
        if (! File::isFileExists($documentRoot . '/include/sizes-top.php')) {
            File::putFileContents($documentRoot . '/include/sizes-top.php', File::getFileContents(__DIR__ . '/stubs/include/sizes-top.php'));
        }
    }
    
    public function down()
    {
        $documentRoot = Application::getDocumentRoot();
        if (File::isFileExists($documentRoot . '/include/sizes-bottom.php')) {
            File::deleteFile($documentRoot . '/include/sizes-bottom.php');
        }
        if (File::isFileExists($documentRoot . '/include/sizes-top.php')) {
            File::deleteFile($documentRoot . '/include/sizes-top.php');
        }
    }
}
