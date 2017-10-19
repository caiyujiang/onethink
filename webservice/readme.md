#### 基于thinkphp实现简单的webservice功能
* 通过webservice可以把服务打包提供给各个项目使用，各个项目不需要重新实现
* 说明1、配置文件中的ips控制ip地址白名单。
* 说明2、配置文件中的models控制要输出那些model模型给外部。
```
使用步骤：

其他项目使用方法：
class demo{
	private function client($model='sms'){
	    $client = new SoapClient(null, array(
	        'location'=> "http://xxx.com/webservice.php?model={$model}",
	        'uri' => "http://test-uri/",
	        'soap_version' => SOAP_1_1,
	    ));
	    return $client;
	}

	public function main(){
		$mobile = "xxxx";
		$content = "xxxxxx";
		$smsModel = $this->client("sms");
		$smsModel->sendSms($mobile,$content);
	}
}
$demo = new demo();
$demo->main();

```