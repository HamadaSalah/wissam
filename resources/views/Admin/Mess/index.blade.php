@extends('Admin.master')
@section('content')
<a href="{{route('admin.mess.create')}}">
    <button class="btn btn-primary mb-4">اضافة مستخدم جديد</button>
</a>
<div class="table-responsive">
    <table class="table user-table no-wrap">
        <thead>
            <tr>
                <th class="border-top-0">#</th>
                <th class="border-top-0"> الاسم</th>
                <th class="border-top-0">اجراء</th>
            </tr>
        </thead>
        <tbody>
             @foreach ($chats as $chat)
            <tr>
                <td>{{$chat->id}}</td>
                <td>{{$chat->user->name ?? $chat->user->email}}</td>
                <td>
                    {{-- <form action="{{route('admin.mess.destroy', $chat->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">مسح</button>

                    </form> --}}
                    <a href="{{Route('admin.mess.show', $chat->id)}}">
                        <button class="btn btn-success">عرض الرسائل</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
 </div>
@endsection
