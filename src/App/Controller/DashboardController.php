<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Dashboard;

class DashboardController
{
    private $dashboard;

    public function __construct(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    public function indexAction()
    {
        return new JsonResponse($this->dashboard->all());
    }
}
