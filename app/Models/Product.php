<?php

namespace App\Models;

/**
 * Class Product
 * @package App\Models
 */
class Product
{
    private $id;
    private $code;
    private $itemId;
    private $qty;
    private $qtyUnit;
    private $countryName;
    private $itemCode;
    private $itemDesc;
    private $productType;
    private $grade;
    private $connection;
    private $size;
    private $sizeDesc;
    private $sizeOriginal;

    
    // Constructor without parameters
    public function __construct() {}

    // Public get function with filtering
    public function getAllData(array $fields = []): array
    {
        $data = [
            "id" => $this->id,
            "code" => $this->code,
            "itemId" => $this->itemId,
            "qty" => $this->qty,
            "qtyUnit" => $this->qtyUnit,
            "countryName" => $this->countryName,
            "itemCode" => $this->itemCode,
            "itemDesc" => $this->itemDesc,
            "productType" => $this->productType,
            "grade" => $this->grade,
            "connection" => $this->connection,
            "size" => $this->size,
            "sizeDesc" => $this->sizeDesc,
            "sizeOriginal" => $this->sizeOriginal,
        ];

        if (empty($fields)) {
            return $data;
        }

        return array_filter(
            $data,
            function ($key) use ($fields) {
                return in_array($key, $fields);
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    public function getMastersData(): array
    {
        return [
            "qty" => $this->qty,
            "productType" => $this->productType,
            "grade" => $this->grade,
            "connection" => $this->connection,
            "sizeDesc" => $this->sizeDesc,
        ];
    }

    // public set function
    public function setId(string $id): void
    {
        $this->id = (int)$id;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function setItemId(string $itemId): void
    {
        $this->itemId = $itemId;
    }

    public function setQty(string $qty): void
    {
        $this->qty = (int)$qty;
    }

    public function setQtyUnit(string $qtyUnit): void
    {
        $this->qtyUnit = $qtyUnit;
    }

    public function setCountryName(string $countryName): void
    {
        $this->countryName = $countryName;
    }

    public function setItemCode(string $itemCode): void
    {
        $this->itemCode = $itemCode;
    }

    public function setItemDesc(string $itemDesc): void
    {
        $this->itemDesc = $itemDesc;
    }

    public function setProductType(string $productType): void
    {
        $this->productType = $productType;
    }

    public function setGrade(string $grade): void
    {
        $this->grade = $grade;
    }

    public function setConnection(string $connection): void
    {
        $this->connection = $connection;
    }

    public function setSize(string $sizeOriginal): void
    {
        $this->sizeOriginal = $sizeOriginal;
        $this->size = $this->calculateMixedNumber($sizeOriginal);
        $this->sizeDesc = $this->getSizeDesc($this->size);
    }

    // private func
    private function getSizeDesc(float $input): string
    {
        return (string)$input."\" (".(string)$this->convertInchToMilimeter($input)."mm)";
    }

    private function convertInchToMilimeter(float $input): float
    {
        return $input * 24.5;
    }

    private function calculateMixedNumber(string $input): float
    {
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
