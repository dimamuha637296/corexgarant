<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/********************************************************************
				Input params
********************************************************************/
$arParams["ALBUM_PHOTO_SIZE"] = intVal($arParams["ALBUM_PHOTO_SIZE"]);

/********************************************************************
				/Input params
********************************************************************/

// TODO: get rid of this
CAjax::Init();
// TODO: get rid of this too
$GLOBALS['APPLICATION']->AddHeadScript('/bitrix/js/main/utils.js');

$GLOBALS['APPLICATION']->AddHeadScript('/bitrix/components/bitrix/photogallery/templates/.default/script.js');
if (!$this->__component->__parent || strpos($this->__component->__parent->__name, "photogallery") === false):
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/photogallery/templates/.default/style.css');
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/photogallery/templates/.default/themes/gray/style.css');
?>

<?
endif;
if (!function_exists("__photo_cut_long_words"))
{
	function __photo_cut_long_words($str)
	{
		$MaxStringLen = 5;
		if (strLen($str) > $MaxStringLen)
			$str = preg_replace("/([^ \n\r\t\x01]{".$MaxStringLen."})/is".BX_UTF_PCRE_MODIFIER, "\\1<WBR/>&shy;", $str);
		return $str;
	}
}
if (!function_exists("__photo_part_long_words"))
{
	function __photo_part_long_words($str)
	{
		$word_separator = "\s.,;:!?\#\-\*\|\[\]\(\)\{\}";
		if (strLen(trim($str)) > 5)
		{
			$str = str_replace(
				array(chr(1), chr(2), chr(3), chr(4), chr(5), chr(6), chr(7), chr(8),
					"&amp;", "&lt;", "&gt;", "&quot;", "&nbsp;", "&copy;", "&reg;", "&trade;",
					chr(34), chr(39)),
				array("", "", "", "", "", "", "", "",
					chr(1), "<", ">", chr(2), chr(3), chr(4), chr(5), chr(6),
					chr(7), chr(8)),
				$str);
			$str = preg_replace("/(?<=[".$word_separator."]|^)(([^".$word_separator."]+))(?=[".$word_separator."]|$)/ise".BX_UTF_PCRE_MODIFIER,
				"__photo_cut_long_words('\\2')", $str);

			$str = str_replace(
				array(chr(1), "<", ">", chr(2), chr(3), chr(4), chr(5), chr(6), chr(7), chr(8), "&lt;WBR/&gt;", "&lt;WBR&gt;", "&amp;shy;"),
				array("&amp;", "&lt;", "&gt;", "&quot;", "&nbsp;", "&copy;", "&reg;", "&trade;", chr(34), chr(39), "<WBR/>", "<WBR/>", "&shy;"),
				$str);
		}
		return $str;
	}
}
?>

<?if (empty($arResult["SECTIONS"])):?>
<div class="photo-info-box photo-info-box-sections-list-empty">
	<div class="photo-info-box-inner"><?=GetMessage("P_EMPTY_DATA")?></div>
</div>
<?
return false;
endif;?>


<?$arResult['CNT'] = count($arResult['SECTIONS']) - 1;
if ($arResult['CNT'] < 0)
	return;
?>
<?/*/?>
<div class="c_about_gallery break-word row-clear">
	<div class="row" id="db-gallery-items-<?=$arResult['ID']?>">
		<?foreach($arResult["SECTIONS"] as $arSection):
			$this->AddEditAction('section_'.$arSection['ID'], $arSection['ADD_ELEMENT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_ADD"), array('ICON' => 'bx-context-toolbar-create-icon'));
			$this->AddEditAction('section_'.$arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
			$this->AddDeleteAction('section_'.$arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BPS_SECTION_DELETE_CONFIRM')));
			?>
			<div id="<?=$this->GetEditAreaId('section_'.$arSection['ID']);?>" class="item  col-4">
				<?if($arSection["ELEMENTS_CNT_ALL"] >0):?>
				<a class="link" title="<?=$arSection['NAME']?>" href="<?=$arSection['LINK']?>">
				<?endif;?>
					<div class="pic">
						<div class="pic_i">
							<img class="img"  src="<?=$arSection['SECTION_IMG']['SRC'];?>" alt="<?=($arSection['PREVIEW_PICTURE']['DESCRIPTION']? $arSection['PREVIEW_PICTURE']['DESCRIPTION'] : $arSection['NAME'])?>" title="<?=$arSection['PREVIEW_IMG']['TITLE']?>">
						</div>
					</div>
					<div class="text ptsans-r">
						<div class="tag">
							<?=$arSection["ELEMENTS_CNT"]?> <?=GetMessage("P_SECT_PHOTOS")?>
						</div>
						<div class="wrap">
							<?if($arSection["UF_DATE"] || strlen($arSection["UF_DOP_NAME"])>0):?>
								<div class="caption-text">
									<?$arr = ParseDateTime($arSection["UF_DATE"]);?> 
									<?=$arr["DD"]?> <?=GetMessage("FULL_MONTH_".$arr["MM"])?> <?=$arr["YYYY"]?> 
									<?if($arSection["UF_DOP_NAME"] && $arSection["UF_DATE"]):?>
										/ <?=$arSection["UF_DOP_NAME"]?>
									<?elseif(strlen($arSection["UF_DOP_NAME"])>0):?>
										<?=$arSection["UF_DOP_NAME"]?>
									<?endif;?>
								</div>
							<?endif;?>
							<div class="title">
								<?=$arSection['NAME']?>
							</div>
						</div>
					</div>
				<?if($arSection["ELEMENTS_CNT_ALL"] >0):?>
                </a>
                <?endif;?>
            </div>
		<?endforeach;?>
	</div>
</div>
<?//*/?>

