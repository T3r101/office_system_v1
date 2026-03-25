@extends('layouts.dashboard')

@section('title', 'Import Excel')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="text-center mb-12">
        <div class="inline-flex items-center px-6 py-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-3xl shadow-2xl mb-6">
            <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.586l-1.414-1.414a1 1 0 00-1.414 0L10.586 15H8a1 1 0 00-1 1v3a1 1 0 001 1z"></path>
            </svg>
            <div>
                <h1 class="text-3xl font-bold">Import Excel Data</h1>
                <p class="opacity-90">Upload your Excel or CSV file to analyze transactions</p>
            </div>
        </div>
    </div>

    @if(isset($previewData) && count($previewData) > 0)
        <!-- Preview Section -->
        <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl border border-white/50 p-8 mb-8">
            <div class="absolute inset-0 bg-gradient-to-r from-green-500 to-emerald-600 opacity-10 rounded-3xl -m-1"></div>
            <div class="relative z-10">
                    <div class="flex items-center justify-between mb-8 no-print">
                    <h2 class="text-2xl font-bold text-gray-900">Data Preview ({{ count($previewData) }} rows)</h2>
<div class="space-x-3">
                        <a href="{{ route('import.excel') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition-all font-medium">Change File</a>

<button onclick="window.print()" class="px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                </svg>
                                Print Preview
                            </button>
                    </div>

                    <style>
@media print {
                            @page { margin: 0.5in; size: letter; }
                            .no-print { visibility: hidden; }
                            table { width: 100%; font-size: 9pt; page-break-inside: auto; }
                            thead { display: table-header-group; }
                            tr { page-break-inside: avoid; page-break-after: auto; }
                            th, td { border: 1px solid #333 !important; padding: 6pt !important; }
                            body { -webkit-print-color-adjust: exact; }
                        }
                    </style>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
@if(isset($headers) && is_array($headers))
                                @foreach($headers as $header)
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">{{ $header }}</th>
                                @endforeach
                            @else
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date</th>
                            @endif
</tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
@foreach($previewData as $index => $row)
                                <tr class="hover:bg-gray-50 transition-colors @if($index % 2) bg-gray-25 @endif">
                                    @if(isset($headers) && is_array($headers))
                                        @foreach($row as $cell)
                                            <td class="px-6 py-4 text-sm text-gray-900 max-w-xs">
                                                {{ $cell ?? '' }}
                                            </td>
                                        @endforeach
                                    @else
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                            {{ $row[0] ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-semibold">
                                            ${{ number_format($row[1] ?? 0, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-900">
                                            {{ $row[2] ?? 'N/A' }}
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-800">
                                            ✓ Valid
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="font-medium text-blue-900">Data will be validated during import. Invalid rows will be skipped.</p>
                            <p class="text-sm text-blue-700">Expected format: name (string), amount (number), date (YYYY-MM-DD)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Upload Form -->
        <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl border border-white/50 p-12 max-w-2xl mx-auto">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-green-600 opacity-20 rounded-3xl -m-1"></div>
            <div class="relative z-10 text-center">
                <div class="w-24 h-24 bg-gradient-to-r from-green-400 to-emerald-500 rounded-3xl shadow-2xl mx-auto mb-8 flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.586l-1.414-1.414a1 1 0 00-1.414 0L10.586 15H8a1 1 0 00-1 1v3a1 1 0 001 1z"></path>
                    </svg>
                </div>

                <form method="POST" action="{{ route('import.preview') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label for="excel_file" class="block text-sm font-bold text-gray-700 mb-3">Choose Excel or CSV File</label>
<div class="relative">
                            <input type="file" name="excel_file" id="excel_file" accept=".xlsx,.xls,.xlsm,.csv,.ods,.tsv,.fods" required 
                                   class="w-full px-6 py-4 border-2 border-dashed border-gray-300 rounded-2xl text-gray-700 bg-white/50 backdrop-blur-sm hover:border-green-400 hover:bg-green-50 transition-all duration-300 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-gradient-to-r file:from-green-500 file:to-emerald-600 file:text-white shadow-lg hover:shadow-xl">
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-green-600 opacity-0 hover:opacity-5 rounded-2xl transition-opacity duration-300 pointer-events-none"></div>
                        </div>
                        @error('excel_file')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
XLSX, XLS, XLSM, CSV, ODS, TSV, FODS supported
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
Max 20MB
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Preview before import
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-6 px-8 rounded-2xl shadow-2xl hover:shadow-3xl transition-all duration-300 text-lg transform hover:-translate-y-1">
                        <span class="inline-flex items-center">
                            <svg class="w-6 h-6 mr-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            Upload & Preview Data
                        </span>
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection

