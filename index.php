<?php

require_once 'init.php';

if(Session::exists('home')) {
	echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();
if($user->isLoggedIn()) {
	?>
	<p>Hello <a href ="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</p>

	<ul>
		<li><a href="logout.php">Log out</a></li>
		<li><a href="update.php">Update Profile</a></li>
		<li><a href="changepwd.php">Change Password</a></li>
	</ul>
	<?php
} else {
	include 'index.html';
}