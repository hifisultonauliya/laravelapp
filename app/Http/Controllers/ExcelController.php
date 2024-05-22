<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

class ExcelController extends Controller
{
    public function getData()
    {
        try {
            $path = storage_path('app/public/sampledatas.xlsx'); // Path to your existing Excel file
            $data = Excel::toCollection(null, $path)->first(); // Load data into a collection
            // return response()->json($data);

            // Convert the collection to a regular PHP array
            $data = $data->toArray();

            $fieldNames = $data[0]; // Assuming the first row contains field names

            // Remove the first row (field names)
            array_shift($data);

            // Convert data rows into an array of objects
            $objects = [];
            foreach ($data as $row) {
                $object = new \stdClass(); // Create an empty object

                foreach ($fieldNames as $index => $fieldName) {
                    if(is_null($fieldName)){
                        continue;
                    }elseif($fieldName == "qty"){
                        $object->{$fieldName} = (int)$row[$index];
                        $object->{$fieldName."Original"} = $row[$index];
                    }elseif($fieldName == "size"){
                        $object->{$fieldName} = $this->calculateMixedNumber($row[$index]);
                        $object->{$fieldName."Str"} = $this->getSizeDesc($object->{$fieldName});
                        $object->{$fieldName."Original"} = $row[$index];
                    }else{
                        $object->{$fieldName} = $row[$index];
                    }
                    
                }

                $objects[] = $object;
            }
            return response()->json($objects);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function getSizeDesc($input){
        return $input."\" (".$this->convertInchToMilimeter($input)."mm)";
    }

    private function convertInchToMilimeter($input){
        return $input * 24.5;
    }

    private function calculateMixedNumber($input) {
        // Remove spaces and split into parts
        $parts = explode(" ", $input);
    
        // Initialize the result
        $result = 0.0;
    
        // Convert and multiply each part
        foreach ($parts as $part) {
            if (strpos($part, '/') !== false) {
                // Handle fractions (e.g., "1/2")
                list($numerator, $denominator) = explode('/', $part);
                $result += (float)$numerator / (float)$denominator;
            } else {
                // Handle whole numbers (e.g., "5")
                $result += (float)$part;
            }
        }
    
        return $result;
    }
}
