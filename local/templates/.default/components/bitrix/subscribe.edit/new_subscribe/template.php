<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<div class="subscr page">
<?

foreach($arResult["MESSAGE"] as $itemID=>$itemValue):?>
	<div role="alert" class="alert alert-success"><?=$itemValue?></div>
<?endforeach;?>
<?foreach($arResult["ERROR"] as $itemID=>$itemValue):?>
	<div role="alert" class="alert alert-danger"><?=$itemValue?></div>
	<?endforeach;?>
<?//whether to show the forms
if($arResult["ID"] == 0 && empty($_REQUEST["action"]) || CSubscription::IsAuthorized($arResult["ID"]))
{
	//show confirmation form
	if($arResult["ID"]>0 && $arResult["SUBSCRIPTION"]["CONFIRMED"] <> "Y")
	{
		include("confirmation.php");
	}
	//show current authorization section
	/*if($USER->IsAuthorized() && ($arResult["ID"] == 0 || $arResult["SUBSCRIPTION"]["USER_ID"] == 0))
	{
		include("authorization.php");
	}

	//show authorization section for new subscription
	if($arResult["ID"]==0 && !$USER->IsAuthorized())
	{
		if($arResult["ALLOW_ANONYMOUS"]=="N" || ($arResult["ALLOW_ANONYMOUS"]=="Y" && $arResult["SHOW_AUTH_LINKS"]=="Y"))
		{
			include("authorization_new.php");
		}
	}
	*/
	//setting section
	include("setting.php");
	//status and unsubscription/activation section
	if($arResult["ID"]>0)
	{
		include("status.php");
	}
	/*
	?>
	<p><b class="rq">*</b><?echo GetMessage("subscr_req")?></p>
	<?
	*/
}
else
{
	//subscription authorization form
	include("authorization_full.php");
}
?>
</div>