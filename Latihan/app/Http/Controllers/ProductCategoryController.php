<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Http\Resources\ProductCategoryCollection;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        try {
            $queryData = ProductCategory::all();
            $formattedDatas = new ProductCategoryCollection($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function store(StoreProductCategoryRequest $request)
    {
        $validatedRequest = $request->validated();
        try {
            $queryData = ProductCategory::create($validatedRequest);
            $formattedDatas = new ProductCategoryResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function show(string $id)
    {
        try {
            $queryData = ProductCategory::findOrFail($id);
            $formattedDatas = new ProductCategoryResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(UpdateProductCategoryRequest $request, string $id)
    {
        $validatedRequest = $request->validated();
        try {
            $queryData = ProductCategory::findOrFail($id);
            $queryData->update($validatedRequest);
            $queryData->save();
            $formattedDatas = new ProductCategoryResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function destroy(string $id)
    {
        try {
            $queryData = ProductCategory::findOrFail($id);
            $queryData->delete();
            $formattedDatas = new ProductCategoryResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}