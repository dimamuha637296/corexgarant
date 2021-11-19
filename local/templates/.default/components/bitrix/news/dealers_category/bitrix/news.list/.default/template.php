<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

if (count($arResult["ITEMS"]) > 0):?>
    <div class="dealers-table">
        <table class="table-map-icon">
            <tbody>
            <? foreach ($arResult["ITEMS"] as $num => $arItem):
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <tr id="<?= $this->GetEditAreaId($arItem['ID']); ?>" data-id="<?= $arItem["ID"] ?>">
                    <td >
                        <b><?= $arItem["NAME"] ?></b>
                    </td>
                    <td>
                        <? if ((count($arItem["PROPERTIES"]["ADRESS"]["VALUE"]) > 0 && strlen($arItem["PROPERTIES"]["ADRESS"]["VALUE"][0]) > 0)):?>
                            <? foreach ($arItem["PROPERTIES"]["ADRESS"]["VALUE"] as $num => $strVal):?>
                                <?= $strVal ?><br/>
                            <? endforeach;?>
                        <? endif;?>
                        <?if (strlen($arItem["PROPERTIES"]['LAN_LAT']['VALUE']) > 0):?>
                            <div class="show-map" id="show-map-<?= $arItem['ID'] ?>-<?= $num ?>">
                                <span id="show-elem-<?=$arItem['ID']?>" class="lnk-pseudo" data-id="<?= $arItem["ID"] ?>"><?=GetMessage("HOW_TO")?></span>
                            </div>
                        <? endif;?>
                    </td>
                    <td>
                        <? if ((count($arItem["PROPERTIES"]["TELEPHONES"]["VALUE"]) > 0 && strlen($arItem["PROPERTIES"]["TELEPHONES"]["VALUE"][0]) > 0)):?>
                            <? foreach ($arItem["PROPERTIES"]["TELEPHONES"]["VALUE"] as $num => $strVal):?>
                                <?= $strVal ?> <?=$arItem["PROPERTIES"]["TELEPHONES"]["DESCRIPTION"][$num]?><br/>
                            <? endforeach;?>
                            <? if (!empty($arItem["PROPERTIES"]["SITE"]["VALUE"])):?>
                                <a href="<?= $arItem["PROPERTIES"]["SITE"]["VALUE"] ?>" target="_blank">
                                    <?= $arItem["PROPERTIES"]["SITE"]["VALUE"] ?>
                                </a>
                                <br/>
                            <? endif;?>
                            <? foreach ($arItem["PROPERTIES"]["EMAIL"]["VALUE"] as $strVal):?>
                                <a href="mailto:<?= $strVal ?>"><?= $strVal ?></a><br/>
                            <? endforeach;?>
                        <? endif;?>
                        <? if ((count($arItem["PROPERTIES"]["FACE"]["VALUE"]) > 0 && strlen($arItem["PROPERTIES"]["FACE"]["VALUE"][0]) > 0)):?>
                            <? foreach ($arItem["PROPERTIES"]["FACE"]["VALUE"] as $num => $strVal):?>
                                <?= $strVal ?><br/>
                            <? endforeach;?>
                        <? endif;?>
                    </td>
                </tr>
            <? endforeach; ?>
            </tbody>
        </table>
    </div>
<?endif;?>

