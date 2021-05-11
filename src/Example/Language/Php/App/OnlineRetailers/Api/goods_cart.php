<?php
require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\Config\Config;
use Justlzz\Solutions\Database\Nosql\Redis\Redis;
use Justlzz\Solutions\Database\Nosql\Redis\Application\GoodsCart;

/**
 *购物车相关利用redis实现购物车
 *使用hash结构(key field value) => (userId sku_id skuValue)
 */

//伪数据
$uid = 1;
$goodsId = 3;
$goodsNum = 3;
$goodsInfo =  ['goods_name' => '海蓝之家男装T恤',
                'goods_pic' => 'http://fffsdf.awea.com/fef.jpg',
                'goods_price' => 50];

$config = new Config('redis');
$redis = Redis::getInstance($config);
$cart = new GoodsCart($redis);

////插入一条购物车数据
//function insertCart($cart, $uid, $goodsId, $goodsNum, $goodsInfo)
//{
//    $cart->setUserId($uid);
//    $cart->setGoodsId($goodsId);
//    $cart->setGoodsNum($goodsNum);
//    $cart->setGoodsInfo($goodsInfo);
//    try {
//        return $cart->insertCart();
//    } catch (Exception $exception)
//    {
//        echo $exception->getMessage();
//    }
//}
//
//insertCart($cart, $uid, $goodsId, $goodsNum, $goodsInfo);

////更新购物车商品信息
//function updateCart($cart, $uid, $goodsId, $goodsNum = null, $goodsInfo = null)
//{
//    $cart->setUserId($uid);
//    $cart->setGoodsId($goodsId);
//    $cart->setGoodsNum($goodsNum);
//    $cart->setGoodsInfo($goodsInfo);
//    try {
//        return $cart->updateCart();
//    } catch (Exception $exception)
//    {
//        echo $exception->getMessage();
//    }
//}
//updateCart($cart, $uid, $goodsId, $goodsNum + 1);

////获取购物车列表
//function getGoodsList($cart, $uid, $ids = [])
//{
//    $cart->setUserId($uid);
//    try {
//        return $cart->getGoodsList($ids);
//    } catch (Exception $exception)
//    {
//        echo $exception->getMessage();
//    }
//}
//var_dump(getGoodsList($cart, $uid, [1,2]));

////清空购物车
//function emptyCart($cart, $uid)
//{
//    $cart->setUserId($uid);
//    try {
//        return $cart->emptyCart();
//    } catch (Exception $exception)
//    {
//        echo $exception->getMessage();
//    }
//}
//emptyCart($cart, $uid);