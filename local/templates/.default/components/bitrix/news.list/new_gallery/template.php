<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);
?>
<div class="gallery-albums">
    <div class="row row-clear">
        <?foreach($arResult["ITEMS"] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <?if(count($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"])>0):?>
            <div class="item col-12 col-sm-6 col-md-4 c_gallery_photo-<?=$arItem["ID"]?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a class="link" href="<?=$arItem["POPUP_IMG"]["src"]?>" title="<?=$arItem["NAME"]?>">
                    <?if($arItem["PREVIEW_IMG"]):?>
                    <div class="pic">
                        <div class="pic_i">
                            <img class="img" src="<?=$arItem["PREVIEW_IMG"]["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"/>
                        </div>
                    </div>
                    <?endif;?>
                    <div class="title">
                        <?=$arItem["~NAME"]?>
                    </div>
                </a>
                <?$k=1;foreach($arItem["IMAGES"] as $arImg):?>
                     <a href="<?=$arImg["IMG"]["src"]?>" title="<?=$arImg["NAME"]?>"></a>
                <?$k++;endforeach;?>
                <div class="quant caption-text">
                    <?=count($arItem["IMAGES"])+1?> <?=GetMessage("DB_PHOTO")?>
                </div>
            </div>
            <script>
                var c_gallery_photo = $('.c_gallery_photo-<?=$arItem["ID"]?>');
                if (c_gallery_photo.length  && $.fn.magnificPopup) {
                    c_gallery_photo.magnificPopup({
                        delegate: 'a',
                        type: 'image',
                        closeOnContentClick: false,
                        closeBtnInside: false,
                        mainClass: 'mfp-with-zoom mfp-img-mobile',
                        image: {
                            verticalFit: true,
                            titleSrc: function(item) {
                                return item.el.attr('title');
                            }
                        },
                        gallery: {
                            enabled: true
                        },
                        zoom: {
                            enabled: true,
                            duration: 300,
                            opener: function(element) {
                                return element.find('img');
                            }
                        }
                    });
                }
            </script>
            <?endif;?>
        <?endforeach;?>
    </div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
