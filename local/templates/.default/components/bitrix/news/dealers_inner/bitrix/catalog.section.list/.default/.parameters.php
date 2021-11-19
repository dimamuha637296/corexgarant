<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
    'IBLOCK_CATEGORIES' => array(
        'NAME' => GetMessage('IBLOCK_CATEGORIES'),
        'TYPE' => 'STRING',
        'DEFAULT' => '={$arParams["IBLOCK_CATEGORIES"]}',
        'PARENT' => 'BASE',
    ),
);



?>
