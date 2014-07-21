<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 24/06/2014
 * Time: 1:18 PM
 */

namespace RC\AmChartsBundle\AmCharts;


class AmLineChart extends AbstractSerialChart
{
    protected $type = 'line';

    public function __construct()
    {
        parent::__construct();
    }

    public function addGraph(array $graphArray)
    {
        $this->jsonSettings->graphs((object)array_merge($graphArray, array('type' => 'line')));
    }

}
