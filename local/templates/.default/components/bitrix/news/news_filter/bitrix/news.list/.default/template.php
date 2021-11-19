<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>
<?if($arParams["DISPLAY_PICTURE_FULL_WIDTH"] == "Y"){
	$fullWidth = true;
} ?>
<div class="news-list <?=($fullWidth? "big": "js-width")?> js-hover">

	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

		$bHasPicture = $arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem['PREVIEW_IMG']);
		$bhasDate = $arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"];
		$bhasSectionName = $arParams["DISPLAY_SECTION_NAME"] == 'Y' && isset($arResult['SECTION_INFO'][$arItem['IBLOCK_SECTION_ID']]);
		$bhasPrewText = $arParams["DISPLAY_SECTION_NAME"] == 'Y' && isset($arResult['SECTION_INFO'][$arItem['IBLOCK_SECTION_ID']]);
		$bhasHasLink = !$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"]);
		?>
		<div class="item<?=($bhasHasLink && $bHasPicture?" js-hover-wrap":"")?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<?if(!$fullWidth):?>
            	<div class="media-old">
            		<?if($bHasPicture):?>
            		<div class="pic media-left-old js-width-trg">
	            		<?if($bhasHasLink):?>
		            		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="link js-hover-trg">
		            			<i class="icon"></i>
								<img class="img" src="<?=$arItem['PREVIEW_IMG']['SRC']?>" alt="<?=$arItem['PREVIEW_IMG']['ALT']?>" title="<?=$arItem['PREVIEW_IMG']['ALT']?>">
							</a>
							<?else:?>
								<i class="icon"></i>
								<img class="img" src="<?=$arItem['PREVIEW_IMG']['SRC']?>" alt="<?=$arItem['PREVIEW_IMG']['ALT']?>" title="<?=$arItem['PREVIEW_IMG']['ALT']?>">
							<?endif;?>
	            		<?endif?>
            		</div>
            		<div class="media-body-old">
            <?endif?>
			<?if($bhasDate):?>
				<div class="date">
					<?if($bhasDate):?>
						<time class="time" datetime="<?=date('Y-m-d', strtotime($arItem["ACTIVE_FROM"]));?>"><?=ToLower($arItem["DISPLAY_ACTIVE_FROM"]);?></time>
					<?endif?>
					<?if($arItem['PROPERTIES']['TYPE']["VALUE"]):?>
                        <div class="part">
                            <a href="?filter=<?=$arItem['PROPERTIES']['TYPE']["VALUE_XML_ID"]; ?>">
                                <?=$arItem['PROPERTIES']['TYPE']["VALUE"]?>
                            </a>
                        </div>
					<?endif;?>
				</div>
			<?endif;?>
				<?if($bhasHasLink && $fullWidth):?>
					<a class="link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
				<?endif;?>
					<?if($arParams["DISPLAY_ELEMENT_NAME"]!="N" && $arItem["NAME"]):?>
						<div class="title">
							<?if($bhasHasLink && !$fullWidth):?>
								<a class="js-hover-trg" href="<?=$arItem["DETAIL_PAGE_URL"]?>" ><?=strip_tags(htmlspecialchars_decode($arItem["NAME"]))?></a>
							<?else:?>
								<?=strip_tags(htmlspecialchars_decode($arItem["NAME"]))?>
							<?endif;?>
						</div>
					<?endif;?>
					<?if($fullWidth && $bHasPicture):?>
						<div class="pic">
							<i class="icon"></i>
							<img class="img" src="<?=$arItem['PREVIEW_IMG']['SRC']?>" alt="<?=$arItem['PREVIEW_IMG']['ALT']?>" title="<?=$arItem['PREVIEW_IMG']['ALT']?>">
						</div>
					<?endif;?>
				<?if($bhasHasLink && $fullWidth):?>
					</a>
				<?endif;?>
				<?if($fullWidth && $arParams["DISPLAY_PREVIEW_TEXT"] != "N"):?>
					<div class="text">
						<?if(intval($arParams["PREVIEW_TRUNCATE_LEN"]) > 1){
							if($arItem['~PREVIEW_TEXT']){
								$arItem['PREVIEW_TEXT'] = cutString($arItem['~PREVIEW_TEXT'], $arParams["PREVIEW_TRUNCATE_LEN"]);
							}elseif($arItem['DETAIL_TEXT']){
								$arItem['DETAIL_TEXT'] = cutString($arItem['DETAIL_TEXT'], $arParams["PREVIEW_TRUNCATE_LEN"]);
							}
						}?>
						<?if(strlen($arItem["PREVIEW_TEXT"]) > 0):?>
							<p><?=strip_tags($arItem["PREVIEW_TEXT"])?></p>
						<?elseif(strlen($arItem["DETAIL_TEXT"]) > 0):?>
							<p><?=strip_tags($arItem["DETAIL_TEXT"])?></p>
						<?endif;?>
					</div>
				<?endif;?>
            <?if(!$fullWidth):?>
            		<?if($arParams["DISPLAY_PREVIEW_TEXT"] != "N"):?>
            			<div class="text">
							<?if(intval($arParams["PREVIEW_TRUNCATE_LEN"]) > 1){
								if($arItem['~PREVIEW_TEXT']){
									$arItem['PREVIEW_TEXT'] = cutString($arItem['~PREVIEW_TEXT'], $arParams["PREVIEW_TRUNCATE_LEN"]);
								}elseif($arItem['DETAIL_TEXT']){
									$arItem['DETAIL_TEXT'] = cutString($arItem['DETAIL_TEXT'], $arParams["PREVIEW_TRUNCATE_LEN"]);
								}
							}?>
							<?if(strlen($arItem["PREVIEW_TEXT"]) > 0):?>
								<p><?=strip_tags($arItem["PREVIEW_TEXT"])?></p>
							<?elseif(strlen($arItem["DETAIL_TEXT"]) > 0):?>
								<p><?=strip_tags($arItem["DETAIL_TEXT"])?></p>
							<?endif;?>
						</div>
            		<?endif;?>
            		<?if($bHasPicture):?>
            		</div>
            		<?endif;?>
           		</div>
            <?endif;?>
		</div>
	<?endforeach;?>
	<?if(!$fullWidth):?>
<script>
	!function () {
		'use strict';
		var oWindow = $(window);

		function listAutoWidth() {
			var list = $('.js-width');
			if (list.length) {
				list.each(function () {
					var oThis, trg, maxW, iThis, thisW;
					oThis = $(this);
					trg = oThis.find('.js-width-trg');
					maxW = 0;
					trg.each(function () {
						iThis = $(this);
						iThis.css({
							'width': 'inherit'
						});

						thisW = iThis.outerWidth();
						if ( maxW < thisW) {
							maxW = thisW;
						}
					});
					trg.each(function () {
						$(this).css({
							'width': maxW
						});
					});

				});
			}
		}

		$(function () {
			listAutoWidth();
		});
		oWindow.load(function () {
			listAutoWidth();
		});
		oWindow.resize(function () {
			listAutoWidth();
		});
	}();
</script>
<?endif;?>
</div>

	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>

<?//pr($arResult);?>
