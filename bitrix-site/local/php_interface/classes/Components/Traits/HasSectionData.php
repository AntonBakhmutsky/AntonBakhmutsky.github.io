<?php


namespace ITLeague\Components\Traits;

use Bitrix\Iblock;
use Bitrix\Iblock\Component\Tools;
use CASDiblockTools;
use ITLeague\Iblock\Section;
use ITLeague\Iblock\SectionTable;

trait HasSectionData
{
    protected ?Section $section;
    
    protected function setSection(array $filter = []): void
    {
        SectionTable::setIblockId($this->iblock->getId());
        if (! ($this->section = SectionTable::query()
            ->setFilter(
                array_merge(
                    $filter,
                    [
                        '=ACTIVE' => 'Y',
                        '=CODE' => $this->request->get('section_code')
                    ]
                )
            )
            ->setSelect(['ID', 'NAME', 'IBLOCK_ID', 'UF_COLOR', 'CODE', 'DESCRIPTION', 'TIMESTAMP_X'])
            ->setLimit(1)
            ->fetchObject())) {
            Tools::process404('Раздел не найден!', true, true, true);
        }
        
        $this->checkLastModified($this->section->collectValues());
    }
}
