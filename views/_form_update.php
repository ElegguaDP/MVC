<?php if (!$error) { ?>
    <h1>Update User <?= $user['id']; ?></h1>
    <p>Fields with * are required!</p>
    <form class="form" method="post" action="/adminpanel/User/Update/<?= $user['id']; ?>">
        <label class="float-left" for="login">Login *</label>
        <input class="float-right input-text" type="text" name="login" id="login" required="true" placeholder="Login" value="<?= $user['login']; ?>">
        <div class="clear"></div>
        <label class="float-left" for="email">E-mailL</label>
        <input class="float-right input-text" type="email" name="email" id="email" placeholder="E-mail" value="<?= $user['email']; ?>">
        <div class="clear"></div>
        <label class="float-left" for="pass">Password *</label>
        <input class="float-right input-text" type="password" name="pass" id="pass" placeholder="Password" required="true" value="">
        <div class="clear"></div>
        <label class="float-left" for="atext">Favorite joke *</label>
        <textarea class="float-right input-textarea" rows="8" name="text" id="atext"><?= $user['text']; ?></textarea>
        <div class="clear"></div>
        <input type="submit" name="submit" value="Save" />
    </form>
<?php } else { ?>
    <div class="error"><?= $error ?></div>
<?php } ?>
