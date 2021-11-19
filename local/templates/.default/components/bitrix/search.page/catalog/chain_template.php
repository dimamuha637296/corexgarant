<?
//Navigation chain template
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arChainBody = array();

$i=0;foreach($arCHAIN as $key => $item)
{
	$count = count($arCHAIN)-1;
	if(strlen($item["LINK"])<strlen(SITE_DIR))
		continue;
	if($item["LINK"] <> "" && $i == $count)
		$arChainBody[] = '<a href="'.$item["LINK"].'">'.htmlspecialcharsex($item["TITLE"]).'</a>';
	$i++;
}
//pr($arCHAIN);
//pr($arCHAIN[count($arCHAIN)-1]);
//echo  count($arCHAIN)-1;
//echo $arCHAIN[count($arCHAIN)-1];
return implode('&nbsp;/&nbsp;', $arChainBody);
?>