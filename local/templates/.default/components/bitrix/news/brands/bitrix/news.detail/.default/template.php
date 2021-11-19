<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$this->setFrameMode(true);
$bhasSectionName = $arParams["DISPLAY_SECTION_NAME"] == 'Y' && isset($arResult['SECTION_INFO'][$arResult['IBLOCK_SECTION_ID']]);
$bhasDate = $arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"];
$arParams['COLUM'] = 1;
$arParams['COLUM_MAX'] = 20;
$arParams['COLUM_GRID'] = $arParams['COLUM_MAX'];

$bHasPicture = $arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult['PREVIEW_IMG']);
if(strlen($arResult['PROPERTIES']['HREF']['VALUE']) > 0){
    $tp_link = 'http://';
    $link = trim($arResult['PROPERTIES']['HREF']['VALUE']);
    if(strstr($link , 'http://') !==false){
        $link = substr($link, 7);
    }elseif(strstr($link , 'https://') !==false){
        $link = substr($link, 8);
        $tp_link = 'https://';
    }else{
        $link = $link;
    }
    $href = true;
}else{
    $link = '';
    $tp_link = '';
}
?>
    <div class="b-element mb_3" id="element-<?=$arResult['ID']?>" >
        <?if($bHasPicture && $arParams["DISPLAY_DETAIL_PICTURE"] != "N"):?>
            <div class="<?if($arParams["DISPLAY_PICTURE_FULL_WIDTH"] != 'Y'):?>fl-img<?else:?>mb_2<?endif;?>">
                <img src="<?=$arResult['PREVIEW_IMG']['SRC']?>" alt="<?=$arResult['PREVIEW_IMG']['ALT']?>" />
            </div>
        <?endif;?>

        <div class="descr mb_2">
            <?if($link):?>
<div class="mb_1">
                <a href="<?=$tp_link.$link ?>" target="_blank"><?=$link?><i class="icon ic-blank"></i></a>
</div>
            <?endif;?>
            <?if($arResult["DETAIL_TEXT"]):?>
                <?if($arResult['DETAIL_TEXT_TYPE'] == 'html'):?><?=$arResult["DETAIL_TEXT"]?><?else:?><p><?=$arResult["DETAIL_TEXT"]?></p><?endif;?>
                <div class="clear"></div>
            <?endif;?>
        </div>


    </div>

<?/*/?><pre><?print_r($arParams)?></pre><?//*/?>
<?/*/?><pre><?print_r($arResult['VIDEO']['COMPONENT']['NAME'])?></pre><?//*/?>