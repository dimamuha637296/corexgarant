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

		<?if(is_object($arResult["NAV_RESULT"])):?>
			<p class="search-result"><?echo GetMessage("CT_BSP_FOUND")?>: <?echo $arResult["NAV_RESULT"]->SelectedRowsCount()?></p>
		<?endif;?>

		<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):?>
		<p class="search-language-guess">
				<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
		</p><?
		endif;?>
	<div class="search-result">
	<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
	<?elseif($arResult["ERROR_CODE"]!=0):?>
		<p><?=GetMessage("CT_BSP_ERROR")?></p>
		<?ShowError($arResult["ERROR_TEXT"]);?>
		<p><?=GetMessage("CT_BSP_CORRECT_AND_CONTINUE")?></p>
		<p><?=GetMessage("CT_BSP_SINTAX")?><br /><b><?=GetMessage("CT_BSP_LOGIC")?></b></p>
		<table border="0" cellpadding="5">
				<tr>
					<td align="center" valign="top"><?=GetMessage("CT_BSP_OPERATOR")?></td><td valign="top"><?=GetMessage("CT_BSP_SYNONIM")?></td>
					<td><?=GetMessage("CT_BSP_DESCRIPTION")?></td>
				</tr>
				<tr>
					<td align="center" valign="top"><?=GetMessage("CT_BSP_AND")?></td><td valign="top">and, &amp;, +</td>
					<td><?=GetMessage("CT_BSP_AND_ALT")?></td>
				</tr>
				<tr>
					<td align="center" valign="top"><?=GetMessage("CT_BSP_OR")?></td><td valign="top">or, |</td>
					<td><?=GetMessage("CT_BSP_OR_ALT")?></td>
				</tr>
				<tr>
					<td align="center" valign="top"><?=GetMessage("CT_BSP_NOT")?></td><td valign="top">not, ~</td>
					<td><?=GetMessage("CT_BSP_NOT_ALT")?></td>
				</tr>
				<tr>
					<td align="center" valign="top">( )</td>
					<td valign="top">&nbsp;</td>
					<td><?=GetMessage("CT_BSP_BRACKETS_ALT")?></td>
				</tr>
		</table>
	<?elseif(count($arResult["SEARCH"])>0):?>
		<ol class="search-list" start="<?=(($arParams['PAGE_RESULT_COUNT']*$arResult["NAV_RESULT"]->NavPageNomer)-$arParams['PAGE_RESULT_COUNT']+1)?>">
		<?foreach($arResult["SEARCH"] as $arItem):?>
			<li class="item">
				<div class="wrap">
					<div class="title"><a href="<?echo $arItem["URL"]?>"><?=strip_tags(htmlspecialchars_decode($arItem["TITLE_FORMATED"]))?></a></div>
					<div class="text">
						<?if(isset($arResult['CATALOG']['IMG'][$arItem["ITEM_ID"]])):?>
						<div class="picture">
							<a class="lnk" href="<?echo $arItem["URL"]?>">
								<img class="picborder half mb_3" src="<?=$arResult['CATALOG']['IMG'][$arItem["ITEM_ID"]]['SRC']?>" alt="<?echo $arItem["TITLE"]?>">
							</a>
						</div>
						<?endif;?>
						<?=htmlspecialcharsBack($arItem["BODY_FORMATED"])?>

					</div>
                    <?if($arItem["CHAIN_PATH"]):?>
                        <div class="link"><?=GetMessage("FOUND_IN_SECTION")?> <?=$arItem["CHAIN_PATH"]?></div>
                    <?endif;?>
				<?/*if(
						($arParams["SHOW_ITEM_DATE_CHANGE"] != "N")
						|| ($arParams["SHOW_ITEM_PATH"] == "Y" && $arItem["CHAIN_PATH"])
						|| ($arParams["SHOW_ITEM_TAGS"] != "N" && !empty($arItem["TAGS"]))
					):?>
					<div class="search-item-meta mb_2">
						<?if($arItem["CHAIN_PATH"]):?>
							<div class="path"><?=$arItem["CHAIN_PATH"]?></div>
						<?endif;?>
						<?if (
							$arParams["SHOW_RATING"] == "Y"
							&& strlen($arItem["RATING_TYPE_ID"]) > 0
							&& $arItem["RATING_ENTITY_ID"] > 0
						):?>
						<div class="search-item-rate">
						<?
						$APPLICATION->IncludeComponent(
							"bitrix:rating.vote", $arParams["RATING_TYPE"],
							Array(
								"ENTITY_TYPE_ID" => $arItem["RATING_TYPE_ID"],
								"ENTITY_ID" => $arItem["RATING_ENTITY_ID"],
								"OWNER_ID" => $arItem["USER_ID"],
								"USER_VOTE" => $arItem["RATING_USER_VOTE_VALUE"],
								"USER_HAS_VOTED" => $arItem["RATING_USER_VOTE_VALUE"] == 0? 'N': 'Y',
								"TOTAL_VOTES" => $arItem["RATING_TOTAL_VOTES"],
								"TOTAL_POSITIVE_VOTES" => $arItem["RATING_TOTAL_POSITIVE_VOTES"],
								"TOTAL_NEGATIVE_VOTES" => $arItem["RATING_TOTAL_NEGATIVE_VOTES"],
								"TOTAL_VALUE" => $arItem["RATING_TOTAL_VALUE"],
								"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER_PROFILE"],
							),
							$component,
							array("HIDE_ICONS" => "Y")
						);?>
						</div>
						<?endif;?>
						<?if($arParams["SHOW_ITEM_TAGS"] != "N" && !empty($arItem["TAGS"])):?>
							<div class="search-item-tags"><label><?echo GetMessage("CT_BSP_ITEM_TAGS")?>: </label><?
							foreach ($arItem["TAGS"] as $tags):
								?><a href="<?=$tags["URL"]?>"><?=$tags["TAG_NAME"]?></a> <?
							endforeach;
							?></div>
						<?endif;?>

						<?if($arParams["SHOW_ITEM_DATE_CHANGE"] != "N"):?>
							<div class="search-item-date"><label><?echo GetMessage("CT_BSP_DATE_CHANGE")?>: </label><span><?echo $arItem["DATE_CHANGE"]?></span></div>
						<?endif;?>
					</div>
					<?endif;//*/?>
				</div>
			</li>
		<?endforeach;?>
		</ol>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N"):?><div class="page-count"><?=$arResult["NAV_STRING"]?></div><?endif;?>
		<?if($arParams["SHOW_ORDER_BY"] != "N"):?>
			<div class="search-sorting"><label><?=GetMessage("CT_BSP_ORDER")?>:</label>&nbsp;
				<?if($arResult["REQUEST"]["HOW"]=="d"):?>
					<a href="<?=$arResult["URL"]?>&amp;how=r"><?=GetMessage("CT_BSP_ORDER_BY_RANK")?></a>&nbsp;<b><?=GetMessage("CT_BSP_ORDER_BY_DATE")?></b>
				<?else:?>
					<b><?=GetMessage("CT_BSP_ORDER_BY_RANK")?></b>&nbsp;<a href="<?=$arResult["URL"]?>&amp;how=d"><?=GetMessage("CT_BSP_ORDER_BY_DATE")?></a>
				<?endif;?>
			</div>
		<?endif;?>
	<?else:?>
			<?ShowNote(GetMessage("CT_BSP_NOTHING_TO_FOUND"));?>
	<?endif;?>

</div><?/*/?><pre><?print_r($arResult)?></pre><?//*/?> 