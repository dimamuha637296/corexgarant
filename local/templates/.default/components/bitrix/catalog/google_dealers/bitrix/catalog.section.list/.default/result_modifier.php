<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


$cp = $this->__component;
if (is_object($cp))
{
$cp->arResult['SECTION_NAME'] = $arResult['SECTION_NAME'] = $arResult['SECTION']['NAME'];
$cp->SetResultCacheKeys(array( 'SECTION_NAME'));
}
?>