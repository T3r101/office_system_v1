<?php

namespace App\Imports;

use App\Models\Record;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RecordsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function model(array $row)
    {
        return new Record([
            'user_id' => $this->userId,
            'name' => $row['name'],
            'amount' => $row['amount'],
            'date' => $row['date'],
        ]);
    }

    public function rules(): array
    {
        return [
'name' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ];
    }

    public function onError(\Exception $error)
    {
        // Log error or handle
        logger()->error('Import error: ' . $error->getMessage());
    }
}

