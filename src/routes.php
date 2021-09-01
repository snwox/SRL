<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");
get('/', 'index.php');
get('/$token', 'php/redirector.php');
post('/action.php','php/action.php');
any('/404','404.php');
?>