<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult['ITEMS']):?>
    <div class="teaser_2">
        <div class="row">
            <?foreach($arResult["ITEMS"] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
                <div class="item col-12 col-md-6 col-xl-3" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <?if($arItem['PROPERTIES']['HREF']['VALUE']):?>
                        <a class="inner color-<?=$arItem['PROPERTIES']['COLOR']['VALUE_XML_ID'] == 'blue' ? '0' : $arItem['PROPERTIES']['COLOR']['VALUE_XML_ID']?>"<?if($arItem['PROPERTIES']['NEW_PAGE']['VALUE']):?> target="_blank"<?endif;?> href="<?=$arItem['PROPERTIES']['HREF']['VALUE']?>">
                    <?else:?>
                        <div class="inner color-<?=$arItem['PROPERTIES']['COLOR']['VALUE_XML_ID'] == 'blue' ? '0' : $arItem['PROPERTIES']['COLOR']['VALUE_XML_ID']?>">
                    <?endif;?>
                        <div class="wrap">
                            <?if($arItem['PREVIEW_IMG']['SRC']):?>
                                <div class="pic"><img class="img" src="<?=$arItem['PREVIEW_IMG']['SRC']?>" alt="<?=$arItem['NAME']?>"></div>
                            <?endif;?>
                            <div class="h4 title"><?=$arItem['NAME']?></div>
                            <?if($arItem['~PREVIEW_TEXT']):?>
                                <div class="text"><?=$arItem['~PREVIEW_TEXT']?></div>
                            <?endif;?>
                        </div>
                    <?if($arItem['PROPERTIES']['HREF']['VALUE']):?>
                        </a>
                    <?else:?>
                        </div>
                    <?endif;?>
                </div>
            <?endforeach;?>
        </div>
    </div>
<?endif;?>

