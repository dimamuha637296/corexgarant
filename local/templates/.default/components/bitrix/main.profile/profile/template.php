<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>

<div class="bx-auth-profile">

<?ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<script type="text/javascript">
<!--
var opened_sections = [<?
$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
if (strlen($arResult["opened"]) > 0)
{
	echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
}
else
{
	$arResult["opened"] = "reg";
	echo "'reg'";
}
?>];
//-->

var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
</script>


	<div class="profile">
		<div class="row">
			<div class="col-sm-8 col-lg-6 col-12">
<form class="form-horizontal" method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
<?/*?>
<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("REG_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('reg')"><?=GetMessage("REG_SHOW_HIDE")?></a></div>
<?//*/?>
<div class="profile-block-<?=strpos($arResult["opened"], "reg") === false ? "hidden" : "shown"?>" id="user_div_reg">

	<?
	/*/
	if($arResult["ID"]>0)
	{
	?>

		<?

		if (strlen($arResult["arUser"]["TIMESTAMP_X"])>0)
		{
		?>
		<div class="row">
			<div class="col-lg-2 col-sm-3 col-6"><?=GetMessage('LAST_UPDATE')?></div>
			<div class="col-lg-6 col-sm-5 col-12"><?=$arResult["arUser"]["TIMESTAMP_X"]?></div>
		</div>
		<?
		}
		?>

		<?
		if (strlen($arResult["arUser"]["LAST_LOGIN"])>0)
		{
		?>
		<div class="row">
			<div class="col-lg-2 col-sm-3 col-6"><?=GetMessage('LAST_LOGIN')?></div>
			<div class="col-lg-6 col-sm-5 col-12"><?=$arResult["arUser"]["LAST_LOGIN"]?></div>
		</div>
		<?
		}

		?>

	<?
	}
		//*/
	?>
	<?/*<div class="form-group control-group">
		<label class="name col-12"><?echo GetMessage("main_profile_title")?></label>
		<div class="text col-12"><input class="form-control" type="text" name="TITLE" value="<?=$arResult["arUser"]["TITLE"]?>" /></div>
	</div>*/?>
	<div class="h2">Личные данные</div>

	<div class="form-group control-group">
		<label class="name col-12"><?=GetMessage('NAME')?></label>
		<div class="text col-12"><input class="form-control" type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" /></div>
	</div>
	<div class="form-group control-group">
		<label class="name col-12"><?=GetMessage('LAST_NAME')?></label>
		<div class="text col-12"><input class="form-control" type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" /></div>
	</div>
	<?/*?>
	<div class="form-group control-group">
		<label class="name col-12"><?=GetMessage('SECOND_NAME')?></label>
		<div class="text col-12"><input class="form-control" type="text" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" /></div>
	</div>
	<?/*/?>
	<div class="form-group control-group">
		<label class="name col-12"><?=GetMessage('EMAIL')?><?if($arResult["EMAIL_REQUIRED"]):?><span class="starrequired">*</span><?endif?></label>
		<div class="text col-12"><input class="form-control" type="text" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" /></div>
	</div>
	<div class="form-group control-group">
		<label class="name col-12"><?=GetMessage('LOGIN')?><span class="starrequired">*</span></label>
		<div class="text col-12"><input class="form-control" type="text" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" /></div>
	</div>
<?if($arResult["arUser"]["EXTERNAL_AUTH_ID"] == ''):?>
	<div class="h2">Пароль</div>
	<div class="form-group control-group">

	<label class="name col-12"><?=GetMessage('NEW_PASSWORD_REQ')?></label>
		<div class="text col-12">
		<input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="form-control" />
		<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
				<script type="text/javascript">
				document.getElementById('bx_auth_secure').style.display = 'inline-block';
				</script>
			<?endif?>
		</div>
	</div>
	<div class="form-group control-group">
		<label class="name col-12"><?=GetMessage('NEW_PASSWORD_CONFIRM')?></label>
		<div class="text col-12"><input class="form-control" type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" /></div>
	</div>
<?endif?>
<?if($arResult["TIME_ZONE_ENABLED"] == true):?>


	<tr>
		<td colspan="2" class="profile-header"><?echo GetMessage("main_profile_time_zones")?></td>
	</tr>
	<tr>
		<td><?echo GetMessage("main_profile_time_zones_auto")?></td>
		<td>
			<select name="AUTO_TIME_ZONE" onchange="this.form.TIME_ZONE.disabled=(this.value != 'N')">
				<option value=""><?echo GetMessage("main_profile_time_zones_auto_def")?></option>
				<option value="Y"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "Y"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
				<option value="N"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "N"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td><?echo GetMessage("main_profile_time_zones_zones")?></td>
		<td>
			<select name="TIME_ZONE"<?if($arResult["arUser"]["AUTO_TIME_ZONE"] <> "N") echo ' disabled="disabled"'?>>
				<?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name):?>
								<option value="<?=htmlspecialcharsbx($tz)?>"<?=($arResult["arUser"]["TIME_ZONE"] == $tz? ' SELECTED="SELECTED"' : '')?>><?=htmlspecialcharsbx($tz_name)?></option>
				<?endforeach?>
			</select>
		</td>
	</tr>
