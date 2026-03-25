<?php

namespace App\Http\Controllers;

use App\Imports\RecordsImport;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{
    public function index()
    {
        return view('import');
    }

    public function preview(Request $request)
    {
        $request->validate([
'excel_file' => 'required|file|mimes:xlsx,xls,xlsm,xlsb,xltm,xltx,ods,ots,fods,tsv,csv|max:20480' // 20MB - Full Excel support
        ]);

        $file = $request->file('excel_file');
        $path = $file->store('temp', 'public');

        // Parse preview data (first 10 rows)
        $fullFilePath = storage_path('app/public/' . $path);
        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fullFilePath);
            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray(null, true, true, true);
            $headers = $data[0] ?? [];
            $previewData = array_slice($data, 1); // No limits - all rows for print
        } catch (\Exception $e) {
            return back()->with('error', 'Excel file read error: ' . $e->getMessage());
        }

        return view('import', compact('previewData', 'path', 'headers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_path' => 'required|string|max:5000'
        ]);

        $filePath = $request->file_path;
        $fullPath = storage_path('app/public/' . $filePath);

        if (!file_exists($fullPath)) {
            return back()->with('error', 'File not found.');
        }

        // Import data
        Excel::import(new RecordsImport(auth()->id()), storage_path('app/public/' . $filePath));

        // Save upload record
        $originalName = basename($fullPath);
        $upload = Upload::create([
            'user_id' => auth()->id(),
            'file_name' => $originalName,
            'file_path' => 'uploads/' . $upload->id . '_' . $originalName
        ]);

        // Move to permanent storage
        Storage::disk('public')->move($filePath, $upload->file_path);

        return redirect()->route('dashboard')->with('success', 'Excel file imported successfully! View at <a href="' . route('uploads.view', $upload) . '" class="underline">uploads/' . $upload->id . '</a>');
    }

    public function view(Upload $upload)
    {
        $this->authorize('view', $upload); // Policy or gate later

        if (auth()->id() !== $upload->user_id) {
            abort(403);
        }

        $filePath = storage_path('app/public/' . $upload->file_path);
        if (!file_exists($filePath)) {
            abort(404);
        }

        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray(null, true, true, true);
            $headers = array_keys($data[1] ?? $data[0] ?? []);
            $previewData = array_slice($data, 0); // All rows - no limits
        } catch (\Exception $e) {
            return back()->with('error', 'Cannot read Excel file: ' . $e->getMessage());
        }

        return view('uploads.view', compact('upload', 'data', 'headers', 'previewData'));
    }
}

