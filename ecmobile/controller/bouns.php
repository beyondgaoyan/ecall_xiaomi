<?php

/*
 *                                                                          
 * 获取用户红包 by gaoyan
 */

define('INIT_NO_USERS', true);
require(EC_PATH . '/includes/init.php');
GZ_Api::authSession();
include_once(EC_PATH . '/includes/lib_transaction.php');
$user_id = $_SESSION['user_id'];
$bonus = get_user_bouns_list($user_id, 1000);
GZ_Api::outPut($bonus);