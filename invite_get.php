<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 25.01.2020
 * Time: 22:42


ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
 */

include 'func.php';
require __DIR__ . '/vendor/autoload.php';

$token = $_POST['token']; // Token

//$token = 'EAABsbCS1iHgBABUhD6yE9tgZBSCynF91DvzJgQ0fn3zYrGkWiwTSj9ToEg3Yvgm29Umdoh1t7AWl9qmqqwNUZBII2XzBZAKrAbOZBSFSLKD1TsRurANj38gda9OJYxEZBsr8ilPBfoS8bAzLhpHfr7Y5undONk0vArWTGur8SnpKbWnv8M9J9';


use \Curl\Curl;

$curl = new Curl();



/**
 * Получаем ID БМ
 */

$curl = new Curl();
$curl->get('https://graph.facebook.com/v5.0/me?fields=adaccounts%7Bbusiness%7D&access_token=' . $token . '', array(
    'access_token' => $token,
));
if ($curl->error) {
    echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
} else {

    // Получаем массив со списком ID BM

    $id_bm = $curl->response->adaccounts->data;


    for ($i = 0; $i < count($id_bm); $i++) {
        echo 'ID BM: '.$id_bm[$i]->business->id.'<br>'; // выведет ID BM

        /**
         * Делаем приглашение в БМ
         */

        // Генерируем E-mail для приглашенного админа
        $mail = ucfirst(strtolower(generate_string($permitted_chars, 8))) . '@mail.ru';

        $data = json_encode(array(
            'access_token' => $token,
            'role' => 'ADMIN',
            'email' => $mail,
        ), JSON_UNESCAPED_UNICODE);
        $curl = new Curl();
        $curl->setDefaultJsonDecoder($assoc = true);
        $curl->setHeader('Content-Type', 'application/json');
        $curl->post('https://graph.facebook.com/v5.0/' . $id_bm[$i]->business->id . '/business_users', $data);
        $id_users_bm = $curl->response;

        if (isset($id_users_bm['id'])) {

            /**
             * Получаем Invite_link в БМ🧔
             */

            $curl = new Curl();
            $curl->get('https://graph.facebook.com/v5.0/' . $id_bm[$i]->business->id . '/pending_users?access_token=' . $token, array(
                'access_token' => $token,
            ));
            if ($curl->error) {
                echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
            } else {
                echo 'Ссылка на приглашение: ' . "\n";
                $invite_link = $curl->response->data;

                echo '<a href="' . $invite_link[0]->invite_link . '">' . $invite_link[0]->invite_link . '</a><br><br>'; // Сообщение с ID BM
            }

            // echo "<font color='red'>Приглашение создано: </font>" . $id_users_bm['id'] . '<br>';
        }
        elseif (isset($id_users_bm['error']['message']) && ($id_bm[$i]->business->id) != NULL) { // Проверяем есть ли ошибка
            echo $id_users_bm['error']['message'] . '<br>';
            echo $id_users_bm['error']['error_user_title'] . '<br>';
            echo $id_users_bm['error']['error_user_msg']; // Сообщение с ошибкой

        }
        else{
            //echo 'Что-то пошло не так...';
        }
    }
}
