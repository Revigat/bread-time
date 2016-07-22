<div class="content form_create">
    <article>
        <header>
            <h1>Criar Post:</h1>
        </header>
        <?php
        //require('classPush.php');
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($post) && $post['SendPostForm']):
            $post['post_status'] = ($post['SendPostForm'] == 'Cadastrar' ? '0' : '1');
            $post['post_cover'] = ($_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : null);
            unset($post['SendPostForm']);
            require('_models/AdminPost.class.php');
            $cadastra = new AdminPost;
            $cadastra->ExeCreate($post);

            echo $post['post_category'];

            //Emitir Push
            class GCMPushMessage {
                var $url = 'https://android.googleapis.com/gcm/send';
                var $serverApiKey = "";
                var $devices = array();

                function GCMPushMessage($apiKeyIn){
                    $this->serverApiKey = $apiKeyIn;
                }
                function setDevices($deviceIds){

                    if(is_array($deviceIds)){
                        $this->devices = $deviceIds;
                    } else {
                        $this->devices = array($deviceIds);
                    }

                }
                function send($message, $data = false){

                    if(!is_array($this->devices) || count($this->devices) == 0){
                        $this->error("No devices set");
                    }

                    if(strlen($this->serverApiKey) < 8){
                        $this->error("Server API Key not set");
                    }

                    $fields = array(
                        'registration_ids'  => $this->devices,
                        'data'              => array( "message" => $message ),
                    );

                    if(is_array($data)){
                        foreach ($data as $key => $value) {
                            $fields['data'][$key] = $value;
                        }
                    }
                    $headers = array(
                        'Authorization: key=' . $this->serverApiKey,
                        'Content-Type: application/json'
                    );
                    $ch = curl_init();

                    curl_setopt( $ch, CURLOPT_URL, $this->url );

                    curl_setopt( $ch, CURLOPT_POST, true );
                    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

                    curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

                    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false);
                    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);

                    $result = curl_exec($ch);

                    curl_close($ch);

                    return $result;
                }

                function error($msg){
                    echo "Android send notification failed with error:";
                    echo "\t" . $msg;
                    exit(1);
                }
            }


                $apiKey = "AIzaSyCThWt3lNmBxIpL34qRKHxd_1I4fkXD2O0"; // CHAVE DA API GCM...

                //Metodo Burro --- Jogando todos os tokens do bd
                $read = new Read;
                $read->ExeRead('app_tokens', "", "");

                $tokensEnvio = '';
                $virg = "";

                foreach ($read->getResult() as $tokens) {
                    $tokensEnvio .= $virg . $tokens['token'];
                    $virg = ",";
                }
                $gcpm = new GCMPushMessage($apiKey);
                $gcpm->setDevices(explode(",", $tokensEnvio));

                $title = $post['post_title']; // Título do Push...
                $message = substr($post["post_content"], 0, 50); // Conteúdo da mensagem do PUSH...



            if ($cadastra->getResult()):

                if (!empty($_FILES['gallery_covers']['tmp_name'])):
                    $sendGallery = new AdminPost;
                    $sendGallery->gbSend($_FILES['gallery_covers'], $cadastra->getResult());
                endif;
                if ($post['post_category'] > 0) {
                  $response = $gcpm->send($message, array('title' => $title)); // envio do Push...
                }
                header('Location: painel.php?exe=posts/update&create=true&postid=' . $cadastra->getResult());
            else:
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            endif;
        endif;

        ?>


        <form name="PostForm" action="" method="post" enctype="multipart/form-data">

            <label class="label">
                <span class="field">Enviar Capa:</span>
                <input type="file" name="post_cover"/>
            </label>

            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="post_title"
                       value="<?php if (isset($post['post_title'])) echo $post['post_title']; ?>"/>
            </label>

            <label class="label">
                <span class="field">Conteúdo:</span>
                <textarea class="js_editor" name="post_content"
                          rows="10"><?php if (isset($post['post_content'])) echo htmlspecialchars($post['post_content']); ?></textarea>
            </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Data:</span>
                    <input type="text" class="formDate center" name="post_date" value="<?php
                    if (isset($post['post_date'])): echo $post['post_date'];
                    else: echo date('d/m/Y H:i:s');
                    endif;
                    ?>"/>
                </label>

                <label class="label_small">
                    <span class="field">Categoria:</span>
                    <select name="post_category">
                        <option value=""> Selecione a categoria:</option>
                        <?php
                        $readSes = new Read;
                        $readSes->ExeRead("ws_categories", "WHERE category_parent IS NULL ORDER BY category_title ASC");
                        if ($readSes->getRowCount() >= 1):
                            foreach ($readSes->getResult() as $ses):
                                echo "<option disabled=\"disabled\" value=\"\"> {$ses['category_title']} </option>";
                                $readCat = new Read;
                                $readCat->ExeRead("ws_categories", "WHERE category_parent = :parent ORDER BY category_title ASC", "parent={$ses['category_id']}");

                                if ($readCat->getRowCount() >= 1):
                                    foreach ($readCat->getResult() as $cat):
                                        echo "<option ";

                                        if ($post['post_category'] == $cat['category_id']):
                                            echo "selected=\"selected\" ";
                                        endif;

                                        echo "value=\"{$cat['category_id']}\"> &raquo;&raquo; {$cat['category_title']} </option>";
                                    endforeach;
                                endif;

                            endforeach;
                        endif;
                        ?>
                    </select>
                </label>

                <label class="label_small">
                    <span class="field">Autor:</span>
                    <select name="post_author">
                        <option
                            value="<?= $_SESSION['userlogin']['user_id']; ?>"> <?= "{$_SESSION['userlogin']['user_name']} {$_SESSION['userlogin']['user_lastname']}"; ?> </option>
                        <?php
                        $readAut = new Read;
                        $readAut->ExeRead("ws_users", "WHERE user_id != :id AND user_level >= :level ORDER BY user_name ASC", "id={$_SESSION['userlogin']['user_id']}&level=2");

                        if ($readAut->getRowCount() >= 1):
                            foreach ($readAut->getResult() as $aut):
                                echo "<option ";

                                if ($post['post_author'] == $aut['user_id']):
                                    echo "selected=\"selected\" ";
                                endif;

                                echo "value=\"{$aut['user_id']}\"> {$aut['user_name']} {$aut['user_lastname']} </option>";
                            endforeach;
                        endif;
                        ?>
                    </select>
                </label>

            </div><!--/line-->

            <div class="label gbform">
                <label class="label">
                    <span class="field">Enviar Galeria:</span>
                    <input type="file" multiple name="gallery_covers[]"/>
                </label>
            </div>

            <!--<input type="submit" class="btn blue" value="Cadastrar" name="SendPostForm"/>-->
            <input type="submit" class="btn green" value="Cadastrar & Publicar" name="SendPostForm"/>

        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->
