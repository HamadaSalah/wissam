@extends('Admin.master')
@section('content')
<h2 style="padding-bottom: 35px;float: left;">اضافة محتوي للاقسام </h2>

<div class="clearfix"></div>

<form method="POST" action="{{route('admin.news.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="role">اختر البرنامج</label>
        <select class="form-control" id="role" required name="news_category_id" required>
            @foreach ($cats as $cat)
                <option value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="head">الاسم</label>
        <input type="text" class="form-control" id="head" name="head">
    </div>
    <div class="form-group">
        <label for="img">  الصورة (اختياري)</label>
        <input type="file" class="form-control" id="img" name="img">
    </div>
     
    <div class="form-group">
        <label for="video">الفيديو (اختياري) </label>
        <input type="file" class="form-control" id="video" name="video">
    </div>
    <div class="form-group">
        <label for="body">التفاصيل</label>
        <textarea type="text" class="form-control mb-3" id="body" name="body" ></textarea>
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
