<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<div class="abc">
    <ul class="lang-list  list-reset">
        <?foreach($arResult["SECTIONS"] as $arSection):?>
            <li class="item">
                <?if($arSection["ELEMENT_CNT"] > 0):?>
                    <?if($arParams['CUR_SECTION_ID'] == $arSection["ID"]):?>
                        <span class="letter _active"><?=$arSection["NAME"]?></span>
                    <?else:?>
                        <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="letter "><?=$arSection["NAME"]?></a>
                    <?endif;?>
                <?else:?>
                    <span class="letter _disable"><?=$arSection["NAME"]?></span>
                <?endif;?>
            </li>
        <?endforeach;?>
    </ul>
</div>