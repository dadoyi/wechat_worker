<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;

/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{
    const INIT = 'init';
    // const BEGIN = 'begin';
    const PUSH = 'push';
    const SEND = 'send';

    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     * 
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {
        // 向当前client_id发送数据
        // Gateway::bindUid($client_id,1);
        // Gateway::isUidOnline(1);
        // Gateway::sendToClient($client_id, "Hello $client_id\r\n");
        // 向所有人发送
        // Gateway::sendToAll("$client_id login\r\n");
    }
    
   /**
    * 当客户端发来消息时触发
    * @param int $client_id 连接id
    * @param mixed $message 具体消息
    */
   public static function onMessage($client_id, $message)
   {
        $data = json_decode($message,true);
        var_export($data);
        switch ($data['type']){
            case self::INIT:
                // 初次连接绑定uid 发送首次连接消息
                Gateway::bindUid($client_id,$data['user_id']);
                Gateway::sendToAll(json_encode([
                    'data' => 'success',
                    'type' => self::INIT,
                    'message' => $data['message'],
                    'user_id' => $data['user_id'],
                ]));
                break;
            case self::PUSH:
                var_export($data);
                Gateway::sendToUid($data['to_user_id'],json_encode([
                    'data' => 'success',
                    'type' => self::PUSH,
                    'message' => $data['message'],
                    'user_id' => $data['user_id'],
                    'to_user_id' => $data['to_user_id'],
                ]));
                break;
            case self::SEND:
                // var_export($data);
                // Gateway::sendToUid($data['to_user_id'],json_encode([
                //     'data' => 'success',
                //     'type' => self::PUSH,
                //     'message' => $data['data'],
                //     'user_id' => $data['user_id']
                // ]));
                break;
        }
        // 向所有人发送 

   }
   
   /**
    * 当用户断开连接时触发
    * @param int $client_id 连接id
    */
   public static function onClose($client_id)
   {
       // 向所有人发送 
       // GateWay::sendToAll("$client_id logout\r\n");
   }
}
