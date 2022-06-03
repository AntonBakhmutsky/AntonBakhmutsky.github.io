<?

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (! function_exists('getSliderForItem')) {
    function getSliderForItem(&$item, $propertyCode, $addDetailToSlider)
    {
        $result = [];
        
        if (! empty($item) && is_array($item)) {
            if (
                '' != $propertyCode &&
                isset($item['PROPERTIES'][$propertyCode]) &&
                'F' == $item['PROPERTIES'][$propertyCode]['PROPERTY_TYPE']
            ) {
                if ('MORE_PHOTO' == $propertyCode && isset($item['MORE_PHOTO']) && ! empty($item['MORE_PHOTO'])) {
                    foreach ($item['MORE_PHOTO'] as &$onePhoto) {
                        $result[] = [
                            'ID' => intval($onePhoto['ID']),
                            'SRC' => $onePhoto['SRC'],
                            'WIDTH' => intval($onePhoto['WIDTH']),
                            'HEIGHT' => intval($onePhoto['HEIGHT'])
                        ];
                    }
                    unset($onePhoto);
                } else {
                    if (
                        isset($item['DISPLAY_PROPERTIES'][$propertyCode]['FILE_VALUE']) &&
                        ! empty($item['DISPLAY_PROPERTIES'][$propertyCode]['FILE_VALUE'])
                    ) {
                        $fileValues = (
                        isset($item['DISPLAY_PROPERTIES'][$propertyCode]['FILE_VALUE']['ID']) ?
                            [0 => $item['DISPLAY_PROPERTIES'][$propertyCode]['FILE_VALUE']] :
                            $item['DISPLAY_PROPERTIES'][$propertyCode]['FILE_VALUE']
                        );
                        foreach ($fileValues as &$oneFileValue) {
                            $result[] = [
                                'ID' => intval($oneFileValue['ID']),
                                'SRC' => $oneFileValue['SRC'],
                                'WIDTH' => intval($oneFileValue['WIDTH']),
                                'HEIGHT' => intval($oneFileValue['HEIGHT'])
                            ];
                        }
                        if (isset($oneFileValue)) {
                            unset($oneFileValue);
                        }
                    } else {
                        $propValues = $item['PROPERTIES'][$propertyCode]['VALUE'];
                        if (! is_array($propValues)) {
                            $propValues = [$propValues];
                        }
                        
                        foreach ($propValues as &$oneValue) {
                            $oneFileValue = CFile::GetFileArray($oneValue);
                            if (isset($oneFileValue['ID'])) {
                                $result[] = [
                                    'ID' => intval($oneFileValue['ID']),
                                    'SRC' => $oneFileValue['SRC'],
                                    'WIDTH' => intval($oneFileValue['WIDTH']),
                                    'HEIGHT' => intval($oneFileValue['HEIGHT'])
                                ];
                            }
                        }
                        if (isset($oneValue)) {
                            unset($oneValue);
                        }
                    }
                }
            }
            if ($addDetailToSlider || empty($result)) {
                if (! empty($item['DETAIL_PICTURE'])) {
                    if (! is_array($item['DETAIL_PICTURE'])) {
                        $item['DETAIL_PICTURE'] = CFile::GetFileArray($item['DETAIL_PICTURE']);
                    }
                    if (isset($item['DETAIL_PICTURE']['ID'])) {
                        array_unshift(
                            $result,
                            [
                                'ID' => intval($item['DETAIL_PICTURE']['ID']),
                                'SRC' => $item['DETAIL_PICTURE']['SRC'],
                                'WIDTH' => intval($item['DETAIL_PICTURE']['WIDTH']),
                                'HEIGHT' => intval($item['DETAIL_PICTURE']['HEIGHT'])
                            ]
                        );
                    }
                }
            }
        }
        return $result;
    }
}
?>
