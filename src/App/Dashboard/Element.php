<?php

namespace App\Dashboard;

use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * @Serializer\ExclusionPolicy("ALL")
 **/
class Element
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getTitle()
    {
        return $this->data['title'];
    }

    public function getData()
    {
        return $this->data;
    }
}
