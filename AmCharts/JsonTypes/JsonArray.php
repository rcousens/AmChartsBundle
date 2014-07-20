<?php

namespace RC\AmChartsBundle\AmCharts\JsonTypes;

class JsonArray implements \JsonSerializable
{
    protected $elements;

    public function __construct(array $elements = array())
    {
        $this->elements = $elements;
    }

    public function addElement($element)
    {
        if (is_array($element)) {
            $this->elements[] = new JsonArray($element);
        } elseif (is_object($element)) {
            $this->elements[] = new JsonObject($element);
        } else {
            $this->elements[] = $element;
        }
    }

    public function setElements(array $elements)
    {
        $this->elements = $elements;
    }

    public function jsonSerialize()
    {
        return $this->elements;
    }
}
