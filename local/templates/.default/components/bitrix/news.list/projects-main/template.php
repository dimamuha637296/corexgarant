<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult['ITEMS']):?>
    <div class="services">
        <div class="b-title">
            <div class="b-title__title-wrap">
                <div class="b-title__title h1"><?=$arParams['DB_TITLE']?></div><a class="b-title__link" href="<?=$arParams['DB_LINK']?>"><?=$arParams['DB_LINK_NAME']?></a>
            </div>
        </div>
        <div class="row">
            <?foreach($arResult["ITEMS"] as $arItem):
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="item col-12 col-sm-6 col-lg-4 col-xl-3" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <a class="link" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                        <img class="pic" src="<?=$arItem['PREVIEW_IMG']['SRC'];?>" alt="<?=$arItem["NAME"]?>">
                        <div class="wrap">
                            <div class="h3 title"><?=$arItem["NAME"]?></div>
                            <div class="text"><?=$arItem['PROPERTIES']['TYPE']['VALUE']?></div>
                        </div>
                    </a>
                </div>
            <?endforeach;?>
        </div>
    </div>
<?endif;?>