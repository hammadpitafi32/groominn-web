<?php
  
namespace App\Traits;
  
use Illuminate\Http\Request;

use App\Models\Service;
  
trait ServiceTrait {
  
    /**
     * @param Request $request
     * @return $this|false|string
     */

    public function createOrUpdateService(Request $request)
    {
        $service = Service::updateOrCreate([
            'name' => $request->service,
        ]);
        return $service;
    }
  
}