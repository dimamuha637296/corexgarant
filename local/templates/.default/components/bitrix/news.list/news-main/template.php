<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult['ITEMS']):?>
    <div class="news-main-3">
        <div class="h1 small title"><?=$arParams['DB_TITLE']?></div>
        <ul class="list list-reset">
            <?foreach($arResult["ITEMS"] as $arItem):
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
                <li class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="time"><?=$arItem['ACTIVE_FROM']?></div>
                    <div class="subtitle"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></div>
                </li>
            <?endforeach;?>
        </ul>
        <div class="all-news"><a href="<?=$arParams['DB_LINK']?>"><?=$arParams['DB_LINK_NAME']?></a></div>
    </div>
<?endif;?>