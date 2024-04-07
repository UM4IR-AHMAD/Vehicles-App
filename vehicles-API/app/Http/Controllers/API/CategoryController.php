<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * fetch data according sorting and pagination
     * @param Request has the value of sort type page number
     * @return result data
     */
    public function index(Request $request)
    {
        $sort = explode('-', $request->sort);
        return response()->json([
            'categories' => Category::orderBy($sort[0], $sort[1])->paginate(2)
        ]);
    }

    /**
     * fetch all categories
     * @return result data
     */
    public function all()
    {
        return response()->json([
            'categories' => Category::all()
        ]);
    }

    /**
     * store new category
     * @param Request new category data
     * @return success message
     */
    public function store(Request $request)
    {
        // validate that category already exists
        $validator = Validator::make($request->all(), [
            'name' => 'unique:categories'
        ]);

        // send response if already exists
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Category already exists'
            ]);
        }

        Category::create(['name' => $request->name]);
        return response()->json([
            'success' => true,
            'message' => 'Category has added successfully'
        ]);
    }


    /**
     * fetch a specific category data     
     * @param object Category 
     * @return category
     */
    public function edit(Category $category)
    {
        return response()->json([
            'success' => true,
            'category' => $category
        ]);
    }


    /**
     * update category data
     * @param Request category update data
     * @return success message
     */
    public function update(Request $request)
    {
        // validate that category already exists but ignore given id row
        $validator = Validator::make($request->all(), [
            'name' => 'unique:categories,name,' . $request->id
        ]);

        // send response if already exists
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Category already exists'
            ]);
        }

        
        Category::find($request->id)->update(['name' => $request->name]);
        return response()->json([
            'success' => true,
            'message' => 'Category has updated successfully'
        ]);
    }

    /**
     * delete specific category data
     * @param object Category 
     * @return success message
     */
    public function delete(Category $category)
    {
        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Category has deleted successfully'
        ]);
    }
}
