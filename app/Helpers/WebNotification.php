<?php
namespace App\Helpers;
use DB;

class WebNotification {

   private static  $server_key  = 'AAAAnTbleOY:APA91bFzSYGGDMULse6niXBgOnOfqfOfw4m65YIvzYNU138Sx8iFG_mJIXtJ19Vhjl3IPPkCxEnsh48cvCElDAsf5vuNCgQ-QWIsmumW4EQ5jZ7tnCmTV60zECC2fnn3RuKqqDbUbfT6';
  
   private  static $returnTransfer = false; // false return , true no return
   
   public static function execute($device_token = array() ,$data = array()){
   
   if(isset($data['receiver_ids'])){
      unset($data['receiver_ids']);
   }

       $registration_ids =  ['dreUmW8dQ46BiUb4_Eiqbm:APA91bGPP5FFkQS0AoQqCZTOgQTXxf9EGY9sawOI4Wsm1Zo5vKNJ3lAufcdxb_Oy1LjrYtCal3JtHphvt1tYruouEPhEU8RyU6qg5LzpmSyRNyYQ0u4JUZBnkdsJ3GV5IjVUa4HTJhk6'];

            // prep the bundle
        $msg = array
        (
            'title'     => 'New Product',
            'body'      => 'This is body',
             'vibrate'   => 1,
             'sound'     => 1,
             'icon' => 'http://codemeg.com/images/fevicon/android-icon-192x192.png',
             'click_action' => 'http://shareurcodes.com'
        );

        $fields = array
        (
            'registration_ids'  => $registration_ids,
            'priority'          => 'high',
            'notification'      => $msg
        );
         
         $headers = array(
            'Authorization: key=' . self::$server_key,
            'Content-Type: application/json'
        );
        
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, self::$returnTransfer );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        echo '<pre>';
        die;
    }

    public static function send( $tokens , $notifyData ){
        
         if($tokens)
         self::execute($tokens,$notifyData);
        /*
         $insertData['title']             = $notifyData['title'];
         $insertData['message']           = $notifyData['body'];
         $insertData['sender_id']         = $notifyData['sender_id'];
         $insertData['notification_type'] = $notifyData['notification_type'] ?? null;
         $insertData['meta_data']         = $notifyData['meta_data'] ?? null;
         $notificationId = DB::table('notifications')->insertGetId($insertData);
         $inserReceiverData = array();
         foreach($notifyData['receiver_ids'] as $key => $value){
            array_push($inserReceiverData, ['notification_id'=>$notificationId,'receiver_id'=>$value]);
         }
         DB::table('notification_receivers')->insert($inserReceiverData);
         */
    }
    
}

?>