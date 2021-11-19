<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult['ITEMS']):?>
    <div class="sl-partners">
        <div class="b-title">
            <div class="b-title__title-wrap">
                <div class="b-title__title h1"><?=$arParams['DB_TITLE']?></div><a class="b-title__link" href="<?=$arParams['DB_LINK']?>"><?=$arParams['DB_LINK_NAME']?></a>
            </div>
        </div>
        <div class="wrap cursor inited-not">
            <div class="slider">
                <?foreach($arResult["ITEMS"] as $arItem):
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="inner">
                            <a class="link" href="<?=$arItem['PROPERTIES']['HREF']['VALUE']?>" target="_blank">
                                <img class="img" src="<?=$arItem['PREVIEW_IMG']['SRC'];?>" alt="partner">
                            </a>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
            <div class="sl-nav-2"><a class="prev" href="#"></a><a class="next" href="#"></a></div>
        </div>
    </div>
<?endif;?>