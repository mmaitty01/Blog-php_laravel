<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;   

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        $blogs=Blog::paginate(5);

        //$blogs=DB::table('blogs')->paginate(5);

    /*    $blog=[
            [
                'title'=>"บทความที่ 1",
                'content'=>"เนื้อหาบทความที่ 1",
                'status'=>true
            ],
            [
                'title'=>"บทความที่ 2",
                'content'=>"เนื้อหาบทความที่ 2",
                'status'=>true
            ],
            [
                'title'=>"บทความที่ 3",
                'content'=>"เนื้อหาบทความที่ 3",
                'status'=>false
            ],
            [
                'title'=>"บทความที่ 4",
                'content'=>"เนื้อหาบทความที่ 4",
                'status'=>true
            ],
            [
                'title'=>"บทความที่ 5",
                'content'=>"เนื้อหาบทความที่ 5",
                'status'=>false
            ]
        ]; */
        return view('blog',compact('blogs'));

    }
    function about(){
        $name = 'ฉันรักโค้ด';
        $date = '16 พฤษภาคม 2567';
        return view('about',compact('name','date'));
    }
    function create(){
        return view('form');
    }

    function insert(request $request){
        $request->validate(
            [
            'title'=>'required|max:50', //required คือ ห้ามเป็นค่าว่าง max คือไม่เกิน 50 ตัวอักษร
            'content'=>'required'
            ],
            [
                'title.required'=>'กรุณาป้อนชื่อบทความของคุณ',
                'title.max'=> 'ชื่อบทความไม่ควรเกิน 50 ตัวอักษร',
                'content.required'=>'กรุณาป้อนเนื้อหาบทความของคุณ'
            ]
        );
        $data=[
            'title'=>$request->title,
            'content'=>$request->content
        ];
        //DB::table('blogs')->insert($data);
        Blog::insert($data);
        return redirect('/author/blog'); 
    }
    function delete($id){
       //DB::table('blogs')->where('id',$id)->delete();
       Blog::find($id)->delete();
       //return redirect('/blog'); หากลบข้อมูลแล้วจะกลับมาหน้าแรก
       return redirect()->back();//หากลบบทความแล้วยังอยู่หน้าเดิม    
    }
    function change($id){
        //$blog = DB::table('blogs')->where('id',$id)->first();
        $blog=Blog::find($id);
        $data=[
            'status'=>!$blog->status
        ];
        //$blog = DB::table('blogs')->where('id',$id)->update($data);
        $blog=Blog::find($id)->update($data);
        return redirect()->back();
            
    }
    function edit($id){
        //$blog = DB::table('blogs')->where('id',$id)->first();
        $blog=Blog::find($id);
        return view('edit',compact('blog'));
    }

    function update(request $request,$id){
        $request->validate(
            [
            'title'=>'required|max:50', //required คือ ห้ามเป็นค่าว่าง max คือไม่เกิน 50 ตัวอักษร
            'content'=>'required'
            ],
            [
                'title.required'=>'กรุณาป้อนชื่อบทความของคุณ',
                'title.max'=> 'ชื่อบทความไม่ควรเกิน 50 ตัวอักษร',
                'content.required'=>'กรุณาป้อนเนื้อหาบทความของคุณ'
            ]
        );
        $data=[
            'title'=>$request->title,
            'content'=>$request->content
        ];
       // DB::table('blogs')->where('id',$id)->update($data);
        Blog::find($id)->update($data);
        return redirect('/author/blog'); 
    }
}
