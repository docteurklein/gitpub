<?php

namespace App\Dashboard;

use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * @Serializer\ExclusionPolicy("ALL")
 **/
class PR
{
    /**
     * @Serializer\Expose
     **/
    private $element;

    public function __construct(Element $element)
    {
        $this->element = $element;
    }

    /**
     * @Serializer\VirtualProperty
     **/
    public function getRepo()
    {
        return $this->element->getData()['head']['repo']['full_name'];
    }

    /**
     * @Serializer\VirtualProperty
     **/
    public function getTitle()
    {
        return $this->element->getTitle();
    }
}
