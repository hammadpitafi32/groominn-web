<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\Service;

class ServiceProviderService
{
	protected $service;

    /**
     * Constructs a new service object.
     *
     * @param App\Models\Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function createOrUpdate()
    {
    	dd('dfg');
    }
}