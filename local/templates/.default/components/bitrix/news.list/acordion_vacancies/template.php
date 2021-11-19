<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<?if(count($arResult['ITEMS']) > 0):?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<div class="vacancy-collapse border">
	<?$i=1;foreach($arResult["SECTIONS"] as $arSection):?>
		<?if($arSection['NAME']):?>
			<div class="h2"><?=$arSection['NAME']?></div>
		<?endif;?>
		<?if($arSection["ITEMS"] || $arResult["SECTIONS"]["ITEMS"]):?>
			<?foreach($arSection["ITEMS"] as $key => $arItem):
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="wrap" id="element-<?=$arItem["ID"]?>">
						<div class="accordion">
							<div class="panel">
								<div class="row">
									<div class="col-12 col-md-8 col-lg-9">
										<a class="link ic-arrow <?if($arParams['OPEN_FIRST'] == Y && $key == 0 && $i == 1):?><?else:?>collapsed<?endif;?>" data-toggle="collapse"
										   href="#accordion-<?=$arItem["ID"]?>"  id="collapse-<?=$arItem["ID"]?>">
											<div class="title h3">
												<span class="dash"><?=$arItem["NAME"]?></span>
											</div>
										</a>
									</div>
									<div class="col-12 col-md-4 col-lg-3">
										<?if(["PROPERTIES"]["PAY"]["~VALUE"]):?>
											<div class="sum">
												<div class="sum_i"><?=$arItem["PROPERTIES"]["PAY"]["~VALUE"]?></div>
											</div>
										<?endif;?>
									</div>
								</div>
                                <div id="accordion-<?=$arItem["ID"]?>" class="collapse <?if($arParams['OPEN_FIRST'] == 'Y' && $key == 0 && $i == 1):?>in<?endif;?>">
                                    <div class="acc-body">
                                        <?if(( $arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_IMG"])) || ($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"])):?>
                                            <div class="descr">
                                                <?if($arParams["DISPLAY_PICTURE"]!="N" && $bHasPicture):?>
                                                    <div class="picture">
                                                        <img class="pic" src="<?echo $arItem['PREVIEW_IMG']['SRC'];?>" width="<?=$arItem['PREVIEW_IMG']['WIDTH']?>" alt="<?=$arItem['PREVIEW_IMG']['ALT']?>" title="<?=$arItem['PREVIEW_IMG']['TITLE']?>"  data-bx-image="<?=$arItem['DETAIL_PICTURE']['SRC']?>" >
                                                    </div>
                                                <?endif;?>
                                                <?=$arItem["~DETAIL_TEXT"]?>
                                                <?=$arItem["~PREVIEW_TEXT"]?>
                                            </div>
                                        <?endif;?>
                                        <?if(count($arItem["PROPERTIES"]["TREB"]["VALUE"]) > 1):?>
                                            <h4 class="title caption _block"><?=$arItem["PROPERTIES"]["TREB"]["NAME"]?>:</h4>
                                            <div class="ugc">
                                                <ul>
                                                    <?foreach($arItem["PROPERTIES"]["TREB"]["VALUE"] as $strVal):?>
                                                        <li><?=$strVal?></li>
                                                    <?endforeach;?>
                                                </ul>
                                            </div>
                                        <?elseif(strlen($arItem["PROPERTIES"]["TREB"]["VALUE"][0]) > 0):?>
                                            <h4 class="title caption"><?=$arItem["PROPERTIES"]["TREB"]["NAME"]?>:</h4>
                                            <div class="descr"><p><?=$arItem["PROPERTIES"]["TREB"]["~VALUE"][0]?></p></div>
                                        <?endif;?>

                                        <?if(count($arItem["PROPERTIES"]["OBAZ"]["VALUE"]) > 1):?>
                                            <h4 class="title caption _block"><?=$arItem["PROPERTIES"]["OBAZ"]["NAME"]?>:</h4>
                                            <div class="ugc"><ul>
                                                    <?foreach($arItem["PROPERTIES"]["OBAZ"]["VALUE"] as $strVal):?>
                                                        <li><?=$strVal?></li>
                                                    <?endforeach;?>
                                                </ul></div>
                                        <?elseif(strlen($arItem["PROPERTIES"]["OBAZ"]["VALUE"][0]) > 0):?>
                                            <h4 class="title caption"><?=$arItem["PROPERTIES"]["OBAZ"]["NAME"]?>:</h4>
                                            <div class="descr"><p><?=$arItem["PROPERTIES"]["OBAZ"]["~VALUE"][0]?></p></div>
                                        <?endif;?>

                                        <?if(count($arItem["PROPERTIES"]["USLOV"]["VALUE"]) > 1):?>
                                            <h4 class="title caption _block"><?=$arItem["PROPERTIES"]["USLOV"]["NAME"]?>:</h4>
                                            <div class="ugc"><ul>
                                                    <?foreach($arItem["PROPERTIES"]["USLOV"]["VALUE"] as $strVal):?>
                                                        <li><?=$strVal?></li>
                                                    <?endforeach;?>
                                                </ul></div>
                                        <?elseif(strlen($arItem["PROPERTIES"]["USLOV"]["VALUE"][0]) > 0):?>
                                            <h4 class="title caption"><?=$arItem["PROPERTIES"]["USLOV"]["NAME"]?>:</h4>
                                            <div class="ugc descr"><p><?=$arItem["PROPERTIES"]["USLOV"]["~VALUE"][0]?></p></div>
                                        <?endif;?>
                                        <?if(strlen($arParams['BUTTON_NAME']) > 0):?>
                                            <div class="descr">
                                                <button class="btn btn-default btn-sm css_submit_vacancy" type="button" data-toggle="modal" data-target="#FRM_vacancies" data-val-vacancy="<?=$arItem["NAME"]?>" data-val-city="<?=$arSection["NAME"]?>"><?=$arParams['BUTTON_NAME']?></button>
                                            </div>
                                        <?endif;?>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
				</div>
			<?endforeach;?>
		<?endif;?>
		<?$i++;endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

	<script>

		$(function(){
			$('body').on('click', '.css_submit_vacancy', function(){
				var vacancy = $(this).attr("data-val-vacancy");
				var city = $(this).attr("data-val-city");

				if(vacancy.length > 1){
					$("#form-vacancy-FRM_vacancies").attr("value", vacancy);
				}

				if(city.length > 1){
					$("#form-city-FRM_vacancies").attr("value", city);
				}
			});
		});
	</script>
<?elseif(strlen($arParams['NO_RESULT_TEXT']) > 0 ):?>
	<div class="vacancy no-result">
		<?=htmlspecialchars_decode($arParams['NO_RESULT_TEXT']);?>
	</div>
<?endif;?>
