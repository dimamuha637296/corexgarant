<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//delayed function must return a string
__IncludeLang(dirname(__FILE__).'/lang/'.LANGUAGE_ID.'/'.basename(__FILE__));
$arParams['COLUM_GRID'] = isset($arParams['COLUM_MAX']) ? intval($arParams['COLUM_MAX']) : COption::GetOptionString("db.base","COLUM_MAX", "12");
$curPage = $GLOBALS['APPLICATION']->GetCurPage(false, false);
if(empty($arResult))
	return "";

$strReturn = '<nav><ol class="breadcrumb list-reset" itemscope itemtype="http://schema.org/BreadcrumbList">';
$i=1;
for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
	if($index > 0)
		$strReturn .= '';

	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$title = strip_tags(htmlspecialchars_decode($title));
	if($arResult[$index]["LINK"] <> "" && $arResult[$index]["LINK"] != $curPage){
		$strReturn .= '<li class="breadcrumb-item'.( $index >= $itemSize - 1 ? ' active"': '" typeof="v:Breadcrumb"').' itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
							<a itemprop="item" href="'.$arResult[$index]["LINK"].'" title="'.$title.'"><span itemprop="name">'.$title.'</span></a>
							<meta itemprop="position" content="'.$i.'" />
						</li>';
	}else{
		$strReturn .= '
			<li class="breadcrumb-item'.( $index >= $itemSize - 1 ? ' active': '').'" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<span itemprop="name">'.cutString($title, 60).'</span>
				<meta itemprop="position" content="'.$i.'" />
			</li>';
	}
	$i++;
}

$strReturn .= '</ol></nav>';
return $strReturn;
?>
