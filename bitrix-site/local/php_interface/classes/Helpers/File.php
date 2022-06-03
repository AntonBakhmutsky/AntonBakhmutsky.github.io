<?php


namespace ITLeague\Helpers;


use CFile;

class File
{
    private array $fields;
    
    public function __construct(int $fileId)
    {
        $array = CFile::GetFileArray($fileId);
        $this->fields = is_array($array) ? $array : [];
    }
    
    public function getId(): int
    {
        return (int)$this->fields['ID'];
    }
    
    public function getSrc(): string
    {
        return $this->fields['SRC'] ?? '';
    }
    
    public function getOriginalName(): string
    {
        return $this->fields['ORIGINAL_NAME'] ?? '';
    }
}
