<?php
require('_app/Config.inc.php');
$read = new Read;
$read->ExeRead('app_tokens', "", "");
print_r($read->getResult());

if (isset($_POST['token'])) {
    $fields = array('token' => $_POST['token']);

    $tokenSalvo = false;
    foreach ($read->getResult() as $tokens) {
        if ($tokens['token'] == $_POST['token']) {
            $tokenSalvo = true;
        }
    }
    if ($tokenSalvo == false) {
        $cadastra = new Create;
        $cadastra->ExeCreate('app_tokens', $fields);
        $cadastra->getResult();
        unset($_POST['token']);
    }

}