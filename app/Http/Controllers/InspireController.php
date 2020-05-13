<?php

namespace App\Http\Controllers;

use App\Services\InspireService;
use Illuminate\Http\Request;

class InspireController extends Controller
{
    private $service;
    public function __construct(InspireService $inspireService)
    {
        $this->service = $inspireService;
    }

    /**
     * @return string
     */
    public function inspire()
    {
        return $this->service->inspire();
    }
}
