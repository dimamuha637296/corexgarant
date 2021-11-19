<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$this->setFrameMode(true);
//pr($arResult["IMAGES"]);
$imCount = count($arResult["IMAGES"]);

$sale = $arResult['PROPERTIES']['FLG_SALE']['VALUE'] && isset($arResult['PROPERTIES']['FLG_SALE']['VALUE']);
$new = $arResult['PROPERTIES']['FLG_NEW']['VALUE'] && isset($arResult['PROPERTIES']['FLG_NEW']['VALUE']);
$hit = $arResult['PROPERTIES']['FLG_HIT']['VALUE'] && isset($arResult['PROPERTIES']['FLG_HIT']['VALUE']);

$detText = $arResult["DETAIL_TEXT"];

$characteristics =  intval($arResult['CHARACTERISTICS_COUNT'])>0;
$characteristicsTitle = ($arResult['PROPERTIES']['CHARACTERISTICS_TITLE']['~VALUE']?$arResult['PROPERTIES']['CHARACTERISTICS_TITLE']['~VALUE']:Getmessage("DB_TAB_CHAR"));

$dopDesc = count($arResult['PROPERTIES']['DESCRIPTION']['VALUE'])>0 && $arResult['PROPERTIES']['DESCRIPTION']['VALUE'][0]["TEXT"];
$descTitle = ($arResult['PROPERTIES']['DESCRIPTION']['~DESCRIPTION'][$key]?$arResult['PROPERTIES']['DESCRIPTION']['~DESCRIPTION'][$key]:GetMessage("NO_DESC_NAME"));

$files = count($arResult['MORE_FILES']) > 0;
$fileTitle =($arResult['PROPERTIES']['DOP_FILES_TITLE']["~VALUE"]?$arResult['PROPERTIES']['DOP_FILES_TITLE']["~VALUE"]:Getmessage("DB_TAB_FILES"));

$video = count($arResult['PROPERTIES']['VIDEO']['VALUE']) > 0 && strlen($arResult['PROPERTIES']['VIDEO']['VALUE'][0]) > 0;
$videoTitle =($arResult['PROPERTIES']['DOP_VIDEO_TITLE']["~VALUE"]?$arResult['PROPERTIES']['DOP_VIDEO_TITLE']["~VALUE"]:Getmessage("DB_TAB_VIDEO"));

$canBuyStatus = canBuyStatus(
    $arResult["MIN_PRICE"]["VALUE"],
    $arParams['USE_QUANTITY_FOR_ORDER'],
    $arResult['CATALOG_QUANTITY'],
    $arResult['PROPERTIES']['FLG_AVAILABLE']['VALUE_XML_ID']
);

$itemMeasure = $arResult['CATALOG_MEASURE_RATIO'];
?>

<h1 class="mt_0 " id="title" itemprop="name">
	<?if(strlen($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) >0):?>
		<?=$arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]?>
	<?else:?>
		<?=$arResult["NAME"]?>
	<?endif;?>
</h1>

