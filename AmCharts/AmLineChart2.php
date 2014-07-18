<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 24/06/2014
 * Time: 1:18 PM
 */

namespace RedEye\AmChartsBundle\AmCharts;


class AmLineChart2 extends AbstractSerialChart
{
    public function __construct()
    {
        parent::__construct();
    }

    public function setOptions()
    {
        parent::setOptions();
        $this->options->addScalarOption('type', 'serial');
        $this->options->addScalarOption('categoryField', 'category');
        $this->options->addArrayOption('graphs');
        $this->options->addObjectOption('chartScrollbar');
        $this->options->addArrayOption('dataProvider');
        $this->options->addArrayOption('valueAxes');
    }
}
