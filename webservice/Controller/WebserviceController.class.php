<?php
namespace Index\Controller;
use Think\Controller;
/**
 * 基于thinkphp的webservice服务入口
 * @author pro-jango
 */
class WebserviceController extends Controller {

    private $modelName;

    public function index(){
        
        $this->checkIp();
        $this->checkParam();
        $this->checkModel();
        try {
            $model = D($this->modelName);
            $server = new \SoapServer(null, array('uri' => 'http://test-uri', 'encoding'=>'utf8'));
            $server->setObject($model);
            $server->handle();
        } catch (Exception $e) {
            header("HTTP/1.0 500 service error");
            //记录错误日志：
            //$e->getMessage();
        }
    }

    /**
     * 检测参数
     */
    private function checkParam(){
        $this->modelName = isset($_GET['model']) ? trim($_GET['model']) : '';
        if($this->modelName == ''){
            header("HTTP/1.0 400 Model Param Empty!");
            exit;
        }else{
            $this->modelName = strtolower($this->modelName);
        }
    }

    /**
     * ip访问限制检测
     */
    private function checkIp(){
        $ip = getiip();
        $arrLimit = C('WEBSERVICE_LIMIT');//see Conf/config.php
        $arrIpLimit = $arrLimit['ips'];
        if(!in_array($ip, $arrIpLimit)){
            header("HTTP/1.0 401 ip denied !");
            exit;
        }
    }

    /**
     * 检测授权的model
     */
    private function checkModel(){
        $arrLimit = C('WEBSERVICE_LIMIT');//see Conf/config.php
        $arrModelLimit = $arrLimit['models'];
        if(!in_array($this->modelName, $arrModelLimit)){
            header("HTTP/1.0 401 model denied !");
            exit;
        }
    }
}
