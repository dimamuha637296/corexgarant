<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

?>


	<div class="search">
		<form name="frm-search"  method="get" action="<?=$APPLICATION->GetCurPage()?>" onsubmit="var str=document.getElementById('searchinp-long'); if (!str.value || str.value == str.title) return false;" >
			<input type="hidden" name="tags" value="<?echo $arResult["REQUEST"]["TAGS"]?>" />
			<input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
			<fieldset class="field">
				<div class="wrap">
					<input class="input form-control" id="searchinp-long" type="search" title="<?=GetMessage("DB_TITLE_INPUT");?>" value="<?=$arResult["REQUEST"]["QUERY"]?>" placeholder="<?=GetMessage("DB_TITLE_INPUT");?>" name="q" maxlength="150" />
				</div>
				<div class="submit">
					<label>
						<input class="btn btn-default" name="btn-search" type="submit" value="<?=GetMessage("CT_BSP_GO")?>">
					</label>
				</div>
			</fieldset>
		</form>
		<div class="clear"></div>
	</div>
	<noindex>
		<?if(is_object($arResult["NAV_RESULT"])):?>
			<p class="search-result"><?echo GetMessage("CT_BSP_FOUND")?>:  <?=sklonen($arResult["NAV_RESULT"]->SelectedRowsCount(), GetMessage("DB_TOVAR_1"), GetMessage("DB_TOVAR_2"), GetMessage("DB_TOVAR_3"))?></p>
		<?endif;?>
	</noindex>
<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):?>
	<p class="search-language-guess">
	<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
	</p><?
endif;?>
<?/*/?><pre><?print_r($arResult)?></pre><?//*/?>