<?php
require('./php/tools.php');

$a = new userModel();
print_r(count($a->getContents('1')));
?>