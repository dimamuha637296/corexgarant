<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
//pr($arResult["SECTIONS"]);
?>
	<div class="catalog-detail js-height js-width ">
		<?
		foreach ($arResult["SECTIONS"] as $key => $arSection):
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
		?>
			<?if($arSection["DEPTH_LEVEL"] >= $arResult["SECTIONS"][$key+1]["DEPTH_LEVEL"]):?>
			<div class="item" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
				<div class="media-old">
					<? if ($arSection["PREVIEW_IMG"]): ?>
						<div class="pic media-left-old js-width-trg">
							<img src="<?= $arSection["PREVIEW_IMG"]["src"] ?>" alt="<?= $arSection["NAME"] ?>" class="img">
						</div>
					<? endif;?>
					<div class="media-body-old">
						<div class="h2 title-cat mb_2 mt_1">
							<a href="<?= $arSection["SECTION_PAGE_URL"] ?>"><?= $arSection["~NAME"] ?></a>
						</div>
						<? if ($arSection["~DESCRIPTION"]): ?>
							<div class="text">
								<?= $arSection["~DESCRIPTION"] ?>
							</div>
						<? endif;?>
						<? if (count($arResult['SECTION_ELEMENTS'][$arSection['ID']]) > 0): ?>
							<div class="catalog-block js-height">
								<div class="row row-clear">
									<? foreach ($arResult['SECTION_ELEMENTS'][$arSection['ID']] as $elem): ?>
										<div class="item col-lg-4 col-sm-4 col-12">
											<div class="wrap">
												<?if($elem['PREVIEW_IMG']):?>
											 	<div class="pic js-trg">
													<a href="<?= $elem['DETAIL_PAGE_URL'] ?>" class="link">
														<img src="<?= $elem['PREVIEW_IMG']['src'] ?>" alt="<?= $elem['NAME'] ?>" title="<?= $elem['NAME'] ?>" class="img">
													</a>
												</div>
												<?endif;?>
												<div class="descr">
													<div class="title js-ttl">
														<a href="<?= $elem['DETAIL_PAGE_URL'] ?>"><?=$elem['~NAME'] ?></a>
													</div>
												</div>
											</div>
										</div>
									<? endforeach; ?>
								</div>
								<a href="<?= $arSection["SECTION_PAGE_URL"] ?>"><?=GetMessage('LIST_ALL_PRODUCT') ?></a>
							</div>
						<? endif;?>
					</div>
				</div>
			</div>
			<?endif;?>
		<?endforeach; ?>
	</div>
<? //pr($arResult);?>