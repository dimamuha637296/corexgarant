<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult['ITEMS']):?>
    <div class="sl-teaser">
        <div class="wrap cursor">
            <div class="slider">
                <?foreach($arResult["ITEMS"] as $arItem):
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="inner" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <a class="link" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                            <img class="pic" src="<?=$arItem['PREVIEW_IMG']['SRC'];?>" alt="<?=$arItem["NAME"]?>">
                            <div class="wrap-i">
                                <div class="title"><?=$arItem['NAME']?></div>
                                <div class="text"><?=$arItem['PROPERTIES']['TYPE']['VALUE']?></div>
                            </div>
                        </a>
                    </div>
                <?endforeach;?>
            </div>
            <div class="sl-nav-2"><a class="prev" href="#"></a><a class="next" href="#"></a></div>
        </div>
    </div>
<?endif;?>