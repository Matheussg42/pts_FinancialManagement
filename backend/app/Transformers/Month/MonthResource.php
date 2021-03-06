<?php

namespace App\Transformers\Month;

use Illuminate\Http\Resources\Json\Resource;

use App\Services\ResponseService;
use App\Http\Controllers\UserController;

class MonthResource extends Resource
{
    /**
     * @var
     */
    private $config;

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource, $config = array())
    {
        // Ensure you call the parent constructor
        parent::__construct($resource);

        $this->config = $config;
    }
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      
        return [
            'id' => $this->id,
            'User' => UserController::getUserName($this->user_id),
            'Data' => $this->yearMonth,
            'Ano' => substr($this->yearMonth, 0, 4),
            'VR' => $this->ticket,
            'Received' => $this->received,
            'Paid' => $this->paid,
            'Total' => $this->total,
            'Status' => $this->status,
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return ResponseService::default($this->config,$this->id);
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param  \Illuminate\Http\Request
     * @param  \Illuminate\Http\Response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->setStatusCode(200);
    }
}
