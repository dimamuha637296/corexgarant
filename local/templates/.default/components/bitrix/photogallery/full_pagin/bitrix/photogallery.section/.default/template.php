<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?
if (!$this->__component->__parent || strpos($this->__component->__parent->__name, "photogallery") === false)
{
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/photogallery/templates/.default/style.css');
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/photogallery/templates/.default/themes/gray/style.css');
}

$GLOBALS['APPLICATION']->AddHeadScript("/bitrix/components/bitrix/photogallery.section.list/templates/.default/script.js");

$res = $arResult["SECTION"];
?>
<div class="photo-album-item photo-album-<?=($res["ACTIVE"] != "Y" ? "nonactive" : "active")?> <?=(
	!empty($res["PASSWORD"]) ? "photo-album-password" : "")?>" id="photo_album_info_<?=$res["ID"]?>" <?
	if ($res["ACTIVE"] != "Y" || !empty($res["PASSWORD"]))
	{
		$sTitle = GetMessage("P_ALBUM_IS_NOT_ACTIVE");
		if ($res["ACTIVE"] != "Y" && !empty($res["PASSWORD"]))
			$sTitle = GetMessage("P_ALBUM_IS_NOT_ACTIVE_AND_PASSWORDED");
		elseif (!empty($res["PASSWORD"]))
			$sTitle = GetMessage("P_ALBUM_IS_PASSWORDED");
		?> title="<?=$sTitle?>" <?
	}
	?>>
</div>

<?if ($arParams["PERMISSION"] >= "U"):?>
	<noindex>
	<div class="photo-top-controls">
		<a rel="nofollow" class="photo-control-album-edit" href="<?=$arResult["SECTION"]["EDIT_LINK"]?>"><?=GetMessage("P_SECTION_EDIT")?></a>
		<a rel="nofollow" href="<?=$arResult["SECTION"]["UPLOAD_LINK"]?>" target="_self"><?=GetMessage("P_UPLOAD")?></a>
	</div>
	</noindex>
<?endif;?>
