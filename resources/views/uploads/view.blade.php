@extends('layouts.dashboard')

@section('title', $upload->file_name . ' - Excel Viewer')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $upload->file_name }}</h1>
                <p class="text-gray-600">Uploaded by {{ $upload->user->name ?? 'Unknown' }} • {{ $upload->created_at->format('M d, Y H:i') }}</p>
            </div>
<div class="flex space-x-3">
                <a href="{{ Storage::url($upload->file_path) }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transition-all" download>
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10l-5.5 5.5m0 0L7.5 18M7 17l-5.5-5.5M12 10l5.5 5.5m0 0L16.5 18M18.5 17L13 11.5"></path>
                    </svg>
                    Download
                </a>

                <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl font-medium transition-all">
                    Back to Dashboard
                </a>
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
    </div>

    @if(isset($previewData) && count($previewData) > 0)
        <div class="bg-white rounded-3xl shadow-2xl border border-gray-200 overflow-hidden">
            <div class="p-8 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                <div class="flex items-center justify-between no-print">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Excel Data Preview</h2>
                        <p class="text-gray-600 mt-1">{{ count($data) }} rows • {{ count($headers) }} columns - **Full Excel Content**</p>
                    </div>
                    <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Sheet 1</span>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            @foreach($headers as $header)
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider border-r border-gray-200">
                                    {{ $header }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($previewData as $rowIndex => $row)
                            <tr class="hover:bg-gray-50 transition-colors">
                                @foreach($headers as $colIndex => $header)
                                    <td class="px-6 py-4 text-sm text-gray-900 border-r border-gray-200 max-w-xs truncate">
                                        {{ $row[$colIndex] ?? '' }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="text-center py-20">
            <svg class="w-20 h-20 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No preview data</h3>
            <p class="text-gray-500 mb-6">Download the full file above.</p>
            <a href="{{ Storage::url($upload->file_path) }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium shadow-lg" download>
                Download {{ $upload->file_name }}
            </a>
        </div>
    @endif
</div>
@endsection

