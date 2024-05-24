<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Models\Product;

class ExcelController extends Controller
{
    public function getMasterProduct()
    {
        try {
            $path = storage_path('app/public/sampledatas.xlsx'); // Path to your existing Excel file
            $data = Excel::toCollection(null, $path)->first(); // Load data into a collection
            // return response()->json($data);

            // Convert the collection to a regular PHP array
            $data = $data->toArray();

            // $fieldNames = $data[0]; // Assuming the first row contains field names

            // Remove the first row (field names)
            array_shift($data);

            // Convert data rows into an array of objects
            $products = [];
            foreach ($data as $row) {
                // mapping into product
                $product = new Product();
                $product->setId($row[0]);
                $product->setCode($row[1]);
                $product->setItemId($row[2]);
                $product->setQty($row[3]);
                $product->setQtyUnit($row[4]);
                $product->setCountryName($row[5]);
                $product->setItemCode($row[6]);
                $product->setItemDesc($row[7]);
                $product->setProductType($row[8]);
                $product->setGrade($row[9]);
                $product->setConnection($row[10]);
                $product->setSize($row[11]);

                $products[] = $product->getMastersData();
            }
            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getAllDatas(Request $request)
    {
        try {
            $path = storage_path('app/public/sampledatas.xlsx'); // Path to your existing Excel file
            $data = Excel::toCollection(null, $path)->first(); // Load data into a collection

            // Convert the collection to a regular PHP array
            $data = $data->toArray();

            // Remove the first row (field names)
            array_shift($data);

            // Convert data rows into an array of objects
            $products = [];
            foreach ($data as $row) {
                $product = new Product();
                $product->setId($row[0]);
                $product->setCode($row[1]);
                $product->setItemId($row[2]);
                $product->setQty($row[3]);
                $product->setQtyUnit($row[4]);
                $product->setCountryName($row[5]);
                $product->setItemCode($row[6]);
                $product->setItemDesc($row[7]);
                $product->setProductType($row[8]);
                $product->setGrade($row[9]);
                $product->setConnection($row[10]);
                $product->setSize($row[11]);

                $products[] = $product;
            }

            // Get filter parameters from the request
            $productType = $request->query('productType');
            $size = $request->query('size');
            $grade = $request->query('grade');
            $connection = $request->query('connection');

            // Filter products based on the query parameters
            $filteredProducts = array_filter($products, function ($product) use ($productType, $size, $grade, $connection) {
                return response()->json((!$productType || $product->getAllData()['productType'] === $productType) &&
                       (!$size || $product->getAllData()['sizeDesc'] === $size) &&
                       (!$grade || $product->getAllData()['grade'] === $grade) &&
                       (!$connection || $product->getAllData()['connection'] === $connection));
            });

            // Transform the filtered products to get the required data
            $filteredProductsData = array_map(function ($product) {
                return $product->getAllData();
            }, $filteredProducts);

            return response()->json($filteredProductsData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
