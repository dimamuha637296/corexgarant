<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$this->setFrameMode(true);
//pr($arResult["IMAGES"]);
$imCount = count($arResult["IMAGES"]);
$sale = $arResult['PROPERTIES']['FLG_SALE']['VALUE'] && isset($arResult['PROPERTIES']['FLG_SALE']['VALUE']);
$new = $arResult['PROPERTIES']['FLG_NEW']['VALUE'] && isset($arResult['PROPERTIES']['FLG_NEW']['VALUE']);
$hit = $arResult['PROPERTIES']['FLG_HIT']['VALUE'] && isset($arResult['PROPERTIES']['FLG_HIT']['VALUE']);
$availability = $arResult['PROPERTIES']['FLG_AVAILABLE']['VALUE'] && isset($arResult['PROPERTIES']['FLG_AVAILABLE']['VALUE']);
$article = $arResult['PROPERTIES']['ARTICLE']['VALUE'] && strlen($arResult['PROPERTIES']['ARTICLE']['VALUE'])>0;
$price = $arResult['PROPERTIES']['PRICE']['VALUE'] && strlen($arResult['PROPERTIES']['PRICE']['VALUE'])>0;
$oldPrice = $arResult['PROPERTIES']['OLD_PRICE']['VALUE'] && strlen($arResult['PROPERTIES']['OLD_PRICE']['VALUE'])>0;
$brand = $arResult["BRAND"];
$detText = $arResult["DETAIL_TEXT"];
$characteristics =  intval($arResult['CHARACTERISTICS_COUNT'])>0;
$dopDesc = count($arResult['PROPERTIES']['DESCRIPTION']['VALUE'])>0 && $arResult['PROPERTIES']['DESCRIPTION']['VALUE'][0]["TEXT"];
$files = count($arResult['MORE_FILES']) > 0;
$video = count($arResult['PROPERTIES']['VIDEO']['VALUE']) > 0 && isset($arResult['PROPERTIES']['VIDEO']['VALUE'][0]["path"]) && strlen($arResult['PROPERTIES']['VIDEO']['VALUE'][0]["path"]) > 0;
?>
<h1 class="mt_0 " id="title" itemprop="name">
    <?if(strlen($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) >0):?>
        <?=$arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]?>
    <?else:?>
        <?=$arResult["NAME"]?>
    <?endif;?>
</h1>

