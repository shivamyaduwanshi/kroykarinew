<?php
namespace App\Helpers;
use DB;

class NotificationHelper {

    static $SERVER_API_KEY = 'AAAAanq_eco:APA91bFM_fpGqfPsgKiPzS8D8OwrITP3qZBRpXGSImwTQROzNpBpuvhbfbu8FMfPgO_WjOb1paOTYyLKbjpUrna57JQJR2TF3DpCpRMBwm7yjU0mS2t1uFPayIpLZv2AECQtAiyQXPrz';
    
    public static function send($notifyData){
        if($notifyData){
            foreach($notifyData as $key => $value){
                    if($value['is_notify'] != '0'){

                    $deviceToken = $value['device_token'];
                    $temp =[
                    'title' => $value['title'],
                    'body'  => $value['body'],
                    'icon'  => $value['icon'] ?? asset('public/assets/backend/images/logo-icon.png'),
                    'key'   => $value['type'] ?? '',
                    'id'    => $value['id']   ?? '',
                    'meta_data' => $value['meta_data'] ?? array(),
                    'timestamp' => date('Y-m-d h:i A')
                    ];

                    if(!empty($value['device_token']) && !is_null($value['device_token'])){

                        if($value['device_type'] != '1' && $value['device_type'] != '2' && $value['device_type'] != 'android' && $value['device_type'] != 'ios'){
                            $temp['click_action'] = url('chat');
                            self::web($deviceToken,$temp);
                        }
    
                        if($value['device_type'] == '1' || $value['device_type'] == 'android'){
                            self::android($deviceToken,$temp);
                        }
    
                        if($value['device_type'] == '2' || $value['device_type'] == 'ios'){
                            self::ios($deviceToken,$temp);
                        }
                        
                    }
                }
            }
        }
    }

    public static function web($deviceToken,$data){
        $registration_ids =  $deviceToken;
         $data             = $data;
    
        $fields = [
            "to"           => $registration_ids,
            "notification" => $data
        ];

        $dataString = json_encode($fields);
    
        $headers = [
            'Authorization: key=' . self::$SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);

    }

    public static function android($deviceToken,$data){

      
       $registration_ids =  $deviceToken;
       $data             = $data;
       
       $message = array(
         "message" => $data
       );
  
       $url = 'https://fcm.googleapis.com/fcm/send';
    
       $fields = array(
        'to' => $registration_ids,
        'data' => $message
        );
    
        $headers = array(
            'Authorization: key=' . self::$SERVER_API_KEY,
            'Content-Type: application/json'
	    );
	
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    	$result = curl_exec($ch);
	
        if ($result === FALSE){
           die('Curl failed: ' . curl_error($ch));
         }
        curl_close($ch);

    }

    public static function ios($deviceToken,$data){
                
            $token = $deviceToken;

            $alert = $data['title'];
            $passphrase='';
            $Certificate= config_path('pushcert.pem');

            $ctx = stream_context_create();
            stream_context_set_option($ctx, 'ssl', 'local_cert', $Certificate);
            stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

            $fp =stream_socket_client(
            'ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);


            if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);

            $body['aps']=[
            'alert' => $alert,
            'data'  => $data,
            'sound' => 'default',
            'badge' => 1,
            ];

            $payload = json_encode($body);
            $msg=chr(0).pack('n', 32).pack('H*', trim($token)) . pack('n', strlen($payload)).$payload;
            $result=fwrite($fp, $msg, strlen($msg));
            fclose($fp);
    }

    public static function store($notifyData){
       
        $insertData = array();
        if($notifyData){
            foreach($notifyData as $key => $value){

               $metaData =  $value['meta_data'] ?? array();
                 array_push($insertData,[
                    'title'         =>  $value['title'],
                    'body'          =>  $value['body'],
                    'sender_id'     =>  $value['sender_id'],
                    'receiver_id'   =>  $value['receiver_id'],
                    'meta_data'     =>  $metaData ? serialize($metaData) : serialize(array())
                 ]);
            }
            DB::table('notifications')->insert($insertData);
        }


    }

}

?>