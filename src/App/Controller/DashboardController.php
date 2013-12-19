<?php

namespace App\Controller;

use App\Dashboard\Decider;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\Serializer;

class DashboardController
{
    private $decider;
    private $Serializer;

    public function __construct(Decider $decider, Serializer $serializer)
    {
        $this->decider = $decider;
        $this->serializer = $serializer;
    }

    public function indexAction()
    {
        $json = $this->serializer->serialize($this->decider, 'json');

        return new Response($json);
    }

    public function countTotalAction()
    {
        return new Response(count(iterator_to_array($this->decider->all())));
    }

    public function getLatestInvolvedIssueAction($user)
    {
        $json = $this->serializer->serialize($this->decider->getLatestInvolvedIssue($user), 'json');

        return new Response($json);
    }
}
