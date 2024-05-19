@extends('layouts.app')
@section('title','บทความทั้งหมด')

@section('content')
    @if (count($blogs)>0)
    <h2 class="text text-center py-2">บทความทั้งหมด</h2>
    <table class="table table-bordered text-center">
        <thead class="table-secondary">
          <tr>
            <th scope="col">ชื่อบทความ</th>
            <th scope="col">เนื้อหา</th>
            <th scope="col">สถานะ</th> 
            <th scope="col">แก้ไขบทความ</th>   
            <th scope="col">ลบบทความ</th>        
          </tr>
        </thead>
        <tbody>
         {{--  @foreach ($blog as $item)
                <tr>
                    <td>{{$item["title"]}}</td>
                    <td>{{$item["content"]}}</td>
                    <td>
                        @if ($item["status"]==true)
                        <a href="#" class="btn btn-success">เผยแพร่</a>
                        @else
                        <a href="#" class="btn btn-warning">ฉบับร่าง</a>
                        @endif
                    </td>
                </tr>
            @endforeach --}}
    
            @foreach ($blogs as $item)
                <tr>
                    <td>{{$item->title}}</td>
                    <td>{{Str::limit($item->content,50)}}</td>
                    <td>
                        @if ($item->status==true)
                        <a href="{{route('change',$item->id)}}" class="btn btn-success">เผยแพร่</a>
                        @else
                        <a href="{{route('change',$item->id)}}" class="btn btn-warning">ฉบับร่าง</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('edit',$item->id)}}" class="btn btn-info">แก้ไข</a>
                    </td>
                    <td>
                        <a 
                        href="{{route('delete',$item->id)}}" 
                        class="btn btn-danger" 
                        onclick="return confirm('คุณต้องการลบบทความ {{$item->title}} หรือไม่ ?')">
                            ลบ
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$blogs->links()}}
    @else
        <h2 class="text text-center py-2">ขณะนี้ไม่มีบทความในระบบค่ะ</h2>
    @endif
@endsection


