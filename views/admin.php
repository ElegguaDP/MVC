<? if (!$error) { ?>
<a href="Create">Add user</a>
    <table>
        <caption>User's List</caption>
        <tr>
    	<th>Id</th>
    	<th>Login</th>
    	<th>Email</th>
    	<th>Joke</th>
        </tr>

	<?php
	foreach ($users as $user) {
	    if ($user) {
		?>
	        <tr>
	    	<td><?= $user['id'] ?></td>
	    	<td><?= $user['login'] ?></td>
	    	<td><?= $user['email'] ? $user['email'] : '-' ?></td>
	    	<td><?= nl2br($user['text']); ?></td>
	    	<td><a href="Update/<?= $user['id']; ?>">Update</a></td>
		    <?php if ($user['id'] != 1) { ?>
			<td><a href="Delete/<?= $user['id']; ?>">Delete</a></td>
		    <?php } else { ?>
			<td>User with ID 1 is admin</td>
		    <?php } ?>
	        </tr>	
		<?php
	    }
	}
	?>

    </table>
<? } else { ?>
    <div class="error"><?= $error; ?></div>
<? } ?>
