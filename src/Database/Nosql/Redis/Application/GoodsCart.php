<?php


namespace Justlzz\Solutions\Database\Nosql\Redis\Application;

/**
 * 利用redis实现购物车
 * Class GoodsCart
 * @package Justlzz\Solutions\Database\Nosql\Redis\Application
 */
class GoodsCart
{
    protected $redis;
    /**
     *  购物车前缀
     *
     * @var string
     */
    protected $goodsCartPre = 'goods_cart_';

    /**
     * 用户id
     *
     * @var
     */
    protected $userId;

    /**
     * 商品id
     * @var
     */
    protected $goodsId;

    /**
     * 商品相关信息
     * @var
     */
    protected $goodsInfo;

    /**
     * 商品数量
     * @var
     */
    protected $goodsNum;

    public function __construct(\Redis $redis)
    {
        $this->redis = $redis;
    }

    public function setUserId($userId)
    {
        return $this->userId = $userId;
    }

    public function setGoodsNum($num)
    {
        return $this->goodsNum = $num;
    }


    public function setGoodsInfo($goodsInfo)
    {
        return $this->goodsInfo = $goodsInfo;
    }

    public function setGoodsId($goodsId)
    {
        return $this->goodsId = $goodsId;
    }

    public function setGoodsCartPre($pre)
    {
        return $this->goodsCartPre = $pre;
    }

    /**
     * Notes:向购物车插入或更新一个商品数据
     * @return bool|int
     * @throws \Exception
     */
    public function insertCart()
    {
        if (!$this->userId) throw new \Exception('please set userId');
        if (!$this->goodsId) throw new \Exception('please set goodsId');
        if (!$this->goodsNum) throw new \Exception('please set goodsNum');
        if (!$this->goodsInfo) throw new \Exception('please set goodsInfo');
        $goodsValue = ['update_time' => time(),
                        'num' => $this->goodsNum,
                        'info' => $this->goodsInfo,
                        'create_time' => time()];
        return $this->redis->hSet($this->getKey(), $this->goodsId, json_encode($goodsValue));
    }

    /**
     * Notes:更新购物车商品数据
     * @return bool|int
     * @throws \Exception
     */
    public function updateCart()
    {
        if (!$this->userId) throw new \Exception('please set userId');
        if (!$this->goodsId) throw new \Exception('please set goodsId');
        //商品原始信息
        $goodsValue = $this->getGoodsValue();
        if (isset($this->goodsInfo)) $goodsValue['info'] = $this->goodsInfo;
        if (isset($this->goodsNum)) $goodsValue['num'] = $this->goodsNum;
        $goodsValue['update_time'] = time();
        return $this->redis->hSet($this->getKey(), $this->goodsId, json_encode($goodsValue));
    }

    /**
     * Notes:获取一个购物车商品数据
     * @return mixed
     */
    public function getGoodsValue()
    {
        return json_decode($this->redis->hGet($this->getKey(), $this->goodsId), true);
    }

    /**
     * Notes:获取购物车key
     * @return string
     */
    protected function getKey()
    {
        return $this->goodsCartPre . $this->userId;
    }

    /**
     * Notes:获取购物车商品列表
     * @param array $ids
     * @return mixed
     * @throws \Exception
     */
    public function getGoodsList(Array $ids = [])
    {
        if (!$this->userId) throw new \Exception('please set userId');
        if (empty($ids))
        {
            $goodsList = $this->decodeArrayJson($this->redis->hGetAll($this->getKey()));
        } else {
            $goodsList = $this->decodeArrayJson($this->redis->hMGet($this->getKey(),$ids));
        }

        return $this->sortGoodsList($goodsList);
    }

    /**
     * Notes:对商品按插入时间进行排序
     * @param $goodsList
     * @return mixed
     */
    public function sortGoodsList($goodsList)
    {
        array_multisort(array_column($goodsList, 'create_time'), SORT_DESC, $goodsList);
        return $goodsList;
    }

    /**
     * Notes:将数组中的json转化成数组
     * @param $array
     * @return mixed
     */
    public function decodeArrayJson($array)
    {
        foreach ($array as $key=>$value)
        {
            $array[$key] = json_decode($value,true);
        }
        return $array;
    }

    /**
     * Notes:删除购物车商品
     * @param array $ids
     * @return bool|int
     * @throws \Exception
     */
    public function delGoods($ids = [])
    {
        if (!$this->userId) throw new \Exception('please set userId');
        if (empty($ids)) return $this->redis->del($this->getKey());
        return $this->redis->hDel($this->getKey(), ...$ids);
    }


}