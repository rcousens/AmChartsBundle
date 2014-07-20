<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 24/06/2014
 * Time: 1:18 PM
 */

namespace RC\AmChartsBundle\AmCharts;


class AmColumnChart extends AbstractSerialChart
{
    protected $type = 'column';

    public function __construct()
    {
        parent::__construct();
        $this->jsonSettings->rotate(true);
    }

    public function addGraph(array $graphArray)
    {
        $this->jsonSettings->graphs((object)array_merge($graphArray, array('type' => 'column')));
    }

    public function setRotate($rotate)
    {
        $this->jsonSettings->rotate($rotate);
    }

}
