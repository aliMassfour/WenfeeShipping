<?php


namespace App\Clustering\DbscanAdapter;

use App\Models\Order;
use \Phpml\Clustering\Clusterer;


/**
 * Class DbscanAdapter
 * @package App\Clustering\DbscanAdapter
 */
class DbscanAdapter implements Clusterer
{

    /**
     * @var Clusterer|\Phpml\Clustering\DBSCAN
     */

    protected Clusterer $adaptee;
    /**
     * @var double|float
     */
    protected $epsilon;
    /**
     * @var int|int
     */
    protected $minSamples;
    /**
     * @var array
     */
    protected array $clusters;
    /**
     * @var \App\Models\Order
     */
    protected \App\Models\Order $order;
    /**
     * @var array
     */
    protected $samples = array();

    public function __construct($epsilon, $minSamples)
    {
        $this->epsilon = $epsilon;
        $this->minSamples = $minSamples;

        $this->adaptee = new \Phpml\Clustering\DBSCAN($epsilon, $minSamples);
    }

    /**
     * this method is just for return te orders as an array of coordinates
     * @param $samples
     * @return array
     */
    protected function convertSamples($samples)
    {
        $convertedSamples = [];
        foreach ($samples as $sample) {
            $convertedSamples[] = [$sample["lat"], $sample["lng"]];
        }
        return $convertedSamples;
    }

    /**
     * this is the adaptee method
     * @param array $samples
     * @return array
     *
     */
    public function cluster(array $samples): array
    {
        $this->samples = $samples;
        $convertedSamples = $this->convertSamples($samples);
        $this->clusters = $this->adaptee->cluster($convertedSamples);
        return $this->convertOutput();
    }

    /**
     * @param Order $order
     * @return void
     */
    public function setOrder(Order $order): void
    {
        $this->order = $order;

    }

    protected function convertOutput(): array
    {
        $index = null;
        $a=[];
        foreach ($this->clusters as $group => $cluster) {
            $a[]=$group;
            foreach ($cluster as $cooridinates) {
                if ($cooridinates[0] === $this->order->lat && $cooridinates[1] === $this->order->lng) {
                    $index = $group;
                    break;
                }
            }
        }
//        return $this->clusters;
//        return [$index];

        if ($index !== null) {
            $clusterGroup = $this->clusters[$index];
            $ordersGroup = [];
            foreach ($clusterGroup as $cluster) {
                foreach ($this->samples as $sample) {
                    if ($sample["lat"] == $cluster[0] and $sample["lng"] == $cluster[1]) {
                        $ordersGroup[] = $sample;
                    }
                }
            }

            return $ordersGroup;
        } else {
            $clusterGroup = [$this->order];
            return $clusterGroup;
        }
//        return [[$this->order->lat, $this->order->lng], $clusterGroup];

    }
}
