<?php

namespace Sprint\Migration;


use Bitrix\Main\Application;
use Bitrix\Main\IO\File;

class Version20210518120904 extends Version
{
    protected $description = "Статичные страницы";
    
    protected $moduleVersion = "3.28.3";
    
    public function up()
    {
        $documentRoot = Application::getDocumentRoot();
        if (! File::isFileExists($documentRoot . '/include/delivery.php')) {
            File::putFileContents($documentRoot . '/include/delivery.php', File::getFileContents(__DIR__ . '/stubs/include/delivery.php'));
        }
        if (! File::isFileExists($documentRoot . '/include/payment.php')) {
            File::putFileContents($documentRoot . '/include/payment.php', File::getFileContents(__DIR__ . '/stubs/include/payment.php'));
        }
        if (! File::isFileExists($documentRoot . '/include/contacts.php')) {
            File::putFileContents($documentRoot . '/include/contacts.php', File::getFileContents(__DIR__ . '/stubs/include/contacts.php'));
        }
        if (! File::isFileExists($documentRoot . '/include/requisites.php')) {
            File::putFileContents($documentRoot . '/include/requisites.php', File::getFileContents(__DIR__ . '/stubs/include/requisites.php'));
        }
    }
    
    public function down()
    {
        $documentRoot = Application::getDocumentRoot();
        if (File::isFileExists($documentRoot . '/include/payment.php')) {
            File::deleteFile($documentRoot . '/include/payment.php');
        }
        if (File::isFileExists($documentRoot . '/include/delivery.php')) {
            File::deleteFile($documentRoot . '/include/delivery.php');
        }
        if (File::isFileExists($documentRoot . '/include/contacts.php')) {
            File::deleteFile($documentRoot . '/include/contacts.php');
        }
        if (File::isFileExists($documentRoot . '/include/requisites.php')) {
            File::deleteFile($documentRoot . '/include/requisites.php');
        }
    }
}
