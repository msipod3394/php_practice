{{--レイアウトファイルを指定--}}
@extends('layouts.default')

{{-- title --}}
@section('title', $title)

@section('contents')
    <h1>{{ $title }}</h1>
    <a href="/diaries">一覧に戻る</a>
    <form action="{{ '/diaries/' . $diary->id }}" method="post">
        {{-- 偽のフォームでないことを証明するためのcsrfトクーンを埋め込み --}}
          @csrf
          @method('PATCH')
        <div>
            <label>タイトル:</label>
            <input type="text" name="title" value="{{ $diary->title }}">
        </div>
        <div>
            <textarea name="log" class="diary_title" value="" cols="30" rows="10">{{ $diary->log }}</textarea>
        </div>
        <input type="submit" value="保存">
    </form>
@endsection