<div class="row mb_3">

	<div class="col-12 col-sm-7">
        <?if($sale || $new || $hit):?>
        <div class="element-sale">
            <?if($sale):?>
                <div class="icon percent"></div>
            <?endif;?>
            <?if($new):?>
                <div class="icon new"></div>
            <?endif;?>
            <?if($hit):?>
                <div class="icon sale"></div>
            <?endif;?>
        </div>
        <?endif;?>
		<?if($arResult["IMAGES"]):?>
            <div class="slider-element">
                <div id="wrapper" class="">
                    <div id="inner">
                        <div id="carousel-wrapper " class="cursor slide_gallery">
                            <div id="carousel">
                                <?$i=1;foreach($arResult["IMAGES"] as $key => $img):?>
                                    <div class="sl-item" data-slide="<?=$i?>">
                                        <a href="<?=$img["BIG_IMG"]["src"]?>" title="<?=$img["NAME"]["description"]?>">
                                            <img src="<?=$img["IMG"]["src"]?>" alt="<?=$img["NAME"]["description"]?>" title="<?=$img["NAME"]["description"]?>">
                                        </a>
                                    </div>
                                <?$i++;endforeach; ?>
                            </div>
                            <script>
                                !function () {
                                    'use strict';
                                    function initGal() {
                                        var galleryList = $('.slide_gallery');
                                        if (galleryList.length  && $.fn.magnificPopup) {
                                            galleryList.magnificPopup({
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
                                                    duration: 300, // don't foget to change the duration also in CSS
                                                    opener: function(element) {
                                                        return element.find('img');
                                                    }
                                                }
                                            });
                                        }
                                    }
                                    $(window).load(function () {
                                        initGal();
                                    });
                                }();
                            </script>
                        </div>
                        <?if($imCount >1):?>
                            <div id="pager-wrapper">
                                <?if($imCount >7):?>
                                <a id="gal_prev" class="prev ic-sl-prev" href="#"></a>
                                <a id="gal_next" class="next ic-sl-next" href="#"></a>
                                <?endif;?>
                                <div id="pager">
                                    <?$i=1;foreach($arResult["IMAGES"] as $key => $img):?>
                                        <div class="pag sl-item" data-slide="<?=$i?>">
                                            <img src="<?=$img["SMALL_IMG"]["src"]?>" alt="<?=$img["NAME"]["description"]?>" title="<?=$img["NAME"]["description"]?>">
                                        </div>
                                    <?$i++;endforeach; ?>
                                </div>
                            </div>
                        <?endif;?>
                    </div>
                </div>
                <?if($imCount>1):?>
                <script>
                    $(window).load(function() {
                        var $carousel = $('#carousel'),
                            $pager = $('#pager');

                        function getCenterThumb() {
                            var $visible = $pager.triggerHandler( 'currentVisible' );
                            center = Math.floor($visible.length / 2);
                            return center;
                        }
                        var src = 0;
                        var center = 0;
                        $carousel.carouFredSel({
                            responsive: true,
                            width: '100%',
                            height: 250,
                            auto: false,//true
                            items: {
                                visible: 1
                            },
                            prev: '#gal_prev',
                            next: '#gal_next',
                            scroll: {
                                timeoutDuration: 3000,
                                pauseOnHover: true,
                                fx: 'crossfade',
                                onBefore: function( data ) {
                                    if ($pager.length) {
                                        center = getCenterThumb();
                                        src = data.items.visible.first().data( 'slide' );
                                        $pager.trigger( 'slideTo', [ '.pag.sl-item[data-slide="'+ src +'"]', - center ] );
                                        $pager.find( '.sl-item' ).removeClass( 'selected' );
                                    }
                                },
                                onAfter: function() {
                                    if ($pager.length) {
                                        $pager.find( '.sl-item' ).eq( getCenterThumb() ).addClass( 'selected' );
                                    }
                                }
                            },
                            swipe: {
                                onMouse: true,
                                onTouch: true,
                                excludedElements: 'button, input, select, textarea, .noSwipe, .btn'
                            }
                        });
                        if ($pager.length) {
                            $pager.carouFredSel({
                                width: '100%',
                                auto: false,
                                height: 80,
                                items: {
//                        visible: 5,
                                    start: -1
                                },
                                onCreate: function() {
                                    center = getCenterThumb();
                                    $pager.trigger( 'slideTo', -center );
                                    $pager.find( '.sl-item' ).eq( center ).addClass( 'selected' );
                                }
                            });
                            $pager.find( '.sl-item' ).click(function() {
                                var src = $(this).data( 'slide' );
                                $carousel.trigger( 'slideTo', [ '.sl-item[data-slide="'+ src +'"]' ] );
                            });
                            $pager.on('mouseenter', function () {
                                $carousel.trigger( 'pause' );
                            });
                            $pager.on('mouseleave', function () {
                                $carousel.trigger( 'resume' );
                            });
                        }
                    });
                </script>
                <?endif;?>
            </div>
		<?endif;?>
	</div>
	<div class="col-12 col-sm-5">
		<div class="element-descr">
			<div class="no-item">
                <?if($availability):?>
                    <span class="available weee nowrap">
				        <?=GetMessage("DB_PRODUCT_YES")?>
                    </span>
                <?else:?>
                    <?=GetMessage("DB_PRODUCT_NOT")?>
                <?endif;?>
			</div>
            <?if($brand):?>
                <div class="all-brand">
                    <div class="media-old">
                        <div class="pic media-left-old">
                            <img src="<?=$arResult["BRAND"]["IMG"]["src"]?>" alt="<?=$arResult["BRAND"]["NAME"]?>" title="<?=$arResult["BRAND"]["NAME"]?>">
                        </div>
                        <div class="media-body-old">
                            <div class="text">
                                <a href="<?=$arResult["BRAND"]["DETAIL_PAGE_URL"]?>"><?=GetMessage("DB_ALL_BRANDS")?><br><?=$arResult["BRAND"]["NAME"]?></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?endif;?>
            <?if($oldPrice || $price):?>
                <div class="price-wrap">
                <?if($oldPrice):?>
                    <div class="price-old">
                        <?=number_format($arResult['PROPERTIES']['OLD_PRICE']['VALUE'], 0, '', ' ')?> <?=$arParams["CATALOG_CURRENCY"]?>
                    </div>
                <?endif;?>
                <?if($price):?>
                <div class="price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                    <meta itemprop="priceCurrency" content="BYR">
                    <span itemprop="price" content="<?=$arResult['PROPERTIES']['PRICE']['VALUE']?>">
                        <?=number_format($arResult['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ')?> <?=$arParams["CATALOG_CURRENCY"]?>
                    </span>
                </div>
                <?endif;?>
            </div>
            <?endif;?>
            <div class="buy">
                <button class="btn btn-default css_submit_catalog" type="button" data-toggle="modal" data-target="#FRM_catalog" data-name="<?=$arResult["NAME"]?>">
                    <?=(strlen($arParams["BTN_NAME"])>0 ? $arParams["BTN_NAME"] : GetMessage("DB_DEFAULT_NAME_BTN"))?>
                </button>
            </div>
			<div class="text">
                <?if($article):?>
                    <div class="p">
                        <?=$arResult['PROPERTIES']['ARTICLE']['NAME']?>: <b><?=$arResult['PROPERTIES']['ARTICLE']['VALUE']?></b>
                    </div>
                <?endif;?>
                <?//*?>
                <?if($arResult["PREVIEW_TEXT"]):?>
                <?if(strlen(cutString($arResult["PREVIEW_TEXT"], $arParams["DETAIL_LONG_TEXT"])) > $arParams["DETAIL_LONG_TEXT"]){
                    $strlPrev = true;
                }
                ?>
                <div itemprop="description">
                    <div class="p_text">
                        <?=cutString($arResult["PREVIEW_TEXT"], $arParams["DETAIL_LONG_TEXT"])?>
                        <?if($strlPrev):?>
                            <a class="dash open click">
                                <span><?=GetMessage("DB_MORE_INFO_TEXT")?></span>
                            </a>
                        <?endif;?>
                    </div>
                    <?if($strlPrev):?>
                        <div class="p_open" style="display: none;">
                            <?=$arResult["PREVIEW_TEXT"]?>
                            <script>
                                $('.open').click(function(){
                                    $(".p_text").css("display", "none");
                                    $(".p_open").css("display", "inline");
                                });
                            </script>
                        </div>
                    <?endif;?>
                </div>
                <?endif;?>
			</div>
		</div>

	</div>
</div>
<?$APPLICATION->IncludeFile(
    SITE_DIR.'include/catalog_social.php',
    Array(),
    Array("MODE"=>"text", "SHOW_BORDER" => true, "NAME" => "catalog_social", 'TEMPLATE' => 'default.php')
);?>
<?if($detText || $characteristics || $dopDesc || $video || $files):?>
<?$tab =true;?>
<div class="element-tabs" role="tabpanel">
    <ul class="nav nav-tabs list-reset" role="tablist">
        <?if($detText):?>
            <li <?if($tab):?>class="active" <?$tab=false;?><?endif;?> role="presentation">
                <a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab"><?=Getmessage("DB_TAB_TEXT")?></a>
            </li>
        <?endif;?>
        <?if($characteristics):?>
            <li <?if($tab):?>class="active" <?$tab=false;?><?endif;?> role="presentation">
                <a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab"><?=Getmessage("DB_TAB_CHAR")?></a>
            </li>
        <?endif;?>
        <?if($dopDesc):?>
            <?$g=10;foreach($arResult['PROPERTIES']['DESCRIPTION']['VALUE'] as $key => $arDesc):?>
            <li <?if($tab && $g==10):?>class="active" <?$tab=false;?><?endif;?> role="presentation">
                <a href="#tab-<?=$g?>" aria-controls="tab-<?=$g?>" role="tab" data-toggle="tab">
                    <?=($arResult['PROPERTIES']['DESCRIPTION']['DESCRIPTION'][$key]?$arResult['PROPERTIES']['DESCRIPTION']['DESCRIPTION'][$key]:GetMessage("DB_DEFAULT_NAME_TAB"))?>
                </a>
            </li>
            <?$g++;endforeach;?>
        <?endif;?>
        <?if($video):?>
            <li <?if($tab):?>class="active" <?$tab=false;?><?endif;?> role="presentation">
                <a href="#tab-3" aria-controls="tab-3" role="tab" data-toggle="tab"><?=Getmessage("DB_TAB_VIDEO")?></a>
            </li>
        <?endif;?>
        <?if($files):?>
            <li <?if($tab):?>class="active" <?$tab=false;?><?endif;?> role="presentation">
                <a href="#tab-4" aria-controls="tab-4" role="tab" data-toggle="tab"><?=Getmessage("DB_TAB_FILES")?></a>
            </li>
        <?endif;?>
    </ul>
    <?($tab =true);?>
    <div class="tab-content">
        <?if($detText):?>
            <div id="tab-1" class="tab-pane fade<?if($tab):?> in active<?$tab=false;?><?endif;?>" role="tabpanel">
                <?=$arResult["DETAIL_TEXT"]?>
            </div>
        <?endif;?>
        <?if($characteristics):?>
            <div id="tab-2" class="tab-pane fade<?if($tab):?> in active<?$tab=false;?><?endif;?>" role="tabpanel">
                <div class="table-responsive element-table">
                    <table>
                        <?foreach($arResult['CHARACTERISTICS'] as $arChar):?>
                            <tr>
                                <td><?=$arChar["NAME"]?>
                                    <?if($arChar["HINT"]):?>
                                        <span class="info">
                                            <span class="symbol">?</span>
                                            <span class="info-block">
                                            <span class="arrow"></span>
                                                <?=$arChar["HINT"]?>
                                            </span>
                                        </span>
                                    <?endif;?>
                                </td>
                                <td>
                                    <?if($arChar["VALUE_XML_ID"] == "Y"):?>
                                        <span class="yes"></span>
                                    <?elseif($arChar["VALUE_XML_ID"] == "N"):?>
                                        <span class="not"></span>
                                    <?else:?>
                                        <?=$arChar["VALUE"]?>
                                    <?endif;?>
                                </td>
                            </tr>
                        <?endforeach;?>
                    </table>
                </div>
            </div>
        <?endif;?>
        <?if($dopDesc):?>
            <?$j=10;foreach($arResult['PROPERTIES']['DESCRIPTION']['~VALUE'] as $key => $arDesc):?>
                <div id="tab-<?=$j?>" class="tab-pane fade<?if($tab):?> in active<?$tab=false;?><?endif;?>" role="tabpanel">
                    <?=$arDesc["TEXT"]?>
                </div>
            <?$j++;endforeach;?>
        <?endif;?>
        <?if($video):?>
            <div id="tab-3" class="tab-pane fade" role="tabpanel">
                    <div class="row">
                        <?foreach($arResult['PROPERTIES']['VIDEO']['VALUE'] as $num => $arVideo):?>
                            <div class="col-5 col-md-5 col-sm-5">
                                <?if(!isset($arVideo["path"]) || strlen($arVideo["path"]) < 1): continue; endif;?>
                                <?if(isset($arVideo["title"]) && strlen($arVideo["title"]) > 0):?>
                                    <h3 class="title mb_1"><?=$arVideo["title"];?></h3>
                                <?endif;?>
                                <?
                                $arResult['VIDEO']['ARGS']['PATH'] = $arVideo["path"];
                                $arResult['VIDEO']['ARGS']['WIDTH'] = strlen($arVideo["width"]) > 0 ? $arVideo["width"] : 400;
                                $arResult['VIDEO']['ARGS']['HEIGHT'] = strlen($arVideo["height"]) > 0 ? $arVideo["height"] : 300;
                                $arResult['VIDEO']['ARGS']['FILE_DESCRIPTION'] = strlen($arVideo["desc"]) > 0 ? $arVideo["desc"] : '';

                                $APPLICATION->IncludeComponent(
                                    $arResult['VIDEO']['COMPONENT']['NAME'], $arResult['VIDEO']['COMPONENT']['TEMPLATE'],
                                    $arResult['VIDEO']['ARGS'],
                                    false, array('HIDE_ICONS' => 'Y')
                                );
                                ?>
                            </div>
                        <?endforeach;?>
                    </div>
                    <div class="clear"></div>
            </div>
        <?endif;?>
        <?if($files):?>
        <div id="tab-4" class="tab-pane fade<?if($tab):?> in active<?$tab=false;?><?endif;?>" role="tabpanel">
            <?$arResult['MORE_FILES']['ARGS']['COLUM'] = intval($arParams["COLUMN_COUNT_FOR_MORE_FILES"]) > 0 ? $arParams["COLUMN_COUNT_FOR_MORE_FILES"] : 2;
            $arResult['MORE_FILES']['ARGS']['COLUM_MAX'] = $arParams['COLUM_GRID'];
            $arResult['MORE_FILES']['ARGS']['FORSE_DOWN_LOAD'] = "N";
            ?>
            <div class="b-dop_files">
                <?if($arResult['PROPERTIES']['MORE_FILES_TITLE']['VALUE']):?>
                    <h3 class="mb_2"><?=$arResult['PROPERTIES']['MORE_FILES_TITLE']['VALUE']?>:</h3>
                <?endif;?>
                <?$APPLICATION->IncludeComponent(
                    $arResult['MORE_FILES']['COMPONENT']['NAME'],$arResult['MORE_FILES']['COMPONENT']['TEMPLATE'],
                    $arResult['MORE_FILES']['ARGS'],
                    false, array('HIDE_ICONS' => 'Y')
                );
                ?>
            </div>
        </div>
        <?endif;?>
    </div>
</div>
<?endif;?>

<?//pr($arResult['CHARACTERISTICS'])?>
