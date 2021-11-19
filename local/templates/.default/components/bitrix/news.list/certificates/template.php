<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

$arResult['CNT'] = count($arResult['ITEMS']) - 1;
if ($arResult['CNT'] < 0)
    return;
if ($arParams['TILED_VIEW'] == 'Y') {
    $tiled = true;
} ?>
<? foreach ($arResult["SECTIONS"] as $key => $arSection): ?>
    <? if ($arSection['NAME']): ?>
        <div class="h2"><?= $arSection['NAME'] ?></div>
    <? endif; ?>
    <div class="cert-<?= ($tiled ? "tile" : "list") ?> stack gallery-hover <?= ($tiled ? "js-height" : "js-width") ?> <?= ($dop_img ? " js-pop up-gallery" : "") ?>">
        <? if ($tiled): ?>
            <div class="row row-clear">
        <? endif; ?>
            <? foreach ($arSection['ITEMS'] as $key => $arElement):
                $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CATALOG_ELEMENT_DELETE_CONFIRM')));
                $bHasPicture = is_array($arElement['PREVIEW_IMG']);
                $dop_img = is_array($arElement['PREVIEW_IMG']['DOP_IMG']);
                ?>
                <div class="item<?= ($dop_img ? " gallery-stack" : "") ?> <?= ($tiled) ? " col-md-4 col-sm-6 col-12" : ""?>" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
                    <? if ($arParams["DISPLAY_PICTURE"] != "N" && $bHasPicture): ?>
                        <? if ($tiled):?>
                            <div class="js-trg">
                        <? endif; ?>
                        <div class="pic<?= ($tiled ? "" : " js-width-trg") ?>">
                            <div class="pic_i">
                                <a class="link"
                                    title="<?=htmlspecialchars($arElement['PREVIEW_IMG']['ALT'])?>"
                                    href="<?= $arElement['DETAIL_PICTURE']['SRC'] ?>"
                                    <? if ($dop_img): ?>
                                        data-gallery='[
                                        <? $count = count($arElement['PREVIEW_IMG']['DOP_IMG']);
                                        $i = 0;
                                        foreach ($arElement['PREVIEW_IMG']['DOP_IMG'] as $arPhoto):?>
                                            <?$i++;?>
                                            {"href":"<?= $arPhoto['IMG']['SRC'] ?>",
                                            "title":"<?= (strlen($arPhoto['DESC']['description']) > 0 ? htmlspecialchars($arPhoto['DESC']['description']) : htmlspecialchars($arElement["NAME"])) ?>"}
                                            <? if ($count != $i): ?>
                                            ,
                                            <? endif; ?>
                                        <? endforeach; ?>
                                                ]'
                                    <? endif; ?>
                                >
                                    <i class="icon ic-loop"></i>
                                    <img src="<?= $arElement['PREVIEW_IMG']['SRC']; ?>" alt="<?= $arElement['PREVIEW_IMG']['ALT'] ?>" title="<?= $arElement['PREVIEW_IMG']['TITLE'] ?>">
                                </a>
                            </div>
                        </div>
                        <? if ($tiled): ?>
                            </div>
                        <? endif; ?>
                    <? endif; ?>
                    <div class="wrap">
                        <? if ($arParams["DISPLAY_NAME"] != "N" && $arElement["NAME"]):?>
                            <div class="title h<?=($tiled?"4":"3")?>"><?= $arElement["NAME"] ?></div>
                        <? endif; ?>
                        <? if (strlen($arElement["DETAIL_TEXT"] && $arParams["DISPLAY_PREVIEW_TEXT"] != "N") > 0):?>
                            <div class="<?= ($tiled) ? "caption-" : ""?>text ">
                                <? if ($arElement['DETAIL_TEXT_TYPE'] == 'html'):?>
                                    <?= $arElement["DETAIL_TEXT"] ?>
                                <? else:?>
                                    <p><?= $arElement["DETAIL_TEXT"] ?></p>
                                <? endif; ?>
                            </div>
                        <? endif; ?>
                    </div>
                </div>
            <? endforeach; ?>
        <? if ($tiled): ?>
            </div>
        <? endif; ?>
    </div>
<? endforeach; ?>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
<? endif; ?>
    <script>
        BX.ready(function () {
            ///SEARCH///
            var r = t = null;
            r = new RegExp('^#element-([0-9]+)+$', 'ig');
            t = r.exec(window.location.hash);
            if (t != null) {
                setTimeout(function () {
                    BX(t[0].substr(1)).click();
                }, 500);
            }
        });
    </script>

    <script>
        !function() {
            'use strict';

            // init popup-gallery
            function popupCert() {
                var galleryList = $('.gallery-hover');
                if (!galleryList.length || !$.fn.magnificPopup) {
                    return false;
                }
                galleryList.find('.item').find('.link').each(function() {
                    var self = $(this);
                    var data = self.data('gallery');
                    var src = [{
                        src: self.attr('href'),
                        title: self.attr('title')
                    }];
                    if ((typeof data) !== 'undefined') {
                        for (var i = 0; i < data.length; i++) {
                            src.push({
                                src: data[i].href,
                                title: data[i].title
                            });
                        }
                    }
                    self.magnificPopup({
                        type: 'image',
                        closeOnContentClick: false,
                        closeBtnInside: false,
                        mainClass: 'mfp-with-zoom mfp-img-mobile',
                        image: {
                            verticalFit: true
                        },
                        gallery: {
                            enabled: true //false
                        },
                        zoom: {
                            enabled: true,
                            duration: 300, // don't forget to change the duration also in CSS
                            opener: function () {
                                return self;
                            }
                        },
                        items: src
                    });
                });
            }

            // Call functions
            $(window).on('load', function() {
                popupCert();
            });
        }();
    </script>