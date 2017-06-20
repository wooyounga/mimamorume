<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FCMController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function index()
    {
        $sql = "Select Token From fcm";

        $result = \DB::select($sql);
        $tokens = array();

        if(sizeof($result) > 0 ){
           foreach ($result as $Rresult) {
               $tokens[] = $Rresult->Token;
           }
        }

        if(isset($_GET['message'])){
          $myMessage = $_GET['message'];
        }
        else{
          $myMessage = "새글이 등록되었습니다.";
        }

        $message = array("message" => $myMessage);

        $result = $this->send_notification($tokens, $message);

        echo $result;
    }

    public function store(Request $request)
    {
	$token = $request->input("Token");

	\DB::statement('insert into fcm (Token) values (?) on duplicate key update Token = ?', array($token, $token));
    }

    public function send_notification($tokens, $message){
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
                   'registration_ids' => $tokens,
                   'data' => $message
               );

        $headers = array(
               'Authorization:key =' . 'AAAASItoN3U:APA91bHMm6DZr9jf1zSrjCdfSESLMst14qdWpp_WWydjtSiXYtzNE02X7N28il2fkXS6QJxY7zdhhTO4GuuNNAQEYhZMJqhKDNoH9XCESwetxCYYQbAdewrmMw0PimwXUC_j_Ji6GKxH',
               'Content-Type: application/json'
               );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);

        return $result;
    }
}
