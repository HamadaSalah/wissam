@extends('Admin.master')
@section('content')
<h2 style="padding-bottom: 35px;float: left;">تعديل محتوي للاقسام </h2>

<div class="clearfix"></div>

<form method="POST" action="{{route('admin.news.update', $news->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <div class="form-group">
            <label for="role">اختر البرنامج</label>
            <select class="form-control" id="role" required name="news_category_id" required>
                @foreach ($cats as $cat)
                    <option value="{{$cat->id}}" <?php if($cat->id == $news->category->id) echo 'selected'; ?>>{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="head">الاسم</label>
        <input type="text" class="form-control" id="head" name="head" value="{{$news->head}}"> 
    </div>
    <div class="form-group">
        <img src="{{asset($news->img)}}" alt="" style="width: 100px;height: 100px;display: block;margin-bottom: 20px;border-radius: 5px">

        <label for="img">  الصورة (اختياري)</label>
        <input type="file" class="form-control" id="img" name="img">
    </div>
    <div class="form-group">
        <video width="150" height="150" controls>
            <source src="{{asset($news->video)}}">
          </video>
          <div class="clearfix"></div>
          <label for="video">الفيديو (اختياري) </label>
        <input type="file" class="form-control" id="video" name="video">
    </div>
    <div class="form-group">
        <label for="body">التفاصيل</label>
        <textarea type="text" class="form-control mb-3" id="body" name="body" >{!! $news->body!!}</textarea>
        <script type="text/javascript">
            CKEDITOR.replace("body",{ language: 'ar' });
        </script>
    </div>

    <button type="submit" class="btn btn-primary">حفظ</button>
  </form>
@push('styles')
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>

@endpush
 @endsection
