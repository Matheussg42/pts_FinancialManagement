<?php

namespace App\Http\Controllers;

use App\Month;
use Illuminate\Http\Request;
use App\Transformers\Month\MonthResource;
use App\Transformers\Month\MonthResourceCollection;
use App\Http\Requests\Month\StoreMonth;
use App\Http\Requests\Month\UpdateMonth;
use App\Services\ResponseService;
use App\Http\Controllers\Notification;
use App\Repositories\Month\MonthRepository;

class MonthController extends Controller
{
    private $month;

    public function __construct(MonthRepository $month){
        $this->month = $month;
    }

    public function index()
    {
        return new MonthResourceCollection($this->month->all());
    }

    public function store(StoreMonth $request)
    {
        try{        
            $data = $this
            ->month
            ->create($request->all());
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('months.store',null,$e);
        }

        return new MonthResource($data,array('type' => 'store','route' => 'months.store'));
    }

    //TODO - Validar quando não tem retorno.
    public function show($id)
    {
        try{        
            $data = $this
            ->month
            ->show($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('months.show',null,$e);
        }

        return new MonthResource($data,array('type' => 'show','route' => 'months.show'));
    }

    public function update(UpdateMonth $request, $id)
    {
        try{        
            $data = $this
            ->month
            ->update($request->all(), $id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('months.update',$id,$e);
        }

        return new MonthResource($data,array('type' => 'update','route' => 'months.update'));
    }

    public function close($id)
    {
        try{        
            $data = $this
            ->month
            ->close($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('months.close', $id, $e);
        }

        return new MonthResource($data,array('type' => 'update','route' => 'months.close'));
    }

    public function destroy($id)
    {
        try{
            $data = $this
            ->month
            ->destroy($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('months.destroy',$id,$e);
        }
        return new MonthResource($data,array('type' => 'destroy','route' => 'months.destroy')); 
    }

    static function getMonthName($id){
        $month = new MonthRepository();
        $monthName = $month->getMonthName($id);
        return $monthName;
    }
}
