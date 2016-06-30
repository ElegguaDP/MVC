<h1>Login page</h1>
<p>Fields with * are required!</p>
<form class="form" method="post" action="/adminpanel/User/Index">
    <?if($mainError){?>
	<div class="error"><?= $mainError; ?></div>
        <div class="clear"></div>
    <?}?>
    <label class="float-left" for="login">Your login *</label>
    <input class="float-right input-text" type="text" name="login" id="login" required="true" placeholder="Login">
    <div class="clear"></div>
    <? if ($errorLogin) { ?>
        <div class="error"><?= $errorLogin; ?></div>
        <div class="clear"></div>
    <? } ?>

    <label class="float-left" for="pass">Your password *</label>
    <input class="float-right input-text" type="password" name="pass" id="pass" placeholder="Password" required="true">
    <div class="clear"></div>
    <? if ($errorPass) { ?>
        <div class="error"><?= $errorPass; ?></div>
        <div class="clear"></div>
    <? } ?>

    <input type="submit" name="submit" value="Login" />
</form>