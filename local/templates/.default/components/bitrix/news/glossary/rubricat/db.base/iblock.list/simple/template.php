<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	if (count($arResult['ITEMS']) < 1)
		return;
	
	$tmpArr = $arResult['SECTION']['PATH'];
	$arResult['CUR_SECTION'] = array_pop($tmpArr);
	
	$arParams['DELIN_CNT'] = 3;
	$cnt = count($arResult["ITEMS"]);
	
	$arParams['DELIN'] = ceil($cnt / $arParams['DELIN_CNT']);
?>
<span class="big-letter"><?=$arResult['CUR_SECTION']['NAME']?></span>
	<ul class="links-list" >
<?$i = 1; foreach($arResult["ITEMS"] as $arElement):
	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
		<li id="<?=$this->GetEditAreaId($arElement['ID']);?>" class="links-item"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>" data-fix="<?=$arElement['ID']?>" data-href="elem-<?=$arElement['ID']?>"><?=$arElement["NAME"]?></a></li>
	<?if($i % $arParams['DELIN'] == 0):?></ul><ul class="links-list"><?endif;?>
<?$i = $i + 1; endforeach;?>	
	</ul>	
<?/*/?><pre><?print_r($arParams)?></pre><?//*/?>
<?/*/?><pre><?print_r($arResult)?></pre><?//*/?>