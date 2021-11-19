<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arResult['CNT'] = count($arResult['ITEMS']) - 1;
if ($arResult['CNT'] < 0)
    return;

$arParams['COLUM'] = isset($arParams['COLUM']) ? intval($arParams['COLUM']) : 2;
$arParams['COLUM_MAX'] = isset($arParams['COLUM_MAX']) ? intval($arParams['COLUM_MAX']) : 12;
list($arParams['DELIM'], $arParams['COLUM_GRID']) = CDbBase::getDelim4Grid($arParams['COLUM'], $arParams['COLUM_MAX'], $arResult['CNT'],  false);

$j = 1;
?>
    <ul class="list-item" id="db-items-<?=$arResult['ID']?>">
        <?
        foreach ($arResult['ITEMS'] as $key => $arElement):
            $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CATALOG_ELEMENT_DELETE_CONFIRM')));

            $bHasPicture = $arParams["DISPLAY_PICTURE"]!="N" && is_array($arElement['PREVIEW_IMG']);
            $sticker = '';
            $classIcon = '';
            if (array_key_exists("PROPERTIES", $arElement) && is_array($arElement["PROPERTIES"]))
            {
                foreach (array('b-new' => 'FLG_NEW', 'b-deals' => 'FLG_DISCONT', 'b-spec' => 'FLG_HIT') as $code => $propertyCode)
                    if (array_key_exists($propertyCode, $arElement["PROPERTIES"]) && intval($arElement["PROPERTIES"][$propertyCode]["PROPERTY_VALUE_ID"]) > 0){
                        $sticker .= '<div class="'.$code.'">'.$arElement["PROPERTIES"][$propertyCode]["NAME"]."</div>";
                        //$sticker .= ' '.$arElement["PROPERTIES"][$propertyCode]["NAME"];
                        $classIcon .= ' '.$code;
                    }

            }

            ?>
            <li class="item mb_3 grid_<?=$arParams['COLUM_GRID']?> mb_3 <?=($j == 1 ? 'alpha' : '').' '.($j >= $arParams['DELIM'] ? 'omega' : '' )?>" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
                <?if($arParams["DISPLAY_NAME"]!="N" && $arElement["NAME"]):?>
                    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arElement["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                        <h3 class="title mb_1"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="lnk _block"><?=$arElement["NAME"]?></a></h3>
                    <?else:?>
                        <h3 class="title mb_1"><?=$arElement["NAME"]?></h3>
                    <?endif;?>
                <?endif;?>
                <?if($bHasPicture):?>
                    <div class="picture ">
                        <a class="lnk" href="<?=$arElement["DETAIL_PAGE_URL"]?>">
                            <img class="half mb_3" src="<?echo $arElement['PREVIEW_IMG']['SRC'];?>" width="<?=$arElement['PREVIEW_IMG']['WIDTH']?>" alt="<?=$arElement['PREVIEW_IMG']['ALT']?>" >
                        </a>
                        <?if(strlen($sticker) > 0):?><div class="b-labels"><?=$sticker?></div><?endif;?>
                    </div>
                <?else:?>
                    <div class="no-picture half mb_3"></div>
                <?endif;?>
                <div class="descr">
                    <?if($arParams["DISPLAY_DATE"]!="N" && $arElement["DISPLAY_ACTIVE_FROM"]):?>
                        <p class="date mb_1" data-date="<?=$arElement["ACTIVE_FROM"]?>"><?=ToLower($arElement["DISPLAY_ACTIVE_FROM"]);?></p>
                    <?endif?>
                    <?if($arParams["DISPLAY_TEXT"]!="N"):?>
                        <?if(strlen($arElement["PREVIEW_TEXT"]) > 0):?>
                            <?if($arElement['PREVIEW_TEXT_TYPE'] == 'html'):?><?=$arElement["PREVIEW_TEXT"]?><?else:?><p><?=$arElement["PREVIEW_TEXT"]?></p><?endif;?>
                        <?elseif(strlen($arElement["DETAIL_TEXT"]) > 0):?>
                            <?if($arElement['DETAIL_TEXT_TYPE'] == 'html'):?><?=$arElement["DETAIL_TEXT"]?><?else:?><p><?=$arElement["DETAIL_TEXT"]?></p><?endif;?>
                        <?endif;?>
                    <?endif;?>

                </div>
            </li>
            <?
            if($j % $arParams['DELIM'] == 0):
                $j = 1;
                ?><li class="item"><div class="clear"></div></li><?
            else:
                $j = $j + 1;
            endif;
        endforeach;?>
    </ul>
    <div class="clear"></div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>
<?/*/?><pre><?print_r($arParams)?></pre><?//*/?>
<?/*/?><pre><?print_r($arResult)?></pre><?//*/?>