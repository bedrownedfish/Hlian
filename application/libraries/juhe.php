<?php
class juhe{

    
	  private $idhHost = 'http://op.juhe.cn/idcard/query';

	  private $idAppKey = '347d862339800c37bdb556d1b0d33809';

    private $bachHost = 'http://v.juhe.cn/verifybankcard3/query';

    private $bacAppKey = 'e07eec6f9aac37257c335647b541e8d0';

    private $noteHost ="http://v.juhe.cn/sms/send";

    private $noteAppKey = '4df8a1c6fdba00d511a08d58aac8b3d8';

    //短信
    public function noteTrue($mobile,$code){
      $code = '#code#='.$code;
      $smsConf = array(
        'key'       => $this->noteAppKey,
        'mobile'    => $mobile,
        'tpl_id'    => '98366',
        'tpl_value' => $code,
      );

      $content = $this->juhecurl($this->noteHost,$smsConf,1); 

      if($content){

          $result = json_decode($content,true);

          $error_code = $result['error_code'];

          if($error_code == 0){
              
              return 1;

          }else{

              $msg = $result['reason'];

              return "短信发送失败(".$error_code.")：".$msg;

          }
      }else{

          return "请求发送短信失败";

      }

    }
  	//身份证验证
  	public function idcardTrue($idcard,$realname){

      $params['idcard'] = $idcard;

      $params['realname'] = $realname;

      $params['key'] = $this->idAppKey;

      $paramstring = http_build_query($params);

  		$result = json_decode($this->juhecurl($this->idhHost,$paramstring),true);

      if($result){

          if($result['error_code']=='0'){

              if($result['result']['res'] == '1'){

                  return 1;

              }else{

                  return "身份证号码和真实姓名不一致";

              }
              #print_r($result);
          }else{

              return $result;

          }

      }else{

          return "请求失败";

      }

    }
  	//银行卡
  	public function verifyBankcard($idcard,$realname,$bankcard){

      $params['idcard'] = $idcard;

      $params['realname'] = $realname;

      $params['key'] = $this->bacAppKey;

      $params['bankcard'] = $bankcard;

    	$paramstring = http_build_query($params);

		  $result = json_decode($this->juhecurl($this->bachHost,$paramstring),true);
        if($result){
            if($result['error_code']=='0'){
                if($result['result']['res'] == '1'){
                    return 1;
                }else{
                    return "银行卡号不对";
                }
                #print_r($result);
            }else{
                return $result;
            }
        }else{
            return "请求失败";
        }
    }
  	/**
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    private function juhecurl($url,$params=false,$ispost=0){

        $httpInfo = array();

        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );

        curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );

        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );

        curl_setopt( $ch, CURLOPT_TIMEOUT , 60);

        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );

            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );

            curl_setopt( $ch , CURLOPT_URL , $url );

        }
        else
        {
            if($params){

                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );

            }else{

                curl_setopt( $ch , CURLOPT_URL , $url);

            }
        }
        $response = curl_exec( $ch );

        if ($response === FALSE) {

            //echo "cURL Error: " . curl_error($ch);
            return false;

        }

        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );

        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );

        curl_close( $ch );

        return $response;

    }
}
?>