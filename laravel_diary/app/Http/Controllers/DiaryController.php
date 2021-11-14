<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Diary;

use App\Http\Requests\DiaryRequest;

class DiaryController extends Controller
{
    // 日記一覧画面
    public function index() {
        // Diaryモデルを利用して一覧を取得
        $diaries = Diary::all();
        
        return view('diaries.index',[
           'title'   => '日記一覧',
           'diaries' => $diaries,
        ]);
    }
    
    // 日記追加画面
    public function create() {
        return view('diaries.diaries_create',[
           'title' => '日記追加画面' 
        ]);
    }
    
    public function store(DiaryRequest $request) {
        // Diaryモデルを利用して空のDiaryオブジェクトを作成

        // フォームから送られた値でtitleとlogを設定
        $diary = Diary::create([
            'title' => $request->title,
            'log' => $request->log,
        ]);
        
        // flashメッセージの設定
        session()->flash('success', '日記を追加しました。');
        
        // 日記一覧ページにリダイレクト
        return redirect('/diaries');
    }

    // 日記編集画面
    public function edit($id) {
        $diary = Diary::find($id);
        return view('diaries.diaries_edit',[
           'title' => '日記編集画面',
           'diary' => $diary,
        ]);
    }

    // 日記編集画面（記事をアップデートする）
    public function update(DiaryRequest $request, $id) {
        
        $diary = Diary::find($id);
        $diary->update($request->only(['title', 'log']));
        
        // flashメッセージの設定
        session()->flash('success', '日記を更新しました。');

        // 日記一覧ページにリダイレクト
        return redirect('/diaries');
    }
    
    // 日記削除機能
    public function destroy($id) {
        $diary = Diary::find($id);
        $diary->delete();
        
        // flashメッセージの設定
        session()->flash('delete', '日記を削除しました。');
        
        // 日記一覧ページにリダイレクト
        return redirect('/diaries');
    }    
}
