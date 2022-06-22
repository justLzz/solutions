<?php


namespace Justlzz\Solutions\Language\Php\High\DHT\Simple;


class ConsistentHash
{
    /**
     * 虚拟节点数，解决分布式节点分布不均问题
     * @var int
     */
    private $_replicas = 64;

    /**
     * 哈希算法
     * @var object HashAlgorithm
     */
    private $_hasher;

    /**
     * 节点计数器
     * @var int
     */
    private $_targetCount = 0;

    /**
     * 位置对应节点，用于lookup中根据位置确定要访问的节点
     * @var array
     */
    private $_positionToTarget = [];

    /**
     * 节点对应位置，用于删除节点
     * @var array
     */
    private $_targetToPositions = [];

    /**
     * 是否已经排序
     * @var bool
     */
    private $_positionToTargetSorted = false;

    /**
     * 构造函数,确定要使用的hash方法和需拟节点数,虚拟节点数越多,分布越均匀,但程序的分布式运算越慢
     * ConsistentHash constructor.
     * @param HashAlgorithm|null $hash hash算法
     * @param null $replicas 虚拟节点数
     */
    public function __construct(HashAlgorithm $hash = null, $replicas = null)
    {
        $this->_hasher = $hash ? $hash : new Crc32Hash();
        if (!empty($replicas)) $this->_replicas = $replicas;
    }

    /**
     * 添加一个节点
     * @param $target
     * @return $this
     * @throws \Exception
     */
    public function addTarget($target)
    {
        if (isset($this->_targetToPositions[$target]))
        {
            throw new \Exception("Target $target is already exists");
        }

        $this->_targetToPositions[$target] = [];

        //给这个节点hash到多个位置，为了让节点数据分布均匀

        for ($i = 0; $i < $this->_replicas; $i++)
        {
            $position = $this->_hasher->hash($target . $i);
            $this->_positionToTarget[$position] = $target;
            $this->_targetToPositions[$target][] = $position;
        }

        $this->_positionToTargetSorted = false;
        $this->_targetCount++;

        return $this;
    }

    /**
     * 添加节点列表
     * @param $targets
     * @return $this
     * @throws \Exception
     */
    public function addTargets($targets)
    {
        foreach ($targets as $target)
        {
            $this->addTarget($target);
        }

        return $this;
    }

    /**
     * 删除一个节点
     * @param $target
     * @return $this
     * @throws \Exception
     */
    public function removeTarget($target)
    {
        if (!isset($this->_targetToPositions[$target]))
        {
            throw new \Exception("Target '$target' does not exist");
        }

        foreach ($this->_targetToPositions['target'] as $position)
        {
            unset($this->_positionToTarget[$position]);
        }

        unset($this->_targetToPositions[$target]);

        $this->_targetCount--;

        return $this;
    }

    /**
     * 获取所有节点
     * @return array
     */
    public function getAllTargets()
    {
        return array_keys($this->_targetToPositions);
    }

    /**
     * 获取所有节点和位置信息
     * @return array
     */
    public function getAll()
    {
        return [
            "targets" => $this->_targetToPositions,
            "positions" => $this->_positionToTarget
        ];
    }

    public function lookup($resource)
    {
        $targets = $this->lookupList($resource, 1);
        if (empty($targets)) throw new \Exception("No targets exist");
        return $targets[0];
    }

    /**
     * 查找当前的资源对应的节点,
     * 节点为空则返回空,节点只有一个则返回该节点,
     * 对当前资源进行hash,对所有的位置进行排序,在有序的位置列上寻找当前资源的位置
     * 当全部没有找到的时候,将资源的位置确定为有序位置的第一个(形成一个环)
     * 返回所找到的节点
     * @param $resource
     * @param $requestCount
     */
    public function lookupList($resource, $requestCount)
    {
        if (!$requestCount) throw new \Exception("Invalid count requested");
        //无节点
        if (empty($this->_positionToTarget)) return [];
        //单节点
        if ($this->_targetCount == 1) return array_unique(array_values($this->_positionToTarget));
        //将资源hash到一个位置
        $resourcePosition = $this->_hasher->hash($resource);

        $results = [];

        $this->_sortPositionTargets();

        //开始寻找位置，找到资源第一个碰到的位置
        foreach ($this->_positionToTarget as $key => $value)
        {
            //找到第一个可用节点 ,可用节点放入结果列表
            if ($key > $resourcePosition && !in_array($value, $results))
            {
                $results[] = $value;
            }

            //找到足够的节点，或者节点数达到最大
            if (count($results) == $requestCount || count($results) == $this->_targetCount)
            {
                return $results;
            }

        }

        //如果都没找到资源位置，说明节点位置都小于资源位置
        foreach ($this->_positionToTarget as $key => $value)
        {
            if (!in_array($value, $results))
            {
                $results []= $value;
            }

            if (count($results) == $requestCount || count($results) == $this->_targetCount)
            {
                return $results;
            }
        }

    }

    public function __toString()
    {
        return sprintf(
            '%s{targets:[%s]}',
            get_class($this),
            implode(',', $this->getAllTargets())
        );
    }


    private function _sortPositionTargets()
    {
        if (!$this->_positionToTargetSorted)
        {
            ksort($this->_positionToTarget, SORT_REGULAR);
            $this->_positionToTargetSorted = true;
        }
    }


}