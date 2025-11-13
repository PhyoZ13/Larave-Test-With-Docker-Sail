@extends('layouts.app')

@section('title', 'データ登録')

@section('content')
<div class="max-w-7xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">データ登録</h2>
    
    <div class="bg-white rounded-lg shadow p-6">
        <form id="registerForm" action="{{ route('data.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">タイトル</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">カテゴリ</label>
                <select name="category" id="category" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">選択してください</option>
                    <option value="カテゴリ１" {{ old('category') == 'カテゴリ１' ? 'selected' : '' }}>カテゴリ１</option>
                    <option value="カテゴリ２" {{ old('category') == 'カテゴリ２' ? 'selected' : '' }}>カテゴリ２</option>
                    <option value="カテゴリ３" {{ old('category') == 'カテゴリ３' ? 'selected' : '' }}>カテゴリ３</option>
                </select>
                @error('category')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">本文</label>
                <textarea name="content" id="content" rows="5" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end gap-3">
                <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    キャンセル
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    登録
                </button>
            </div>
        </form>
    </div>
</div>

<script>
setupFormConfirm('registerForm', 'データを登録します。よろしいですか？');
</script>
@endsection