<div class="row mb_3 catalog-item item-box" data-id="<?=$arResult["ID"]?>">

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
			<div class="sl-element-circ inited-not">
				<div class="wrapper" >
					<div class="inner">
						<div class="carousel-wrapper cursor">
							<div id="carousel" class="popup-gallery">
								<?$i=1;foreach($arResult["IMAGES"] as $key => $img):?>
									<div data-slide="<?=$i?>" class="sl-item"><a href="<?=$img["BIG_IMG"]["src"]?>"><img src="<?=$img["IMG"]["src"]?>"<?=($i == 1 ? ' class="main-image"' : '')?> alt="element" title="element"></a></div>
								<?$i++;endforeach; ?>
							</div>
						</div>
						<?if($imCount >1):?>
							<div class="pager-wrapper hidden-print">
								<a id="gal_prev" href="#" class="prev ic-sl-prev"></a><a id="gal_next" href="#" class="next ic-sl-next"></a>
								<div id="pager">
									<?$i=1;foreach($arResult["IMAGES"] as $key => $img):?>
										<div data-slide="<?=$i?>" class="pag sl-item" >
											<img src="<?=$img["SMALL_IMG"]["src"]?>" alt="<?=$img["NAME"]["description"]?>" title="<?=$img["NAME"]["description"]?>">
										</div>
									<?$i++;endforeach; ?>
								</div>
							</div>
						<?endif;?>
					</div>
				</div>
			</div>
		<?endif;?>
	</div>
	<div class="col-12 col-sm-5">
		<div class="element-descr">
            <?if($arParams['DETAIL_AVAILABILITY'] == 'Y'):?>
                <div class="no-item">
                    <?if($canBuyStatus == 1):?>
                        <span class="available weee nowrap">
                            <?=$arParams['DETAIL_AVAILABILITY_YES'];?>
                        </span>
                    <?else:?>
                        <?=$arParams['DETAIL_AVAILABILITY_NO'];?>
                    <?endif;?>
                </div>
            <?endif;?>
			<?if($arParams['DETAIL_BRAND'] == "Y" && !empty($arResult["BRAND"])):?>
				<div class="all-brand">
					<div class="media-old">
						<div class="pic media-left-old">
							<img src="<?=$arResult["BRAND"]["IMG"]["src"]?>" alt="<?=$arResult["BRAND"]["NAME"]?>" title="<?=$arResult["BRAND"]["NAME"]?>">
						</div>
						<div class="media-body-old">
							<div class="text">
								<a href="<?=$arResult["BRAND"]["DETAIL_PAGE_URL"]?>"><?=str_replace("#BRAND#", '<br>'.$arResult["BRAND"]["NAME"], $arParams["DETAIL_BRAND_LINK_TEXT"])?></a>
							</div>
						</div>
					</div>
				</div>
			<?endif;?>

            <?////ORDER/////?>
            <?if($arResult["MIN_PRICE"]["VALUE"]):?>
				<div class="price-wrap">
                    <?if($arResult["MIN_PRICE"]["DISCOUNT_DIFF"] > 0):?>
                        <div class="price-old">
                            <?=$arResult["MIN_PRICE"]["PRINT_VALUE"];?>
                        </div>
                    <?elseif($arResult['PROPERTIES']['OLD_PRICE']['VALUE'] && strlen($arResult['PROPERTIES']['OLD_PRICE']['VALUE'])>0):?>
						<div class="price-old">
                            <?=SaleFormatCurrency($arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"], $arResult["MIN_PRICE"]["CURRENCY"]);?>
						</div>
                    <?endif;?>
                    <div class="price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                        <meta itemprop="priceCurrency" content="<?=$arResult["MIN_PRICE"]['CURRENCY']?>">
                        <?if($canBuyStatus == 1):?>
                            <link itemprop="availability" href="http://schema.org/InStock" />
                        <?endif;?>
                        <span itemprop="price" content="<?=$arResult["MIN_PRICE"]['VALUE']?>">
                            <?if($arResult["MIN_PRICE"]["DISCOUNT_DIFF"] > 0):?>
                                <?=$arResult["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"];?>
                            <?else:?>
                                <?=$arResult["MIN_PRICE"]["PRINT_VALUE"];?>
                            <?endif;?>
                        </span>
                    </div>
				</div>
            <?endif;?>

                <div class="buy">
                    <?if($canBuyStatus == 1):?>
						<?if($arParams['USE_PRODUCT_QUANTITY'] == "Y"):?>
							<div class="item_buttons_counter_block catalog-btn-counter btn-pm">
								<a href="javascript:void(0)" class="bx_bt_button_type_2 bx_small bx_fwb btn-down jq-number__spin minus" data-count-delta="<?=$itemMeasure?>"></a>
								<input type="text" value="<?=$itemMeasure?>" class="tac transparent_input quantity form-control">
								<a href="javascript:void(0)" class="bx_bt_button_type_2 bx_small bx_fwb btn-up jq-number__spin plus" data-count-delta="<?=$itemMeasure?>"></a>
							</div>
						<?endif;?>
						<div class="btn-b">
                        	<a href="javascript:void(0)" class="btn btn-default btn-buy"><?=$arParams['MESS_BTN_ADD_TO_BASKET']?></a>
						</div>
                        <?if($arParams['BUY_ONE_CLICK_SECTION'] == 'Y'):?>
							<div class="btn-b">
								<a class="lnk-pseudo buy-one-click" data-id="<?=$arResult["ID"]?>" data-type="catalog" data-toggle="modal" href="#buyOneClickForm">
									<?=GetMessage("DB_BUY_ONE_CLICK")?>
								</a>
							</div>
                        <?endif;?>
                    <?elseif($canBuyStatus == 2):?>
					<div class="btn-b">
                        <a data-val-item="<?=$arResult["NAME"]?>" data-toggle="modal" data-target="#FRM_preorder" class="btn btn-default css_submit_preorder" >
                            <?=$arParams["BTN_PREORDER"]?>
                        </a>
					</div>
                    <?endif;?>
					<?if($arParams['DISPLAY_COMPARE'] == 'Y'):?>
						<label class="label_compare">
							<input class="formstyler db_compare" type="checkbox">
							<span><?=($arParams['NAME_COMPARE_BTN']?$arParams['NAME_COMPARE_BTN']:GetMessage("NAME_COMPARE_BTN"))?></span>
						</label>
					<?endif;?>

                </div>
            <?////ORDER/////?>

			<div class="text">
				<?if($arResult['PROPERTIES']['ARTICLE']['VALUE'] && strlen($arResult['PROPERTIES']['ARTICLE']['VALUE'])>0):?>
					<div class="p">
						<?=$arResult['PROPERTIES']['ARTICLE']['NAME']?>: <b><?=$arResult['PROPERTIES']['ARTICLE']['VALUE']?></b>
					</div>
				<?endif;?>
				<?//*?>

				<?if($arResult["PREVIEW_TEXT"]):
					$arParams["DETAIL_LONG_TEXT"]=$arParams["DETAIL_LONG_TEXT"]?$arParams["DETAIL_LONG_TEXT"]:"500";
				?>
					<div itemprop="description">
						<div class="p">
							<div data-length="<?=$arParams["DETAIL_LONG_TEXT"]?>" class="p js-cutter">
								<?=$arResult["~PREVIEW_TEXT"]?>
							</div>
						</div>
					</div>
				<?endif;?>
			</div>
		</div>
	</div>
</div>
<?/*$APPLICATION->IncludeFile(
	SITE_DIR.'include/catalog_social.php',
	Array(),
	Array("MODE"=>"text", "SHOW_BORDER" => true, "NAME" => "catalog_social", 'TEMPLATE' => 'default.php')
);*/?>
<?if($arParams["DETAIL_TAB"] == "Y"):?>
	<?if($detText || $characteristics || $dopDesc || $video || $files):?>
		<?$tab =true;?>
		<div class="element-tabs" role="tabpanel">
			<ul class="nav nav-tabs list-reset" role="tablist">
				<?if($detText):?>
					<li role="presentation">
						<a class="tab-head" href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab"><?=Getmessage("DB_TAB_TEXT")?></a>
					</li>
				<?endif;?>
				<?if($characteristics):?>
					<li role="presentation">
						<a class="tab-head" href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab"><?=$characteristicsTitle?></a>
					</li>
				<?endif;?>
				<?if($dopDesc):?>
					<?$g=10;foreach($arResult['PROPERTIES']['DESCRIPTION']['VALUE'] as $key => $arDesc):?>
						<li role="presentation">
							<a class="tab-head" href="#tab-<?=$g?>" aria-controls="tab-<?=$g?>" role="tab" data-toggle="tab">
								<?=($arResult['PROPERTIES']['DESCRIPTION']['DESCRIPTION'][$key]?$arResult['PROPERTIES']['DESCRIPTION']['DESCRIPTION'][$key]:GetMessage("DB_DEFAULT_NAME_TAB"))?>
							</a>
						</li>
						<?$g++;endforeach;?>
				<?endif;?>
				<?if($video):?>
					<li role="presentation">
						<a class="tab-head" href="#tab-3" aria-controls="tab-3" role="tab" data-toggle="tab"><?=$videoTitle?></a>
					</li>
				<?endif;?>
				<?if($files):?>
					<li role="presentation">
						<a class="tab-head" href="#tab-4" aria-controls="tab-4" role="tab" data-toggle="tab"><?=$fileTitle?></a>
					</li>
				<?endif;?>
			</ul>
			<?($tab =true);?>
			<div class="tab-content">
				<?if($detText):?>
					<div id="tab-1" class="tab-pane fade" role="tabpanel">
						<?=$arResult["~DETAIL_TEXT"]?>
					</div>
				<?endif;?>
				<?if($characteristics):?>
					<div id="tab-2" class="tab-pane fade" role="tabpanel">
						<div class="table-responsive element-table">
                            <?/*$APPLICATION->IncludeComponent(
	"energosoft:energosoft.group_property_manual", 
	".default", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"ES_ELEMENT" => $arResult["ID"],
		"ES_GROUP_0" => array(
			0 => "PROP_41",
			1 => "PROP_13",
			2 => "PROP_42",
			3 => "PROP_2",
			4 => "PROP_1",
			5 => "PROP_4",
			6 => "PROP_50",
			7 => "PROP_14",
		),
		"ES_GROUP_1" => array(
			0 => "PROP_9",
			1 => "PROP_7",
			2 => "PROP_10",
			3 => "PROP_8",
		),
		"ES_GROUP_2" => array(
			0 => "PROP_11",
		),
		"ES_GROUP_COUNT" => "12",
		"ES_GROUP_NAME_0" => "Основные",
		"ES_GROUP_NAME_1" => "Процессор",
		"ES_GROUP_NAME_2" => "Конструкция",
		"ES_IBLOCK_CATALOG" => "5",
		"ES_IBLOCK_TYPE_CATALOG" => "catalog",
		"ES_REMOVE_HREF" => "N",
		"ES_SHOW_EMPTY" => "Y",
		"ES_SHOW_EMPTY_PROPERTY" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"ES_GROUP_NAME_3" => "Размеры и вес",
		"ES_GROUP_3" => array(
			0 => "PROP_17",
			1 => "PROP_15",
			2 => "PROP_16",
			3 => "PROP_52",
		),
		"ES_GROUP_NAME_4" => "Датчики",
		"ES_GROUP_4" => array(
		),
		"ES_GROUP_NAME_5" => "Экран",
		"ES_GROUP_5" => array(
			0 => "PROP_20",
			1 => "PROP_25",
			2 => "PROP_4",
			3 => "PROP_19",
		),
		"ES_GROUP_NAME_6" => "Объектив",
		"ES_GROUP_6" => array(
			0 => "PROP_21",
			1 => "PROP_23",
		),
		"ES_GROUP_NAME_7" => "Работа с изображением",
		"ES_GROUP_7" => array(
			0 => "PROP_23",
			1 => "PROP_27",
			2 => "PROP_30",
			3 => "PROP_33",
			4 => "PROP_24",
			5 => "PROP_26",
		),
		"ES_GROUP_NAME_8" => "Работа со звуком",
		"ES_GROUP_8" => array(
			0 => "PROP_32",
			1 => "PROP_29",
		),
		"ES_GROUP_NAME_9" => "Передача данных",
		"ES_GROUP_9" => array(
		),
		"ES_GROUP_NAME_10" => "Интерфейсы",
		"ES_GROUP_10" => array(
			0 => "PROP_39",
			1 => "PROP_38",
			2 => "PROP_37",
			3 => "PROP_34",
		),
		"ES_GROUP_NAME_11" => "Аккумулятор",
		"ES_GROUP_11" => array(
			0 => "PROP_46",
			1 => "PROP_45",
			2 => "PROP_44",
		),
		"ES_GROUP_NAME_12" => "",
		"ES_GROUP_12" => "",
		"ES_GROUP_NAME_13" => "",
		"ES_GROUP_13" => "",
		"ES_GROUP_NAME_14" => "",
		"ES_GROUP_14" => ""
	),
	false
);
//*/
?>
							<?//*/?>
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
							<?//*/?>
						</div>
					</div>
				<?endif;?>
				<?if($dopDesc):?>
					<?$j=10;foreach($arResult['PROPERTIES']['DESCRIPTION']['~VALUE'] as $key => $arDesc):?>
						<div id="tab-<?=$j?>" class="tab-pane fade" role="tabpanel">
							<?=$arDesc["TEXT"]?>
						</div>
						<?$j++;endforeach;?>
				<?endif;?>
				<?if($video):?>
					<div id="tab-3" class="tab-pane fade" role="tabpanel">
						<div class="row clear">
							<?foreach($arResult['PROPERTIES']['VIDEO']['~VALUE'] as $num => $arVideo):?>
								<div class="col-10 col-md-5 col-sm-10">
									<iframe width="400" height="345" src="<?=$arVideo?>" allowfullscreen></iframe>
								</div>
							<?endforeach;?>
						</div>
						<div class="clear"></div>
					</div>
				<?endif;?>
				<?if($files):?>
					<div id="tab-4" class="tab-pane fade" role="tabpanel">
						<?$arResult['MORE_FILES']['ARGS']['COLUM'] = intval($arParams["COLUMN_COUNT_FOR_MORE_FILES"]) > 0 ? $arParams["COLUMN_COUNT_FOR_MORE_FILES"] : 2;
						$arResult['MORE_FILES']['ARGS']['COLUM_MAX'] = $arParams['COLUM_GRID'];
						$arResult['MORE_FILES']['ARGS']['FORSE_DOWN_LOAD'] = "N";
						?>
						<div class="b-dop_files">
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

<?else:?>
	<?=$arResult["~DETAIL_TEXT"]?>
	<?if($characteristics):?>
	<div class="h2"><?=$characteristicsTitle?></div>
	<div class="table-responsive element-table">
		<table>
			<tbody>
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
			</tbody>
		</table>
	</div>
	<?endif;?>

	<?if($dopDesc):?>
		<?foreach($arResult['PROPERTIES']['DESCRIPTION']['~VALUE'] as $key => $arDesc):?>
			<div class="h2"><?=$descTitle?></div>
			<?=$arDesc["TEXT"]?>
		<?endforeach;?>
	<?endif;?>

	<?if($video):?>
		<div class="h2"><?=$videoTitle?></div>
		<div class="row clear">
			<?foreach($arResult['PROPERTIES']['VIDEO']['~VALUE'] as $num => $arVideo):?>
				<div class="col-10 col-md-5 col-sm-10">
					<iframe width="400" height="345" src="<?=$arVideo?>" allowfullscreen></iframe>
				</div>
			<?endforeach;?>
		</div>
	<?endif;?>

	<?if($files):?>
			<div class="h2"><?=$fileTitle?></div>
			<?
			$arResult['MORE_FILES']['ARGS']['COLUM'] = intval($arParams["COLUMN_COUNT_FOR_MORE_FILES"]) > 0 ? $arParams["COLUMN_COUNT_FOR_MORE_FILES"] : 2;
			$arResult['MORE_FILES']['ARGS']['COLUM_MAX'] = $arParams['COLUM_GRID'];
			$arResult['MORE_FILES']['ARGS']['FORSE_DOWN_LOAD'] = "N";
			?>
			<div class="b-dop_files">
				<?$APPLICATION->IncludeComponent(
					$arResult['MORE_FILES']['COMPONENT']['NAME'],$arResult['MORE_FILES']['COMPONENT']['TEMPLATE'],
					$arResult['MORE_FILES']['ARGS'],
					false, array('HIDE_ICONS' => 'Y')
				);
				?>
			</div>

	<?endif;?>
<?endif;?>
<?if($imCount >1):?>
<script>
	!function () {
		'use strict';
		var sliderBlock = $('.sl-element-circ');
		var $carousel = $('#carousel'),
			$pager = $('#pager');
		var dataIndex = 0;
		var center = 0;
		var pagerItems = $pager.find('.sl-item');
		var galPrev = $('.ic-sl-prev');
		var galNext = $('.ic-sl-next');
		var $visible;

		function getCenterThumb() {
			center = Math.floor($visible / 2);
			return center;
		}

		function pagerInit() {
			$visible = $pager.triggerHandler('currentVisible').length;
			$pager.find('.sl-item').removeClass('selected');
			if ($pager.length && pagerItems.length > $visible) {
				$pager.trigger('slideTo', -getCenterThumb());
				$pager.find('.sl-item').eq(getCenterThumb()).addClass('selected');
			} else {
				$pager.find('.sl-item').eq(dataIndex).addClass('selected');
				galPrev.hide();
				galNext.hide();
			}
		}

		function pagerSlideTo(data) {
			dataIndex = data.items.visible.first().data('slide');
			if ($pager.length && pagerItems.length > $visible) {
				$pager.trigger('slideTo', ['.pag.sl-item[data-slide="' + dataIndex + '"]', -getCenterThumb()]);
				$pager.find('.sl-item').removeClass('selected');
			}
		}

		function pagerSetSelected() {
			if ($pager.length && pagerItems.length > $visible) {
				$pager.find('.sl-item').eq(getCenterThumb()).addClass('selected');
			} else {
				$pager.find('.sl-item').removeClass('selected');
				$pager.find('.sl-item').eq(dataIndex - 1).addClass('selected');
			}
		}

		function slider() {
			sliderBlock.removeClass('inited-not');

			sliderBlock.addClass('inited');

			$carousel.carouFredSel({
				responsive: true,
				width: '100%',
				height: 250,
				auto: false,
				items: {
					visible: 1
				},
				prev: '#gal_prev',
				next: '#gal_next',
				scroll: {
					timeoutDuration: 2000,
					pauseOnHover: true,
					fx: 'crossfade',
					onBefore: function (data) {
						pagerSlideTo(data);
					},
					onAfter: function () {
						pagerSetSelected();
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
						start: 0
					},
					scroll: {
						items: 1,
						fx: 'directscroll',
						pauseOnHover: true
					},
					onCreate: function () {
						pagerInit();
					}
				});
				$pager.on('click', '.sl-item', function () {
					var src = $(this).data('slide');
					$carousel.trigger('slideTo', ['.sl-item[data-slide="' + src + '"]']);
				});
			}
		}

		function popupGallery() {
			$('.popup-gallery').magnificPopup({
				delegate: 'a',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				mainClass: 'mfp-img-mobile',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function (item) {
						return false;
					}
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

		$(function () {
			slider();
			popupGallery();
		});
		$(window).on('load', function () {
			slider();
			popupGallery();
		});
	}();
</script>
<?endif;?>


<?//*/?>

<?//pr($arParams)?>
