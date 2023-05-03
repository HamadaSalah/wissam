@extends('Admin.master')
@section('content')
<style>
    input, label, h2, button{
        text-align: right;
        float: right;
    }
</style>
<h2 >تعديل الاعدادات </h2>

<div class="clearfix"></div>

<form method="POST" action="{{route('admin.settings.update', $settings->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">البث المباشر</label>
        <input type="name" class="form-control" id="name" name="name"  required value="{{$settings->live}}">
    </div>
    <div class="form-group">
        <label for="role">حالة البث مباشر</label>
        <select class="form-control" id="role"   name="live_status" required>
            <option value="1" <?php if($settings->live_status == 1) echo 'selected';?>>فعَال</option>
            <option value="0" <?php if($settings->live_status == 0) echo 'selected';?>>متوقف</option>
        </select>
      </div>
      <div class="form-group">
        <label for="role">حالة اللايف شات</label>
        <select class="form-control" id="role" name="livechat_status" required>
            <option value="1" <?php if($settings->livechat_status == 1) echo 'selected';?>>فعَال</option>
            <option value="0" <?php if($settings->livechat_status == 0) echo 'selected';?>>متوقف</option>
        </select>
      </div>

      <button style="margin: 50px 0;width: 100%" type="submit" class="btn btn-primary">تعديل</button>
  </form>

@push("custom-css")

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

@endpush
@endsection
