<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataStoreRequest;
use App\Http\Requests\DataUpdateRequest;
use App\Models\Data;
use Illuminate\Http\Response;

class DataController extends Controller
{
    public function index()
    {
        $data = Data::orderBy('created_at', 'asc')->get();
        return view('data.index', compact('data'));
    }

    public function create()
    {
        return view('data.create');
    }

    public function store(DataStoreRequest $request)
    {
        Data::create($request->validated());

        return redirect()->route('dashboard')->with('success', 'データを登録しました。');
    }

    public function edit(Data $data)
    {
        return view('data.edit', compact('data'));
    }

    public function update(DataUpdateRequest $request, Data $data)
    {
        $data->update($request->validated());

        return redirect()->route('dashboard')->with('success', 'データを更新しました。');
    }

    public function destroy(Data $data)
    {
        $data->delete();

        return redirect()->route('dashboard')->with('success', 'データを削除しました。');
    }

    public function exportCsv()
    {
        $data = Data::orderBy('created_at', 'asc')->get();

        $filename = 'data_export_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header row
            fputcsv($file, ['タイトル', 'カテゴリ', '本文'], ',');
            
            // Data rows
            foreach ($data as $item) {
                // Escape double quotes in all fields by doubling them
                $escapedTitle = str_replace('"', '""', $item->title);
                $escapedCategory = str_replace('"', '""', $item->category);
                $escapedContent = str_replace('"', '""', $item->content);
                
                // Quote title and category if they contain commas, quotes, or newlines
                $quotedTitle = (strpos($escapedTitle, ',') !== false || strpos($escapedTitle, '"') !== false || strpos($escapedTitle, "\n") !== false) 
                    ? '"' . $escapedTitle . '"' 
                    : $escapedTitle;
                $quotedCategory = (strpos($escapedCategory, ',') !== false || strpos($escapedCategory, '"') !== false || strpos($escapedCategory, "\n") !== false) 
                    ? '"' . $escapedCategory . '"' 
                    : $escapedCategory;
                
                // Body is always quoted as per requirements
                $line = $quotedTitle . ',' . $quotedCategory . ',"' . $escapedContent . '"' . "\n";
                fwrite($file, $line);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
