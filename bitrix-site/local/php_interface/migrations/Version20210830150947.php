<?php

namespace Sprint\Migration;


use Bitrix\Main\Application;
use Bitrix\Main\IO\File;

class Version20210830150947 extends Version
{
    protected $description = "Редактирование областей";

    protected $moduleVersion = "3.28.7";

    public function up()
    {
        $documentRoot = Application::getDocumentRoot();
        if (! File::isFileExists($documentRoot . '/collabs/sect_subscribe_title.php')) {
            File::putFileContents($documentRoot . '/collabs/sect_subscribe_title.php', File::getFileContents(__DIR__ . '/stubs/sect_subscribe_title.php'));
        }
        if (! File::isFileExists($documentRoot . '/collabs/sect_subscribe_terms.php')) {
            File::putFileContents($documentRoot . '/collabs/sect_subscribe_terms.php', File::getFileContents(__DIR__ . '/stubs/sect_subscribe_terms.php'));
        }
        if (! File::isFileExists($documentRoot . '/collabs/sect_subscribe_text.php')) {
            File::putFileContents($documentRoot . '/collabs/sect_subscribe_text.php', File::getFileContents(__DIR__ . '/stubs/sect_subscribe_text.php'));
        }
        if (! File::isFileExists($documentRoot . '/poshtuchno/sect_subscribe_title.php')) {
            File::putFileContents($documentRoot . '/poshtuchno/sect_subscribe_title.php', File::getFileContents(__DIR__ . '/stubs/sect_subscribe_title.php'));
        }
        if (! File::isFileExists($documentRoot . '/poshtuchno/sect_subscribe_terms.php')) {
            File::putFileContents($documentRoot . '/poshtuchno/sect_subscribe_terms.php', File::getFileContents(__DIR__ . '/stubs/sect_subscribe_terms.php'));
        }
        if (! File::isFileExists($documentRoot . '/poshtuchno/sect_subscribe_text.php')) {
            File::putFileContents($documentRoot . '/poshtuchno/sect_subscribe_text.php', File::getFileContents(__DIR__ . '/stubs/sect_subscribe_text.php'));
        }
    }

    public function down()
    {
        $documentRoot = Application::getDocumentRoot();
        if (File::isFileExists($documentRoot . '/collabs/sect_subscribe_title.php')) {
            File::deleteFile($documentRoot . '/collabs/sect_subscribe_title.php');
        }
        if (File::isFileExists($documentRoot . '/collabs/sect_subscribe_terms.php')) {
            File::deleteFile($documentRoot . '/collabs/sect_subscribe_terms.php');
        }
        if (File::isFileExists($documentRoot . '/collabs/sect_subscribe_text.php')) {
            File::deleteFile($documentRoot . '/collabs/sect_subscribe_text.php');
        }
        if (File::isFileExists($documentRoot . '/poshtuchno/sect_subscribe_title.php')) {
            File::deleteFile($documentRoot . '/poshtuchno/sect_subscribe_title.php');
        }
        if (File::isFileExists($documentRoot . '/poshtuchno/sect_subscribe_terms.php')) {
            File::deleteFile($documentRoot . '/poshtuchno/sect_subscribe_terms.php');
        }
        if (File::isFileExists($documentRoot . '/poshtuchno/sect_subscribe_text.php')) {
            File::deleteFile($documentRoot . '/poshtuchno/sect_subscribe_text.php');
        }
    }
}
