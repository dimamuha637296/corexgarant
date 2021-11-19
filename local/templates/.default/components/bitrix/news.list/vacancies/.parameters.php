<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"BUTTON_NAME" => Array(
        "PARENT" => "BASE",
		"NAME" =>GetMessage('T_IBLOCK_BUTTON_NAME'),
		"TYPE" => "STRING",
		"DEFAULT" => "Откликнуться на вакансию",
	),
    "NO_RESULT_TEXT" => Array(
        "PARENT" => "BASE",
        "NAME" =>GetMessage('T_IBLOCK_NO_RESULT_TEXT'),
        "TYPE" => "STRING",
        "COLS" => 50,
        "ROWS" => 50,
        "DEFAULT" => 'Сейчас в нашей компании нет открытых вакансий. Если вы хотите заявить о себе, просто <span class="lnk-pseudo" data-toggle="modal" data-target="#FRM_vacancies">отправьте резюме</span> и, когда насупит пора, мы будем иметь вас в виду.',
    ),
);
?>
