{{--レイアウトファイルを指定--}}
@extends('layouts.default')

{{-- title --}}
@section('title', $title)

@section('contents')
    <h1>{{ $title }}</h1>
    
    <a href="/diaries">一覧に戻る</a>
    
    <form method="post">
        {{-- 偽のフォームでないことを証明するためのcsrfトクーンを埋め込み --}}
        @csrf
        <div>
            <label>タイトル:</label>
            <input type="text" name="title" class="diary_" value="" size="30" placeholder="日記のタイトルを入力">
        </div>
        <div>
            <textarea name="log" class="diary_title" cols="30" rows="10" placeholder="内容を入力"></textarea>
        </div>
        <input type="submit" value="保存">
    </form>
    
@endsection