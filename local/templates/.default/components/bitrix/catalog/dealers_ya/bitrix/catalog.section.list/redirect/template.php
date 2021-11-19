<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?/*/?><pre><?print_r($_SESSION);?></pre><?//*/?>
<?/*/?><pre><?print_r($arResult);?></pre><?//*/?>
<?

LocalRedirect($arResult["SECTIONS"][0]['SECTION_PAGE_URL'], false, '301 Moved permanently');
?>