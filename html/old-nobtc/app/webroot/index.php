<?php

require_once('./inc/all.inc.php');

$tpl = & new Template(INDEX_TMPL);


$body = & new Template('./tmpl/body.tmpl.php');

$tpl->set('obsah', $body);

echo $tpl->fetch();
