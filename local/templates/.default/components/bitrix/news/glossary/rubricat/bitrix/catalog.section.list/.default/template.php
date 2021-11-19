<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? //pr($arParams);
	CModule::IncludeModule("iblock");
	$rsIBlock = CIBlock::GetList(array(), array(
		"ACTIVE" => "Y",
		"ID" => $arParams["IBLOCK_ID"],
	));
	$arResult['IBLOCK'] = $rsIBlock->GetNext();
	$arResult['IBLOCK']['LIST_PAGE_URL'] = str_replace("#SITE_DIR#", $arResult['IBLOCK']['LANG_DIR'], $arResult['IBLOCK']['LIST_PAGE_URL']);
	
	$CURRENT_DEPTH = 0;
?>
	<div class="abc">
	<ul class="lang-list">
		<?foreach($arResult["SECTIONS"] as $arSection):?>
			<li class="item">
			<?if($arSection["ELEMENT_CNT"] > 0):?>
				<?if($arParams['CUR_SECTION_ID'] == $arSection["ID"]):?>
					<span class="letter _active"><?=$arSection["NAME"]?></span>
				<?else:?>
					<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="letter "><?=$arSection["NAME"]?></a>
				<?endif;?>
			<?else:?>
				<span class="letter _disable"><?=$arSection["NAME"]?></span>
			<?endif;?>
			</li>
		<?$CURRENT_DEPTH = $arSection['DEPTH_LEVEL']; endforeach;?>
	</ul>
</div>
<?/*/?><pre><?print_r($arResult )?></pre><?//*/?>