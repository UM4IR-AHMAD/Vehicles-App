<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $carsCount = Car::all()->count();
        return response()->json([
            'registeredCars' => $carsCount
        ]);
    }
}
