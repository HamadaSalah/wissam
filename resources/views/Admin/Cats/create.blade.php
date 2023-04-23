@extends('Admin.master')
@section('content')
<h2 style="padding-bottom: 35px;float: left;">اضافة قسم جديد </h2>

<div class="clearfix"></div>

<form method="POST" action="{{route('admin.categories.store')}}" enctype="multipart/form-data">
    @csrf
    
  <div class="form-group">
    <label for="img">الاسم</label>
    <input type="text" class="form-control" name="name"  placeholder="الاسم..">
</div>
<div class="form-group">
  <label for="role">اختر القسم الرئيسي</label>
  <select class="form-control" id="role" name="category" >
    <option value="">قسم رئيسي</option>
      @foreach ($cats as $cat)
          <option value="{{$cat->id}}">{{$cat->name}}</option>
      @endforeach
  </select>
</div>
<div class="form-group">
  <label for="img">صورة</label>
  <input type="file" class="form-control" name="img" >
</div>


 
<button type="submit" class="btn btn-primary">حفظ</button>
  </form>

@push("custom-css")

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

@endpush
@endsection
