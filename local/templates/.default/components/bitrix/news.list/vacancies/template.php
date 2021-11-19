<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?if(count($arResult['ITEMS']) > 0):?>

    <div class="vacancy-list border">
            <?$i=1;foreach($arResult["SECTIONS"] as $arSection):?>
                <?if($arSection['NAME']):?>
                    <h2 class="mt_0 mb_3"><?=$arSection['NAME']?></h2>
                <?endif;?>
                <?if($arSection["ITEMS"] || $arResult["SECTIONS"]["ITEMS"]):?>
                    <?foreach($arSection["ITEMS"] as $key => $arItem):
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                        <div class="item" id="element-<?=$arItem["ID"]?>">
                            <div class="row" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <div class="col-12 col-md-8 col-lg-9">
                                    <div class="title h3">
                                        <?=$arItem["NAME"]?>
                                    </div>
                                </div>
                                <?if(strlen($arItem["PROPERTIES"]["PAY"]["VALUE"]) > 1):?>
                                    <div class="sum-wrap col-lg-3 col-md-4 col-sm-12">
                                        <div class="sum">
                                            <div class="sum_i">
                                                <?=$arItem["PROPERTIES"]["PAY"]["VALUE"]?>
                                            </div>
                                        </div>
                                    </div>
                                <?endif;?>
                                <div class="col-lg-9 col-md-8 col-sm-12">
                                    <div class="wrap">
                                        <?if(count($arItem["PROPERTIES"]["USLOV"]["VALUE"]) > 1):?>
                                            <div class="descr">
                                                <div class="subtitle"><?=$arItem["PROPERTIES"]["USLOV"]["NAME"]?>:</div>
                                                <ul class="list">
                                                    <?foreach($arItem["PROPERTIES"]["USLOV"]["VALUE"] as $strVal):?>
                                                        <li><?=$strVal?></li>
                                                    <?endforeach;?>
                                                </ul>
                                            </div>
                                        <?elseif(strlen($arItem["PROPERTIES"]["USLOV"]["VALUE"][0]) > 0):?>
                                            <div class="descr">
                                                <div class="subtitle"><?=$arItem["PROPERTIES"]["USLOV"]["NAME"]?>:</div>
                                                <p><?=$arItem["PROPERTIES"]["USLOV"]["~VALUE"][0]?></p>
                                            </div>
                                        <?endif;?>

                                        <?if(count($arItem["PROPERTIES"]["TREB"]["VALUE"]) > 1):?>
                                            <div class="descr">
                                                <div class="subtitle"><?=$arItem["PROPERTIES"]["TREB"]["NAME"]?>:</div>
                                                <ul class="list">
                                                    <?foreach($arItem["PROPERTIES"]["TREB"]["VALUE"] as $strVal):?>
                                                        <li><?=$strVal?></li>
                                                    <?endforeach;?>
                                                </ul>
                                            </div>
                                        <?elseif(strlen($arItem["PROPERTIES"]["TREB"]["VALUE"][0]) > 0):?>
                                            <div class="descr">
                                                <div class="subtitle"><?=$arItem["PROPERTIES"]["TREB"]["NAME"]?>:</div>
                                                <p><?=$arItem["PROPERTIES"]["TREB"]["~VALUE"][0]?></p>
                                            </div>
                                        <?endif;?>

                                        <?if(count($arItem["PROPERTIES"]["OBAZ"]["VALUE"]) > 1):?>
                                            <div class="descr">
                                                <div class="subtitle"><?=$arItem["PROPERTIES"]["OBAZ"]["NAME"]?>:</div>
                                                <ul class="list">
                                                    <?foreach($arItem["PROPERTIES"]["OBAZ"]["VALUE"] as $strVal):?>
                                                        <li><?=$strVal?></li>
                                                    <?endforeach;?>
                                                </ul>
                                            </div>
                                        <?elseif(strlen($arItem["PROPERTIES"]["OBAZ"]["VALUE"][0]) > 0):?>
                                            <div class="descr">
                                                <div class="subtitle"><?=$arItem["PROPERTIES"]["OBAZ"]["NAME"]?>:</div>
                                                <p><?=$arItem["PROPERTIES"]["OBAZ"]["~VALUE"][0]?></p>
                                            </div>
                                        <?endif;?>

                                        <?if(strlen($arItem["PROPERTIES"]["HR"]["VALUE"]) > 0):?>
                                            <div class="descr">
                                                <div class="subtitle"><?=$arItem["PROPERTIES"]["HR"]["NAME"]?>:</div>
                                                <p><?=$arItem["PROPERTIES"]["HR"]["VALUE"]?></p>
                                            </div>
                                        <?endif;?>

                                        <?if(strlen($arItem["PROPERTIES"]["HR"]["VALUE"]['TEXT']) > 0):?>
                                            <div class="descr">
                                                <div class="subtitle"><?=$arItem["PROPERTIES"]["HR"]["NAME"]?>:</div>
                                                <p><?=htmlspecialchars_decode($arItem["PROPERTIES"]["HR"]["~VALUE"]['TEXT'])?></p>
                                            </div>
                                        <?endif;?>

                                        <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                                            <div class="descr">
                                                <?if($arItem['DETAIL_TEXT_TYPE'] == 'html'):?><?=$arItem["DETAIL_TEXT"]?><?else:?><p><?=$arItem["DETAIL_TEXT"]?></p><?endif;?>
                                                <?if($arItem['PREVIEW_TEXT_TYPE'] == 'html'):?><?=$arItem["PREVIEW_TEXT"]?><?else:?><p><?=$arItem["PREVIEW_TEXT"]?></p><?endif;?>
                                            </div>
                                        <?endif;?>
                                        <?if(strlen($arParams['BUTTON_NAME']) > 0):?>
                                            <div class="descr">
                                                <button class="btn btn-default btn-sm css_submit_vacancy" type="button" data-toggle="modal" data-target="#FRM_vacancies" data-val-vacancy="<?=$arItem["NAME"]?>"><?=$arParams['BUTTON_NAME']?></button>
                                            </div>
                                        <?endif;?>

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
                if(vacancy.length > 1){
                    $("#form-vacancy-FRM_vacancies").attr("value", vacancy);
                }
            });
        });
    </script>
<?elseif(strlen($arParams['NO_RESULT_TEXT']) > 0 ):?>
    <div class="vacancy no-result">
        <?=htmlspecialchars_decode($arParams['NO_RESULT_TEXT']);?>
    </div>
<?endif;?>