<?//*/?>
<div class="c_about_gallery break-word row-clear">

	<div class="row " id="db-gallery-items-<?=$arResult['ID']?>">
		<?foreach($arResult["SECTIONS"] as $res):?>
		<?			
			$res["ORIG_NAME"] = $res["NAME"];
			$res["NAME"] = __photo_part_long_words($res["NAME"]);
		?>
	
		<div  id="photo_album_info_<?=$res["ID"]?>" class="item  col-4" <?
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
	
	
			<?if ($res["ACTIVE"] != "Y" || !empty($res["PASSWORD"])){
				$sTitle = GetMessage("P_ALBUM_IS_NOT_ACTIVE");
				if ($res["ACTIVE"] != "Y" && !empty($res["PASSWORD"]))
					$sTitle = GetMessage("P_ALBUM_IS_NOT_ACTIVE_AND_PASSWORDED");
				elseif (!empty($res["PASSWORD"]))
					$sTitle = GetMessage("P_ALBUM_IS_PASSWORDED");
				$sTitle = ' - '.$sTitle;
			}?>
			
			<?if($res["ELEMENTS_CNT_ALL"] >0):?>
				<a class="link" title="<?=$res['NAME']?>" href="<?=$res['LINK']?>">
			<?endif;?>
			<div class="pic">
				<div class="pic_i">
					<img class="img"  src="<?=$res['SECTION_IMG']['SRC'];?>" alt="<?=($res['PREVIEW_PICTURE']['DESCRIPTION']? $res['PREVIEW_PICTURE']['DESCRIPTION'] : $res['NAME'])?>" title="<?=$res['PREVIEW_IMG']['TITLE']?>">
				</div>
			</div>
			<div class="text ptsans-r">
				<div class="tag">
					<?=$res["ELEMENTS_CNT"]?> <?=GetMessage("P_SECT_PHOTOS")?>
				</div>
				<div class="wrap">
					<?if($res["UF_DATE"] || strlen($res["UF_DOP_NAME"])>0):?>
						<div class="caption-text">
							<?$arr = ParseDateTime($res["UF_DATE"]);?> 
							<?=$arr["DD"]?> <?=GetMessage("FULL_MONTH_".$arr["MM"])?> <?=$arr["YYYY"]?> 
							<?if($res["UF_DOP_NAME"] && $res["UF_DATE"]):?>
								/ <?=$res["UF_DOP_NAME"]?>
							<?elseif(strlen($res["UF_DOP_NAME"])>0):?>
								<?=$res["UF_DOP_NAME"]?>
							<?endif;?>
						</div>
					<?endif;?>
					<div class="title">
						<?=$res['NAME']?>
					</div>
				</div>
			</div>
			<?if($res["ELEMENTS_CNT_ALL"] >0):?>
                </a>
			<?endif;?>
			<div class="album-separator-line"></div>
		
		</div>
	<?endforeach;?>
	</div>

</div>
<?//*/ ?>
<div class="empty-clear"></div>

<?
if (!empty($arResult["NAV_STRING"])):
?>
<div class="photo-navigation photo-navigation-bottom">
	<?=$arResult["NAV_STRING"]?>
</div>
<?
endif;
?>
<?
//pr($arResult);
?>