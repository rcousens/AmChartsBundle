<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 24/06/2014
 * Time: 1:18 PM
 */

namespace RedEye\AmChartsBundle\AmCharts;


class AmGaugeChart extends AbstractChart implements ChartInterface
{
    protected $type = 'gauge';

    public function __construct()
    {
        parent::__construct();
        $this->jsonSettings->type('gauge');
        $this->jsonSettings->axes([]);
        $this->jsonSettings->arrows([]);
    }

    public function addAxis(array $axis)
    {
        $this->jsonSettings->axes((object) $axis);
    }

    public function addArrow(array $arrow)
    {
        $this->jsonSettings->arrows((object) $arrow);
    }
}
