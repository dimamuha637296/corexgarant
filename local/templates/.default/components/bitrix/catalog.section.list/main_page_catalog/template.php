<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if(count($arResult["SECTIONS"]) < 1): return false; endif;
?>
	<div class="goods">
		<div class="title-wrap">
			<?if(strlen($arParams["CATALOG_TITLE"])>0):?>
				<div class="b-title"><?=$arParams["CATALOG_TITLE"]?></div>
			<?endif;?>
			<?if(strlen($arParams["CATALOG_HREF"])>0 && strlen($arParams["CATALOG_DOP_TITLE"])>0):?>
				<a href="<?=$arParams["CATALOG_HREF"]?>" class="b-link"><?=$arParams["CATALOG_DOP_TITLE"]?></a>
			<?endif;?>
		</div>
		<div class="list-item">
			<?$i=1;foreach($arResult["SECTIONS"] as $arSection):
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="item <?if($i=="1"):?>item-lg<?elseif($i=="3" || $i=="4"  || $i=="7"):?>item-sm<?elseif($i=="8"):?>right<?elseif($i=="9"):?>item-sm right<?endif;?>"
					 <?/*?>id="<?=$this->GetEditAreaId($arSections['ID']);?>"<?//*/?>>
					<a href="<?=$arSection["SECTION_PAGE_URL"]?>">
						<?if($arSection["PREVIEW_IMG"]):?>
							<img src="<?=$arSection['PREVIEW_IMG']['src'];?>" alt="<?=$arSections["NAME"]?>" class="img">
						<?endif;?>
						<div class="title"><?=$arSection["~NAME"]?></div>
					</a>
				</div>
			<?$i++;endforeach;?>

		</div>
	</div>
