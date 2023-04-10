@extends('Admin.master')
@section('content')
<h2 style="padding-bottom: 35px;float: left;">اضافة فيديو جديد </h2>

<div class="clearfix"></div>

<form method="POST" action="{{route('admin.video.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="role">اختر البرنامج</label>
        <select class="form-control" id="role" required name="program_id" required>
            @foreach ($programs as $program)
                <option value="{{$program->id}}">{{$program->name}}</option>
            @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="title">الاسم</label>
        <input type="text" class="form-control" id="title" name="title"   required >
    </div>
    <div class="form-group">
        <label for="img">الصورة</label>
        <input type="file" class="form-control" id="img" name="img"   required >
    </div>
     
    <div class="form-group">
        <label for="video">الفيديو</label>
        <input type="file" class="form-control" id="video" name="video"   required >
    </div>
     
    <button type="submit" class="btn btn-primary">حفظ</button>
  </form>

 @endsection
