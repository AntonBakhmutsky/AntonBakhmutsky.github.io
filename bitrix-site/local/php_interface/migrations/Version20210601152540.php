<?php

namespace Sprint\Migration;


use Bitrix\Main\Application;
use Bitrix\Main\IO\File;

class Version20210601152540 extends Version
{
    protected $description = "Остальные статичные страницы";

    protected $moduleVersion = "3.28.7";

    public function up()
    {
        $documentRoot = Application::getDocumentRoot();
        if (! File::isFileExists($documentRoot . '/include/exchange.php')) {
            File::putFileContents($documentRoot . '/include/exchange.php', File::getFileContents(__DIR__ . '/stubs/include/exchange.php'));
        }
        if (! File::isFileExists($documentRoot . '/include/privacy.php')) {
            File::putFileContents($documentRoot . '/include/privacy.php', File::getFileContents(__DIR__ . '/stubs/include/privacy.php'));
        }
        if (! File::isFileExists($documentRoot . '/include/offer.php')) {
            File::putFileContents($documentRoot . '/include/offer.php', File::getFileContents(__DIR__ . '/stubs/include/offer.php'));
        }
        if (! File::isFileExists($documentRoot . '/include/terms.php')) {
            File::putFileContents($documentRoot . '/include/terms.php', File::getFileContents(__DIR__ . '/stubs/include/terms.php'));
        }
    }

    public function down()
    {
        $documentRoot = Application::getDocumentRoot();
        if (File::isFileExists($documentRoot . '/include/exchange.php')) {
            File::deleteFile($documentRoot . '/include/exchange.php');
        }
        if (File::isFileExists($documentRoot . '/include/privacy.php')) {
            File::deleteFile($documentRoot . '/include/privacy.php');
        }
        if (File::isFileExists($documentRoot . '/include/offer.php')) {
            File::deleteFile($documentRoot . '/include/offer.php');
        }
        if (File::isFileExists($documentRoot . '/include/terms.php')) {
            File::deleteFile($documentRoot . '/include/terms.php');
        }
    }
}
