<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?$arResult['CNT'] = count($arResult['ITEMS']) - 1;
if ($arResult['CNT'] < 0)
	return;
?>

    <div class="personal-detail js-width js-hover">
        <?foreach($arResult["ITEMS"] as $key => $arElement):
            $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $bHasPicture = is_array($arElement['PREVIEW_IMG']);
            ?>
            <div class="item<?// js-hover-wrap?>" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
                <div class="pic js-width-trg">
                    <?/*?><a href="#" class="link js-hover-trg"><i class="icon"></i></a><?//*/?>
                    <?if($bHasPicture):?>
                        <img src="<?=$arElement['PREVIEW_IMG']['SRC'];?>" alt="<?=$arElement['PREVIEW_IMG']['ALT'];?>">
                    <?endif;?>
                </div>
                <div class="wrap">
                    <div class="title">
                        <?/*?><a href="#" class="js-hover-trg"><?=$arElement["NAME"]?></a><?//*/?>
                        <?=$arElement["NAME"]?>
                    </div>
                    <?if($arElement["PROPERTIES"]["POST"]["VALUE"]):?>
                        <div class="caption-text"><?=$arElement["PROPERTIES"]["POST"]["~VALUE"]?></div>
                    <?endif;?>
                    <div class="text">
                        <?if(strlen($arElement["DETAIL_TEXT"]) > 0):?>
                            <?if($arElement['DETAIL_TEXT'] == 'html'):?><?=$arElement["DETAIL_TEXT"]?><?else:?><p><?=$arElement["DETAIL_TEXT"]?></p><?endif;?>
                        <?endif;?>
                        <?if($arElement["PROPERTIES"]["MAIL"]["VALUE"]):?>
                            <p><?=$arElement["PROPERTIES"]["MAIL"]["NAME"]?> <a href="mailto:<?=$arElement["PROPERTIES"]["MAIL"]["VALUE"]?>"><?=$arElement["PROPERTIES"]["MAIL"]["VALUE"]?></a></p>
                        <?endif;?>
                        <?if(count($arElement['PROPERTIES']['MORE_PHOTOS']['VALUE']) > 0 && $arElement['PROPERTIES']['MORE_PHOTOS']['VALUE'][0] > 0):?>
                            <?$APPLICATION->IncludeComponent(
                                "db.base:gallery.list",
                                "reviews",
                                array(
                                    "DISPLAY_IMG_WIDTH" => $arParams['DISPLAY_DETAIL_DOP_IMG_WIDTH'],
                                    "DISPLAY_IMG_HEIGHT" => $arParams['DISPLAY_DETAIL_DOP_IMG_HEIGHT'],
                                    "TYPE_IMG_THUMB" => "BX_RESIZE_IMAGE_EXACT",
                                    "COLUM" => intval($arParams["COLUMN_COUNT_FOR_MORE_PHOTOS"]) > 0 ? $arParams["COLUMN_COUNT_FOR_MORE_PHOTOS"] : 4,
                                    "CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
                                    "CACHE_TIME"	=>	$arParams["CACHE_TIME"],
                                    "CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
                                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                    "ITEMS" => $arElement['PROPERTIES']['MORE_PHOTOS']['VALUE'],
                                    "DEF_NAME" => $arElement['NAME']
                                ),
                                false
                            );
                            ?>
                        <?endif;?>
                    </div>
                </div>
            </div>
        <?endforeach;?>
        <script>
            !function() {
                'use strict';

                // popup with arrows
                function popupGalleryArrow() {
                    var galleryList = $('.popup-gal');
                    if (galleryList.length && $.fn.magnificPopup) {
                        galleryList.each(function () {
                            $(this).magnificPopup({
                                delegate: '.link',
                                type: 'image',
                                closeOnContentClick: false,
                                closeBtnInside: false,
                                mainClass: 'mfp-with-zoom mfp-img-mobile',
                                image: {
                                    verticalFit: true,
                                    titleSrc: function (item) {
                                        return item.el.attr('title');
                                    }
                                },
                                gallery: {
                                    enabled: true
                                },
                                zoom: {
                                    enabled: true,
                                    duration: 300, // don't foget to change the duration also in CSS
                                    opener: function (element) {
                                        return element.find('img');
                                    }
                                }
                            });
                        });
                    }
                }
                // Call functions
                $(window).on('load', function() {
                    popupGalleryArrow()
                });
            }();
        </script>
    </div>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <div class="page-count">
            <?=$arResult["NAV_STRING"]?>
        </div>
    <?endif;?>
