<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<div id="db-adres-tabl">

    <div class="spisok-table table-responsive mt_1">
        <table>
            <tbody>
            <? foreach ($arResult["ITEMS"] as $num => $arItem):
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                $coord = explode(',', $arItem['PROPERTIES']['LAN_LAT']['VALUE']);
                ?>
                <tr id="element-<?=$arItem['ID']?>">
                    <td id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <b><?= $arItem["NAME"] ?></b>
                        <? if (($arItem["PROPERTIES"]["SUBTITLE"]["VALUE"] && strlen($arItem["PROPERTIES"]["SUBTITLE"]["VALUE"]) > 0)):?>
                            <div class="sub-title"><?= $arItem["PROPERTIES"]["SUBTITLE"]["VALUE"] ?></div>
                        <? endif;?>
                    </td>
                    <td class="info">
                        <? if ((count($arItem["PROPERTIES"]["TELEPHONES"]["VALUE"]) > 0 && strlen($arItem["PROPERTIES"]["TELEPHONES"]["VALUE"][0]) > 0)):?>

                            <? foreach ($arItem["PROPERTIES"]["TELEPHONES"]["~VALUE"] as $num => $strVal):?>
                            	<div>
                                    <span class="number"><?= $strVal ?></span>
                                    <?if (strlen($arItem["PROPERTIES"]["TELEPHONES"]["DESCRIPTION"][$num]) > 0):?>
                                          <?= $arItem["PROPERTIES"]['TELEPHONES']['DESCRIPTION'][$num] ?>
                                    <?endif;?>
                                </div>
                            <? endforeach;?>
                        <? endif;?>
                        <? if ((count($arItem["PROPERTIES"]["EMAIL"]["VALUE"]) > 0 && strlen($arItem["PROPERTIES"]["EMAIL"]["VALUE"][0]) > 0)):?>
                            <? foreach ($arItem["PROPERTIES"]["EMAIL"]["~VALUE"] as $num => $strVal):?>
                                <div>
                                    <span class="email"><a href="mailto:<?= $strVal ?>"><?= $strVal ?></a></span>
                                </div>
                            <? endforeach;?>
                        <? endif;?>

                    </td>
                    <td class="time">
                        <? if ((count($arItem["PROPERTIES"]["TIMES"]["VALUE"]) > 0 && strlen($arItem["PROPERTIES"]["TIMES"]["VALUE"][0]) > 0)):?>
                            <? foreach ($arItem["PROPERTIES"]["TIMES"]["~VALUE"] as $num => $strVal):?>
                                <div>
                                    <span class="time"><?= $strVal ?></span>
                                </div>
                            <? endforeach;?>
                        <? endif;?>


                    </td>
                    <td id="distribution-<?= $arItem['ID'] ?>">
                        <? if (strlen($arItem["PROPERTIES"]['ADRESS']['VALUE']) > 0):?>
                            <? if (strlen($arItem["PROPERTIES"]['LAN_LAT']['VALUE']) > 0):
                                $arLan_Lat = explode(",", $arItem["PROPERTIES"]['LAN_LAT']['VALUE']);
                                ?>
                                <div class="b-contact-info-block">
                                    <div class="e-contact-left-info">
											<span class="lnk" data-lon="<?= trim($arLan_Lat[1]) ?>"
                                                  data-lat="<?= trim($arLan_Lat[0]) ?>" data-num="<?= $num ?>"
                                                  data-id="<?= $arItem["ID"] ?>"
                                                  data-type-icon="<?= $arItem['PROPERTIES']['CATEGORY']["VALUE"] ?>">

												<div class="gy-map-info b-map-info hide inf">
                                                    <div class="title b-index-map-info-header"><?= $arItem["~NAME"] ?>
                                                        <? if (($arItem["PROPERTIES"]["SUBTITLE"]["VALUE"] && strlen($arItem["PROPERTIES"]["SUBTITLE"]["VALUE"]) > 0)):?>
                                                            <small><?= $arItem["PROPERTIES"]["SUBTITLE"]["VALUE"] ?></small>
                                                        <? endif;?>
                                                    </div>
                                                    <div class="b-index-map-info-contacts">
                                                        <? if (strlen($arItem["PROPERTIES"]["ADRESS"]["VALUE"]) > 0):?>
                                                            <p class="adress"><?= $arItem["PROPERTIES"]["ADRESS"]["VALUE"] ?></p>
                                                        <? endif;?>
                                                        <? if (count($arItem["PROPERTIES"]["TELEPHONES"]["VALUE"]) > 0 && strlen($arItem["PROPERTIES"]["TELEPHONES"]["VALUE"][0]) > 0):?>
                                                            <dl class="b-map-e-TELEPHONES contact">
                                                                <dt class="b-map-e-ugc-title"><?= $arItem["PROPERTIES"]["TELEPHONES"]["NAME"] ?>
                                                                    :
                                                                </dt>
                                                                <? foreach ($arItem["PROPERTIES"]["TELEPHONES"]["VALUE"] as $num => $strVal):?>
                                                                    <dd><?= $strVal ?><?
                                                                        if (strlen($arItem["PROPERTIES"]["TELEPHONES"]["DESCRIPTION"][$num]) > 0):
                                                                            ?>
                                                                            <small>
                                                                             <?= $arItem["PROPERTIES"]['TELEPHONES']['DESCRIPTION'][$num] ?></small><?
                                                                        endif;
                                                                        ?></dd>
                                                                <? endforeach;?>
                                                            </dl>
                                                        <? endif;?>
                                                        <? if ($bHassite):?>
                                                            <dl class="b-map-e-EMAIL contact">
                                                                <dt class="b-map-e-ugc-title"><?= $arItem["PROPERTIES"]["SITE"]["NAME"] ?>
                                                                    :
                                                                </dt>
                                                                <dd><a class="lnk" target="_blank"
                                                                       href="<?= $tp_link . $link ?>"><?= $link ?></a>
                                                                </dd>
                                                            </dl>
                                                        <? endif;?>
                                                        <? if (count($arItem["PROPERTIES"]["EMAIL"]["VALUE"]) > 0 && strlen($arItem["PROPERTIES"]["EMAIL"]["VALUE"][0]) > 0):?>
                                                            <dl class="b-map-e-EMAIL contact">
                                                                <dt class="b-map-e-ugc-title"><?= $arItem["PROPERTIES"]["EMAIL"]["NAME"] ?>
                                                                    :
                                                                </dt>
                                                                <? foreach ($arItem["PROPERTIES"]["EMAIL"]["VALUE"] as $strVal):?>
                                                                    <dd>
                                                                        <a href="mailto:<?= $strVal ?>"><?= $strVal ?></a>
                                                                    </dd>
                                                                <? endforeach;?>
                                                            </dl>
                                                        <? endif;?>
                                                    </div>
                                                </div>
											</span>
											<?=$arItem["PROPERTIES"]['ADRESS']['VALUE'] ?>
                                    </div>
                                </div>
                            <? endif; ?>
                        <? endif;?>
                        <span class="show-map" id="show-map-<?= $arItem['ID'] ?>-<?= $num ?>"
                             data-lon="<?= trim($arLan_Lat[1]) ?>" data-lat="<?= trim($arLan_Lat[0]) ?>"
                             data-num="<?= $num ?>" data-id="<?= $arItem["ID"] ?>"
                             data-type-icon="<?= $arItem['PROPERTIES']['CATEGORY']["VALUE"] ?>">
                     <?//*?>       <a href="#" id="show-elem-<?=$arItem['ID']?>" onclick="return false;" class="else lnk-pseudo"><?=GetMessage("REACH")?></a><?//*/?>
                        </span>
                    </td>

                </tr>
                <tr class="map" style="display: none;">
                    <td colspan="4">
                    </td>
                </tr>
            <? endforeach; ?>
            </tbody>
        </table>

    </div>
    <div id="temp_map1" class="hidden">
        <?/*<div class="b-index-map-info b-map-info _hide" id="map-info-to-show-temp_map"></div>*/?>
        <? $APPLICATION->IncludeComponent("bitrix:map.google.view", "dealers", array(
            "INIT_MAP_TYPE" => $arParams["INIT_MAP_TYPE"],
            "MAP_DATA" => $arParams['MAP_DATA'],
            "MAP_WIDTH" => $arParams["MAP_WIDTH"],
            "MAP_HEIGHT" => $arParams["MAP_HEIGHT"],
            "CONTROLS" => $arParams["CONTROLS"],
            "MAPS_ICON" => $arParams["MAPS_ICON"],
            "OPTIONS" => $arParams["OPTIONS"],
            "MAP_ID" => 'temp_map',
            'MARKERS' => $arResult['MARKERS']
        ),
            $component->GetParent(),
            array(
                "HIDE_ICONS" => "N",
                "ACTIVE_COMPONENT" => "Y"
            )
        );
        ?>
    </div>
    <script>
        BX.ready(function () {
            var r = t = null;
            var tempVar = null;
            var temp_map = null;
            var NumberId = '';



            $(".show-map .else").each(function () {
                $(this).on('click', function (e) {
                    var curVar = $(this).parents('tr');
                    if (!temp_map) {
                        temp_map = $('div#temp_map1').html();
                        $("div#temp_map1").remove();
                    }
                    if (tempVar != null && tempVar.find('.lnk').attr('data-id') != curVar.find('.lnk').attr('data-id')) {
                        tempVar.next('tr.map').hide().find('td').html('');
                        curVar.next('tr.map').toggle().find('td').html(temp_map);
                        tempVar = curVar;
                        if (curVar.find('.lnk').attr('data-id') > 0) {
                            BX_SetPlacemarks_temp_map(curVar.find('.lnk').attr('data-id'));
                        }
                    } else if (tempVar == null) {
                        tempVar = curVar;
                        curVar.next('tr.map').toggle().find('td').html(temp_map);
                        if (curVar.find('.lnk').attr('data-id') > 0) {
                            BX_SetPlacemarks_temp_map(curVar.find('.lnk').attr('data-id'));
                        }
                    } else {
                        curVar.next('tr.map').toggle();
                    }
                });
            });

            r = new RegExp('^#element-([0-9]+)+$', 'ig');
            t = r.exec(window.location.hash);
            if (t != null) {
            	NumberId = t[1];
                BX.DbScrollTo(t[0].substr(1));
                setTimeout(function(){$('#show-elem-'+ NumberId).click();} , 2000);
            }
        });
    </script>
    <?//pr($arResult)?>