<?endif?>


</div>
	<?/*?>
<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('personal')"><?=GetMessage("USER_PERSONAL_INFO")?></a></div>
<div id="user_div_personal" class="profile-block-<?=strpos($arResult["opened"], "personal") === false ? "hidden" : "shown"?>">


		<div class="form-group control-group">
			<label class="name col-12"><?=GetMessage('USER_WWW')?></label>
			<div class="text col-12">
				<input class="form-control" type="text" name="PERSONAL_WWW" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_WWW"]?>" />
			</div>
		</div>

		<div class="form-group control-group">
			<label class="name col-12"><?=GetMessage('USER_GENDER')?></label>
			<div class="text col-12">
				<select class="form-control formstyler" name="PERSONAL_GENDER">
					<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
					<option value="M"<?=$arResult["arUser"]["PERSONAL_GENDER"] == "M" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("USER_MALE")?></option>
					<option value="F"<?=$arResult["arUser"]["PERSONAL_GENDER"] == "F" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
				</select>
			</div>
		</div>


		<div class="form-group control-group">
			<label class="name col-12"><?= GetMessage('USER_MOBILE') ?></label>
			<div class="text col-12">
				<input class="form-control" type="text" name="PERSONAL_MOBILE" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_MOBILE"] ?>"/>
			</div>
		</div>

		<div class="form-group control-group">
			<label class="name col-12"><?= GetMessage('USER_CITY') ?></label>
			<div class="text col-12">
				<input class="form-control" type="text" name="PERSONAL_CITY" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_CITY"] ?>"/>
			</div>
		</div>
		<div class="form-group control-group">
			<label class="name col-12"><?= GetMessage('USER_ZIP') ?></label>
			<div class="text col-12">
				<input class="form-control" type="text" name="PERSONAL_ZIP" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_ZIP"] ?>"/>
			</div>
		</div>
		<div class="form-group control-group">
			<label class="name col-12"><?= GetMessage("USER_STREET") ?></label>
			<div class="text col-12">
				<textarea class="form-control" cols="30" rows="5" name="PERSONAL_STREET"><?= $arResult["arUser"]["PERSONAL_STREET"] ?></textarea>
			</div>
		</div>

		<div class="form-group control-group">
			<label class="name col-12"><?= GetMessage("USER_NOTES") ?></label>
			<div class="text col-12">
				<textarea class="form-control" cols="30" rows="5" name="PERSONAL_NOTES"><?= $arResult["arUser"]["PERSONAL_NOTES"] ?></textarea>
			</div>
		</div>

</div>
	<?//*/?>

	<?
	if ($arResult["INCLUDE_FORUM"] == "Y")
	{
	?>

<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('forum')"><?=GetMessage("forum_INFO")?></a></div>
<div id="user_div_forum" class="profile-block-<?=strpos($arResult["opened"], "forum") === false ? "hidden" : "shown"?>">
<table class="data-table profile-table" 33>
	<thead>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?=GetMessage("forum_SHOW_NAME")?></td>
			<td><input type="checkbox" name="forum_SHOW_NAME" value="Y" <?if ($arResult["arForumUser"]["SHOW_NAME"]=="Y") echo "checked=\"checked\"";?> /></td>
		</tr>
		<tr>
			<td><?=GetMessage('forum_DESCRIPTION')?></td>
			<td><input type="text" name="forum_DESCRIPTION" maxlength="255" value="<?=$arResult["arForumUser"]["DESCRIPTION"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('forum_INTERESTS')?></td>
			<td><textarea cols="30" rows="5" name="forum_INTERESTS"><?=$arResult["arForumUser"]["INTERESTS"]; ?></textarea></td>
		</tr>
		<tr>
			<td><?=GetMessage("forum_SIGNATURE")?></td>
			<td><textarea cols="30" rows="5" name="forum_SIGNATURE"><?=$arResult["arForumUser"]["SIGNATURE"]; ?></textarea></td>
		</tr>
		<tr>
			<td><?=GetMessage("forum_AVATAR")?></td>
			<td><?=$arResult["arForumUser"]["AVATAR_INPUT"]?>
			<?
			if (strlen($arResult["arForumUser"]["AVATAR"])>0)
			{
			?>
				<br /><?=$arResult["arForumUser"]["AVATAR_HTML"]?>
			<?
			}
			?></td>
		</tr>
	</tbody>
</table>
</div>


	<?
	}
	?>
	<?
	if ($arResult["INCLUDE_BLOG"] == "Y")
	{
	?>
<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('blog')"><?=GetMessage("blog_INFO")?></a></div>
<div id="user_div_blog" class="profile-block-<?=strpos($arResult["opened"], "blog") === false ? "hidden" : "shown"?>">
<table class="data-table profile-table" 44>
	<thead>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?=GetMessage('blog_ALIAS')?></td>
			<td><input class="typeinput" type="text" name="blog_ALIAS" maxlength="255" value="<?=$arResult["arBlogUser"]["ALIAS"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('blog_DESCRIPTION')?></td>
			<td><input class="typeinput" type="text" name="blog_DESCRIPTION" maxlength="255" value="<?=$arResult["arBlogUser"]["DESCRIPTION"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('blog_INTERESTS')?></td>
			<td><textarea cols="30" rows="5" class="typearea" name="blog_INTERESTS"><?echo $arResult["arBlogUser"]["INTERESTS"]; ?></textarea></td>
		</tr>
		<tr>
			<td><?=GetMessage("blog_AVATAR")?></td>
			<td><?=$arResult["arBlogUser"]["AVATAR_INPUT"]?>
			<?
			if (strlen($arResult["arBlogUser"]["AVATAR"])>0)
			{
			?>
				<br /><?=$arResult["arBlogUser"]["AVATAR_HTML"]?>
			<?
			}
			?></td>
		</tr>
	</tbody>
</table>
</div>

	<?
	}
	?>
	<?if ($arResult["INCLUDE_LEARNING"] == "Y"):?>
	<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('learning')"><?=GetMessage("learning_INFO")?></a></div>
	<div id="user_div_learning" class="profile-block-<?=strpos($arResult["opened"], "learning") === false ? "hidden" : "shown"?>">
	<table class="data-table profile-table" 55>
		<thead>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?=GetMessage("learning_PUBLIC_PROFILE");?>:</td>
				<td><input type="checkbox" name="student_PUBLIC_PROFILE" value="Y" <?if ($arResult["arStudent"]["PUBLIC_PROFILE"]=="Y") echo "checked=\"checked\"";?> /></td>
			</tr>
			<tr>
				<td><?=GetMessage("learning_RESUME");?>:</td>
				<td><textarea cols="30" rows="5" name="student_RESUME"><?=$arResult["arStudent"]["RESUME"]; ?></textarea></td>
			</tr>

			<tr>
				<td><?=GetMessage("learning_TRANSCRIPT");?>:</td>
				<td><?=$arResult["arStudent"]["TRANSCRIPT"];?>-<?=$arResult["ID"]?></td>
			</tr>
		</tbody>
	</table>
	</div>
	<?endif;?>
	<?/*if($arResult["IS_ADMIN"]):?>

	<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('admin')"><?=GetMessage("USER_ADMIN_NOTES")?></a></div>
	<div id="user_div_admin" class="profile-block-<?=strpos($arResult["opened"], "admin") === false ? "hidden" : "shown"?>">

		<div class="form-group control-group">
			<label class="name col-12"><?=GetMessage("USER_ADMIN_NOTES")?>:</label>
				<div class="text col-12" >
				<textarea class="form-control" cols="30" rows="5" name="ADMIN_NOTES"><?=$arResult["arUser"]["ADMIN_NOTES"]?></textarea>
			</div>
		</div>
	</div>
	<?endif;*/?>
	<?// ********************* User properties ***************************************************?>
	<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('user_properties')"><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></a></div>
	<div id="user_div_user_properties" class="profile-block-<?=strpos($arResult["opened"], "user_properties") === false ? "hidden" : "shown"?>">

		<?$first = true;?>
		<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
			<div class="form-group control-group<?=($FIELD_NAME=="UF_FIZ" || $FIELD_NAME == "UF_NOOPT"?" hide":"")?>">
				<label for="<?=$arUserField["FIELD_NAME"]?>" class="name col-12"><?=$arUserField["EDIT_FORM_LABEL"]?>:
					<?if ($arUserField["MANDATORY"]=="Y"):?>
						<span class="f-star">&nbsp;*</span>
					<?endif;?></label>
					<div class="text col-12">
					<?$APPLICATION->IncludeComponent(
						"bitrix:system.field.edit",
						$arUserField["USER_TYPE"]["USER_TYPE_ID"].'-profile',
						array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));
					?>
				</div>
			</div>
		<?endforeach;?>

	</div>
	<?endif;?>
	<?// ******************** /User properties ***************************************************?>

	<div class="form-group">
		<div class="col-12">
			<input class="btn btn-default btn_submit" type="submit" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("DB_BUTTON") : GetMessage("MAIN_ADD"))?>">
			<?/*?>&nbsp;&nbsp;
			<input class="btn btn-default btn_submit" type="reset" value="<?=GetMessage('MAIN_RESET');?>">
			<div class="form_required">
				<span class="f-star">&nbsp;*</span><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></div>
			<?//*/?>
		</div>
	</div>



</form>
	</div>
	</div>
</div>
<?
if($arResult["SOCSERV_ENABLED"])
{
	$APPLICATION->IncludeComponent("bitrix:socserv.auth.split", ".default", array(
			"SHOW_PROFILES" => "Y",
			"ALLOW_DELETE" => "Y"
		),
		false
	);
}
?>
</div>