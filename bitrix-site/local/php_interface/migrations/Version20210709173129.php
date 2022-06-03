<?php

namespace Sprint\Migration;


use Bitrix\Main\Application;
use Bitrix\Main\IO\File;

class Version20210709173129 extends Version
{
    protected $description = "Страница размеров 2";

    protected $moduleVersion = "3.28.7";

    public function up()
    {
        $documentRoot = Application::getDocumentRoot();
        if (! File::isFileExists($documentRoot . '/include/sizes-first.php')) {
            File::putFileContents($documentRoot . '/include/sizes-first.php', File::getFileContents(__DIR__ . '/stubs/include/sizes-first.php'));
        }
        if (! File::isFileExists($documentRoot . '/include/sizes-second.php')) {
            File::putFileContents($documentRoot . '/include/sizes-second.php', File::getFileContents(__DIR__ . '/stubs/include/sizes-second.php'));
        }
        if (! File::isFileExists($documentRoot . '/include/sizes-third.php')) {
            File::putFileContents($documentRoot . '/include/sizes-third.php', File::getFileContents(__DIR__ . '/stubs/include/sizes-third.php'));
        }
        if (! File::isFileExists($documentRoot . '/include/sizes-forth.php')) {
            File::putFileContents($documentRoot . '/include/sizes-forth.php', File::getFileContents(__DIR__ . '/stubs/include/sizes-forth.php'));
        }
        if (! File::isFileExists($documentRoot . '/include/sizes-fifth.php')) {
            File::putFileContents($documentRoot . '/include/sizes-fifth.php', File::getFileContents(__DIR__ . '/stubs/include/sizes-fifth.php'));
        }
    }

    public function down()
    {
        $documentRoot = Application::getDocumentRoot();
        if (File::isFileExists($documentRoot . '/include/sizes-first.php')) {
            File::deleteFile($documentRoot . '/include/sizes-first.php');
        }
        if (File::isFileExists($documentRoot . '/include/sizes-second.php')) {
            File::deleteFile($documentRoot . '/include/sizes-second.php');
        }
        if (File::isFileExists($documentRoot . '/include/sizes-third.php')) {
            File::deleteFile($documentRoot . '/include/sizes-third.php');
        }
        if (File::isFileExists($documentRoot . '/include/sizes-forth.php')) {
            File::deleteFile($documentRoot . '/include/sizes-forth.php');
        }
        if (File::isFileExists($documentRoot . '/include/sizes-fifth.php')) {
            File::deleteFile($documentRoot . '/include/sizes-fifth.php');
        }
    }
}
