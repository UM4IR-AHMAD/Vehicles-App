<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * fetch data according sorting and pagination
     * @param Request has the value of sort type page number
     * @return result data
     */
    public function index(Request $request)
    {
        $sort = explode('-', $request->sort);
        $cars = $sort[0] !== 'category'
            // fetch data order by make or created at
            ? Car::with('category')->orderBy($sort[0], $sort[1])->paginate(2)
            // fetch in order by categry name
            : Car::with('category')
            ->orderBy(
                Category::select('name')->whereColumn('categories.id', 'cars.category_id')
            )
            ->paginate(2);
        return response()->json([
            'cars' => $cars
        ]);
    }

    /**
     * store new car     
     * @param Request new car data
     * @return success message
     */
    public function store(Request $request)
    {
        // validate that registration already exists
        $validator = Validator::make($request->all(), [
            'registration_no' => 'unique:cars,registration_no'
        ]);

        // send response if already exists
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registration_no already used'
            ]);
        }

        Car::create($request->only([
            'category_id',
            'make',
            'model',
            'color',
            'registration_no'
        ]));
        return response()->json([
            'success' => true,
            'message' => 'Car has added successfully'
        ]);
    }


    /**
     * fetch a specific car data     
     * @param object Car 
     * @return car
     */
    public function edit(Car $car)
    {
        return response()->json([
            'car' => $car
        ]);
    }


    /**
     * update car data
     * @param Request car update data
     * @return success message
     */
    public function update(Request $request)
    {
        // validate that registration already exists but ignore given id row
        $validator = Validator::make($request->all(), [
            'registration_no' => 'unique:cars,registration_no,' . $request->id
        ]);

        // send response if already exists
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registration_no already used'
            ]);
        }

        Car::find($request->id)->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Car has updated successfully'
        ]);
    }

    /**
     * delete specific car data
     * @param object Car
     * @return success message 
     */
    public function delete(Car $car)
    {
        $car->delete();
        return response()->json([
            'success' => true,
            'message' => 'Car has deleted successfully'
        ]);
    }
}
