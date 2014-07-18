<?php

require '../vendor/autoload.php';

use RedEye\AmChartsBundle\AmCharts\Option\OptionCollection;
use RedEye\AmChartsBundle\AmCharts\Option\ArrayOption;
use RedEye\AmChartsBundle\AmCharts\Option\ObjectOption;

class OptionTest
{
    public $options;

    public function __construct()
    {
        $this->options = new OptionCollection();
    }

    public function setOptions()
    {
        $this->options->addScalarOption('scalarInt', 5);
        $this->options->addScalarOption('scalarString', "Hello");
        $this->options->addArrayOption('arrayOption');
        $this->options->addObjectOption('objectOption');
        $this->options->addArrayOption('arrayObjectOption');
        $this->options->addObjectOption('objectArrayOption');

    }

    public function render()
    {
        return $this->options->render();
    }
}

class OptionTestHarness
{
    protected $blah;

    public function __construct()
    {
//        $blah = new OptionTest();
//        $blah->setOptions();
//        echo $blah->render();
//        echo "\n\n\n";
//
//
//        $blah->options->arrayOption(array('blah', 'blah2'));
//        $blah->options->objectOption(array('boo' => 'faz', 'bar' => 'foo'));
//        $blah->options->arrayObjectOption(new ObjectOption(array('blah' => 'boo', 'bah' => 'eeee')));
//        $blah->options->objectArrayOption(new ArrayOption('blah', array('boo', 'boo', 'boo')));
//        echo $blah->render();
//
//        echo "\n\n\n\n";
//        $blah->options->arrayObjectOption(new ObjectOption(new ArrayOption('doubleblah', new ObjectOption(array('boo' => 'baaa', 'bee' => 'pooo')))));
//        $blah->options->objectArrayOption(new ArrayOption('blah', array('boo', 'boo', 'boo')));
//        echo $blah->render();


        $alsoBlah = new \RedEye\AmChartsBundle\AmCharts\AmLineChart2();
        echo $alsoBlah->render();

    }
}

new OptionTestHarness();



