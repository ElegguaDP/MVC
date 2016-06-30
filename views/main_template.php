<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="utf-8">
	<link href="/adminpanel/assets/all.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
	<ul>
	    <li><a href="/adminpanel">Main</a></li>
	    <?php if (isset($_SESSION['is_auth']) && $_SESSION['is_auth']) { ?>
		<?php if ($_SESSION['is_auth'] == 1) { ?>
		    <li><a href="/adminpanel/User/List">User's list</a></li>
		<?php } ?>
    	    <li><a href="/adminpanel/User/Logout">Logout</a></li>
	    <?php } ?>
	</ul>

	<?php include 'views/' . $view; ?>
    </body>
</html>