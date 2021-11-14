{{--レイアウトファイルを指定--}}
@extends('layouts.default')

{{-- title --}}
@section('title', $title)

@section('contents')
    <h1>{{ $title }}</h1>
 
    {{-- 成功メッセージを出力 --}}
    @if (session()->has('success'))
        <div class="success">
            {{ session()->get('success') }}
        </div>
    @endif

    {{-- 削除メッセージを出力 --}}
    @if (session()->has('delete'))
        <div class="delete">
            {{ session()->get('delete') }}
        </div>
    @endif
    
    <a href="/diaries/create" class="btn btn-primary">新規追加</a>
    
    {{-- 日記一覧 --}}
    <ul>
        @forelse($diaries as $diary)
            <li>
                <div class="list_title">{{$diary->created_at}} {{$diary->title}}: </div>
                <div class="list_log">{{$diary->log}}</div>
                <div class="list_function">
                <a href="{{ url('/diaries/' . $diary->id . '/edit') }}" class="btn btn-primary">編集</a>
                @method('DELETE')
                <form action="{{ url('/diaries/' . $diary->id) }}" method="post">
                    <input type="submit" value="削除" class="btn btn-danger">
                </form>
                </div>
            </li>
        @empty
            <li>投稿がありません</li>
        @endforelse
    </ul>
    
@endsection