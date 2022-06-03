<?php

namespace Sprint\Migration;


use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;

class Version20210514172732 extends Version
{
    protected $description = "Дефолтные меню и включаемые области";
    
    protected $moduleVersion = "3.28.3";
    
    public function up()
    {
        $documentRoot = Application::getDocumentRoot();
        if (! Directory::isDirectoryExists($documentRoot . '/include')) {
            Directory::createDirectory($documentRoot . '/include');
        }
        
        if (! File::isFileExists($documentRoot . '/include/logo.php')) {
            File::putFileContents($documentRoot . '/include/logo.php', File::getFileContents(__DIR__ . '/stubs/include/logo.php'));
        }
        
        if (! File::isFileExists($documentRoot . '/include/copyright.php')) {
            File::putFileContents($documentRoot . '/include/copyright.php', File::getFileContents(__DIR__ . '/stubs/include/copyright.php'));
        }
        
        if (! File::isFileExists($documentRoot . '/include/author.php')) {
            File::putFileContents($documentRoot . '/include/author.php', File::getFileContents(__DIR__ . '/stubs/include/author.php'));
        }
        
        if (! File::isFileExists($documentRoot . '/include/tips/merch_bottom.php')) {
            File::putFileContents($documentRoot . '/include/tips/merch_bottom.php', File::getFileContents(__DIR__ . '/stubs/include/tips/merch_bottom.php'));
        }
        
        if (! File::isFileExists($documentRoot . '/include/tips/merch_top.php')) {
            File::putFileContents($documentRoot . '/include/tips/merch_top.php', File::getFileContents(__DIR__ . '/stubs/include/tips/merch_top.php'));
        }
        
        if (! File::isFileExists($documentRoot . '/.bottom.menu.php')) {
            File::putFileContents($documentRoot . '/.bottom.menu.php', File::getFileContents(__DIR__ . '/stubs/.bottom.menu.php'));
        }
        
        if (! File::isFileExists($documentRoot . '/.top.menu.php')) {
            File::putFileContents($documentRoot . '/.top.menu.php', File::getFileContents(__DIR__ . '/stubs/.top.menu.php'));
        }
    }
    
    public function down()
    {
        $documentRoot = Application::getDocumentRoot();
        if (Directory::isDirectoryExists($documentRoot . '/include')) {
            Directory::deleteDirectory($documentRoot . '/include');
        }
        
        if (File::isFileExists($documentRoot . '/.top.menu.php')) {
            File::deleteFile($documentRoot . '/.top.menu.php');
        }
        
        if (File::isFileExists($documentRoot . '/.bottom.menu.php')) {
            File::deleteFile($documentRoot . '/.bottom.menu.php');
        }
    }
}
