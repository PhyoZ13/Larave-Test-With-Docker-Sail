<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataStoreRequest;
use App\Http\Requests\DataUpdateRequest;
use App\Models\Data;

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
}
