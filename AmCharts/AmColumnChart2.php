<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 24/06/2014
 * Time: 1:18 PM
 */

namespace RedEye\AmChartsBundle\AmCharts;

use RedEye\AmChartsBundle\AmCharts\Option\ObjectOption;

class AmColumnChart2 extends AbstractSerialChart
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
        $this->options->addArrayOption('graphs', new ObjectOption(array('valueField' => 'value')));
        $this->options->addObjectOption('chartScrollbar');
        $this->options->addArrayOption('dataProvider', array(array('category' => 'blah', 'value' => 1), array('category' => 'alsoblah', 'value' => 3)));
        $this->options->addArrayOption('valueAxes');
    }
}
