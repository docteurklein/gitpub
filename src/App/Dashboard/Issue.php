<?php

namespace App\Dashboard;

use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * @Serializer\ExclusionPolicy("ALL")
 **/
class Issue
{
    /**
     * @Serializer\Expose
     **/
    private $element;

    private $repo;

    public function __construct(Element $element, $repo)
    {
        $this->element = $element;
        $this->repo = $repo;
    }

    /**
     * @Serializer\VirtualProperty
     **/
    public function getRepo()
    {
        return $this->repo;
    }


    /**
     * @Serializer\VirtualProperty
     **/
    public function getTitle()
    {
        return $this->element->getTitle();
    }
}
