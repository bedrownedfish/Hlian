<?php
class Ethereum{

    private $host = '172.31.186.212';                                   //IP地址

    private $port = '8899';                                             //端口

    private $version = '2.0';                                           //版本

    private $debug = false;                                             //开发者模式

    private $coinbase = '0x95140bf555c71912bb6c756369d839e5be6dabce';   //主钱包

    private $coinbasePwd = 'liumai123456654321';                                //主钱包密码

    public $shouxu = 0;                                                 //转入手续费倍数，如 1%，则值为 0.01

    public $transferGas = '0.0005';

    private $rpcId = 0;

    private $ContractAddress = "0xd1779aa0b4fec2aa37503344Fadb7e6E8ABE1C5B";


    public function __construct(){
        
    }


    private function checkRpcResult($data){

        $result = null;

        if (empty($data['error']) && !empty($data['result'])) {

            $result = $data['result'];
        } else {

            if ($this->debug) {
                
                $result = $data;
            }else{

                $result = $data;
            }
        }

        return $result;
    }


    private function request($method, $params = array()){

        $data = array();
        $data['jsonrpc'] = $this->version;
        $data['id'] = 999999;
        // $data['id'] = $this->rpcId + 1;
        $data['method'] = $method;
        $data['params'] = $params;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->host);
        curl_setopt($ch, CURLOPT_PORT, $this->port);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $ret = curl_exec($ch);
        curl_close($ch);
        //返回结果
        if ($ret) {

            // dump(json_decode($ret, true));exit();
          	//return $ret;
            return $this->checkRpcResult(json_decode($ret, true));
        } else {

            return false;
        }
    }


    private function eth_gasPrice(){

        return $this->request(__FUNCTION__);
    }


    private function eth_getBalance($address){

        return $this->request(__FUNCTION__, array($address, 'latest'));
    }
  
  
  	private function eth_getTransactionByHash($txHash){

        return $this->request(__FUNCTION__, array($txHash));
    }


    private function eth_sendTransaction($from, $to, $gas, $gasPrice, $value, $data){

        $transVue = array();

        $transVue['from']      = $from;
        $transVue['to']        = $to;
        $transVue['gas']       = $gas;
        $transVue['gasPrice']  = $gasPrice;
        $transVue['value']     = $value;
        $transVue['data']      = $data;

        return $this->request(__FUNCTION__, array( $transVue ));
    }


    private function eth_call($from, $to, $gas, $gasPrice, $value, $data){

        $callVue = array();

        $callVue['from']      = $from;
        $callVue['to']        = $to;
        $callVue['gas']       = $gas;
        $callVue['gasPrice']  = $gasPrice;
        $callVue['value']     = $value;
        $callVue['data']      = $data;

        return $this->request(__FUNCTION__, array( $callVue, 'latest' ));
    }


    private function eth_estimateGas($from, $to, $gas, $gasPrice, $value, $data){

        $callVue = array();

        $callVue['from']      = $from;
        $callVue['to']        = $to;
        $callVue['gas']       = $gas;
        $callVue['gasPrice']  = $gasPrice;
        $callVue['value']     = $value;
        $callVue['data']      = $data;

        return $this->request(__FUNCTION__, array( $callVue ));
    }


    private function personal_unlockAccount($account, $password, $duration = 20){

        $params = array(

            $account,
            $password,
            $duration
        );

        return $this->request(__FUNCTION__, $params);
    }


    private function personal_newAccount($password){

        $result = false;

        if (is_string($password) && strlen($password) > 0) {

            return $this->request(__FUNCTION__, array($password));
        }
    }


    private function createPassword(){

        $str = md5(rand(0,999) . rand(0,999) . time() . rand(0,999) . rand(0,999));

        $strArr = str_split($str);
        for($i=0;$i<(count($strArr)-1)/2;$i++){

            $temp = $strArr[$i];
            $strArr[$i] = $str[count($strArr)-1-$i];
            $strArr[count($strArr)-1-$i] = $temp;
        }

        $str = '';
        foreach ($strArr as $v){
            $str = $str.$v;
        }

        return $str;
    }
  
  
  	public function checkTransactioning($txHash){

        $result = false;

        $transaction = $this->eth_getTransactionByHash($txHash);

        if ($transaction && isset($transaction['blockNumber'])) {
            
            $result = $transaction['blockNumber'] ? true : false;
        }

        return $result;
    }


    public function checkAmount($amount){

        return is_numeric($amount);
    }


    public function checkAddress($address){

        $result = false;

        if (ctype_alnum($address)) {
            
            if (strlen($address) == 42 && substr($address, 0, 2) == '0x') {
                
                $result = true;
            }
        }

        return $result;
    }
    //新建账号
    public function createWallet(){

        $result = false;

        $wallet = null;

        $wallet['password'] = $this->createPassword();

        $wallet['address'] = $this->personal_newAccount($wallet['password']);

        if ($wallet['address'] && is_string($wallet['address'])) {
            
            if (strlen($wallet['address']) == 42) {
                
                $result = $wallet;
              
            }

        }

        return $result;
    }


    public function balanceOfSGVtoCoinBase(){

        return $this->balanceOfSGV($this->coinbase);
    }

 
    public function balanceOfCoinBase(){

        return $this->balanceOf($this->coinbase);
    }


    public function balanceOfSGV($address,$contractAddress = ""){

        $result = 0;

        if ($this->checkAddress($address)) {

            $data = null;
                
            $dataCode = '0x70a08231000000000000000000000000' . substr($address, 2, 40);

            $data = $this->eth_call($address, !$contractAddress?$this->contractAddress : $contractAddress , '0x0', '0x0', '0x0', $dataCode);

            if ($data && !is_array($data)) {

                $result = bcdiv(number_format(hexdec($data),0,'.',''), number_format(1000000000000000000,0,'.',''), 2);

            }
        }

        return $result;
    }


    public function balanceOf($address){

        $result = 0;

        if ($this->checkAddress($address)) {

            $data = $this->eth_getBalance($address);

            if ($data && !is_array($data)) {

                $result = bcdiv(number_format(hexdec($data),0,'.',''), number_format(1000000000000000000,0,'.',''), 18);
            }
        }

        return $result;
    }


    public function transferSGV($toAddress, $value, $contractAddress = ""){

        $result = false;

        if ($this->checkAddress($toAddress) && is_numeric($value)) {
			
            $ethBalance = $this->balanceOf($this->coinbase);
          	
            $gasPriceHex = $this->eth_gasPrice();
			
            $tokenEnough = false;

            $data = array();

            $tokenBalance = $this->balanceOfSGV($this->coinbase);
          
            $tokenEnough = bcsub($tokenBalance, $value, 2) >= 0;
			
            if ($tokenEnough) {
                
                $data['to'] = !$contractAddress ? $this->contractAddress : $contractAddress;
                $data['value'] = '0x0';
                $data['data'] = '0xa9059cbb000000000000000000000000' . substr($toAddress, 2, 40);

                $valueHex = base_convert(bcmul($value, number_format(100, 0, '.', ''), 0), 10, 16);
				
                $zeroStr = '';
                for($i = 1; $i <= (64 - strlen($valueHex)); $i ++){

                    $zeroStr .= '0';
                  
                }

                $data['data'] = $data['data'] . $zeroStr . $valueHex;
                 
                $gasLimitHex = $this->eth_estimateGas($this->coinbase, $data['to'], '0x0', '0x0', $data['value'], $data['data']);
				
                if (bcsub($ethBalance,bcdiv(bcmul(hexdec($gasPriceHex), hexdec($gasLimitHex)), number_format(1000000000000000000, 0, '.', ''), 18),18) >= 0) {
                    
                    $unlockStatus = $this->personal_unlockAccount($this->coinbase, $this->coinbasePwd);
					
                    if ($unlockStatus) {
                        
                        $result = $this->eth_sendTransaction($this->coinbase, $data['to'], $gasLimitHex, $gasPriceHex, $data['value'], $data['data']);
                     	//echo json_encode($gasPriceHex);exit;
                    }
                }
            }
        }

        return $result;
    }


    public function transferSGVtoCoinbase($fromAddress, $value, $password){

        

        $result = false;

        if ($this->checkAddress($fromAddress) && is_numeric($value)) {

            $ethBalance = $this->balanceOf($fromAddress);
            $gasPriceHex = $this->eth_gasPrice();

            $tokenEnough = false;

            $data = array();

            $tokenBalance = $this->balanceOfSGV($fromAddress);
            $tokenEnough = bcsub($tokenBalance, $value, 2) >= 0;

            if ($tokenEnough) {
                
                $data['to'] = '0xd1779aa0b4fec2aa37503344Fadb7e6E8ABE1C5B';
                $data['value'] = '0x0';
                $data['data'] = '0xa9059cbb000000000000000000000000' . substr($this->coinbase, 2, 40);

                $valueHex = base_convert(bcmul($value, number_format(100, 0, '.', ''), 0), 10, 16);

                $zeroStr = '';
                for($i = 1; $i <= (64 - strlen($valueHex)); $i ++){

                    $zeroStr .= '0';
                }

                $data['data'] = $data['data'] . $zeroStr . $valueHex;
                
                $gasLimitHex = $this->eth_estimateGas($fromAddress, $data['to'], '0x0', $gasPriceHex, $data['value'], $data['data']);

                if (bcsub($ethBalance,bcdiv(bcmul(hexdec($gasPriceHex), hexdec($gasLimitHex)), number_format(1000000000000000000, 0, '.', ''), 18),18) >= 0) {
                    
                    $unlockStatus = $this->personal_unlockAccount($fromAddress, $password);

                    if ($unlockStatus) {
                        
                        $result = $this->eth_sendTransaction($fromAddress, $data['to'], $gasLimitHex, $gasPriceHex, $data['value'], $data['data']);
                    }
                }
            }
        }

        return $result;
    }


    public function transferGas($toAddress){

        $result = false;

        if ($this->checkAddress($toAddress)) {

            $ethBalance = $this->balanceOf($this->coinbase);
            $gasPriceHex = $this->eth_gasPrice();

            $tokenEnough = false;

            $data = array();

            $ethBalance = bcsub($ethBalance, $this->transferGas, 18);
            $tokenEnough = $ethBalance >= 0;

            if ($tokenEnough) {
                
                $data['to'] = $toAddress;
                $data['value'] = '0x' . base_convert(bcmul($this->transferGas, number_format(1000000000000000000, 0, '.', ''), 0), 10, 16);
                $data['data'] = '0x';
                
                $gasLimitHex = $this->eth_estimateGas($this->coinbase, $data['to'], '0x0', $gasPriceHex, $data['value'], $data['data']);

                if (bcsub($ethBalance,bcdiv(bcmul(hexdec($gasPriceHex), hexdec($gasLimitHex)), number_format(1000000000000000000, 0, '.', ''), 18),18) >= 0) {
                    
                    $unlockStatus = $this->personal_unlockAccount($this->coinbase, $this->coinbasePwd);

                    if ($unlockStatus) {
                        
                        $result = $this->eth_sendTransaction($this->coinbase, $data['to'], $gasLimitHex, $gasPriceHex, $data['value'], $data['data']);
                    }
                }
            }
        }

        return $result;
    }


    public function transferFromCoinbase($toAddress, $amount){

        $result = false;

        if ($this->checkAddress($toAddress) && is_numeric($amount)) {

            $ethBalance = $this->balanceOf($this->coinbase);
            $gasPriceHex = $this->eth_gasPrice();

            $tokenEnough = false;

            $data = array();

            $ethBalance = bcsub($ethBalance, $amount, 18);
            $tokenEnough = $ethBalance >= 0;

            if ($tokenEnough) {
                
                $data['to'] = $toAddress;
                $data['value'] = '0x' . base_convert(bcmul($amount, number_format(1000000000000000000, 0, '.', ''), 0), 10, 16);
                $data['data'] = '0x';
                
                $gasLimitHex = $this->eth_estimateGas($this->coinbase, $data['to'], '0x0', $gasPriceHex, $data['value'], $data['data']);

                if (bcsub($ethBalance,bcdiv(bcmul(hexdec($gasPriceHex), hexdec($gasLimitHex)), number_format(1000000000000000000, 0, '.', ''), 18),18) >= 0) {
                    
                    $unlockStatus = $this->personal_unlockAccount($this->coinbase, $this->coinbasePwd);

                    if ($unlockStatus) {
                        
                        $result = $this->eth_sendTransaction($this->coinbase, $data['to'], $gasLimitHex, $gasPriceHex, $data['value'], $data['data']);
                    }
                }
            }
        }

        return $result;
    }
}
