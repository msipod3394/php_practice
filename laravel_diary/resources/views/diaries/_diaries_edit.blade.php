{{--レイアウトファイルを指定--}}
@extends('layouts.default')

{{-- title --}}
@section('title', $title)

@section('contents')
    <h1>{{ $title }}</h1>
    
    <a href="/diaries">一覧に戻る</a>
    
    <form action="{{ url('/diaries/' . $diary->id) }}" method="post">
        {{-- 偽のフォームでないことを証明するためのcsrfトクーンを埋め込み --}}
          @csrf
          @method('PATCH')
        <div>
            <label>タイトル:</label>
            <input type="text" name="title" class="diary_title" value="{{ $diary->title }}" size="30" placeholder="">
        </div>
        <div>
            <input type="text" name="log" class="diary_log" value="{{ $diary->log }}" size="60" placeholder="">
            <!--<textarea name="log" class="diary_title" value="{{ $diary->log }}" cols="30" rows="10"></textarea>-->
        </div>
        <input type="submit" value="保存">
    </form>    
    
@endsection