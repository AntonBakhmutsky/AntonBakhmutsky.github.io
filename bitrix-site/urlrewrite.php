<?php
$arUrlRewrite=array (
  0 => 
  array (
    'CONDITION' => '#^/collabs/([\\w\\d\\-]+)/([\\w\\d\\-]+)(/)?.*#',
    'RULE' => 'section_code=$1&element_code=$2',
    'ID' => '',
    'PATH' => '/collabs/element.php',
    'SORT' => 10,
  ),
  1 => 
  array (
    'CONDITION' => '#^/collabs/([\\w\\d\\-]+)(/)?.*#',
    'RULE' => 'section_code=$1',
    'ID' => '',
    'PATH' => '/collabs/section.php',
    'SORT' => 20,
  ),
  2 => 
  array (
    'CONDITION' => '#^/poshtuchno/([\\w\\d\\-]+)(/)?.*#',
    'RULE' => 'element_code=$1',
    'ID' => '',
    'PATH' => '/poshtuchno/element.php',
    'SORT' => 30,
  ),
  3 => 
  array (
    'CONDITION' => '#^/personal/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.section',
    'PATH' => '/personal/index.php',
    'SORT' => 100,
  ),
);
