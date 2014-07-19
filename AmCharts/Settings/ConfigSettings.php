<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 19/07/14
 * Time: 3:22 PM
 */

namespace RC\AmChartsBundle\AmCharts\Settings;


class ConfigSettings {

    protected $container = 'chart';
    protected $height = 400;
    protected $width = 400;

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return string
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param string $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }
}