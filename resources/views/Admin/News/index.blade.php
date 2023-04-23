@extends('Admin.master')
@section('content')
<h2 style="padding-bottom: 35px;float: left;margin-top: 0">محتوى الاقسام</h2>
<a href="{{route('admin.news.create')}}">  
    <button class="btn btn-primary" style="float: right"><i class="fa fa-plus"> </i>  اضافة</button>
</a>
<div class="filtt" style="width: 50%;float: left;">
    <form method="GET" enctype="multipart/form-data">
        <select class="form-control" id="role" name="category"   style="width: 80%;float: right"> 
            <option value="">كل الاقسام</option>
            @foreach ($cats as $cat)
                <option value="{{$cat->id}}"<?php if(request()->query('category') == $cat->id) echo "selected"; ?> >{{$cat->name}}</option>
            @endforeach
        </select>
        <button class="btn btn-primary" type="submit" style="float: right">فلترة</button>
    </form>
</div>
<div class="clearfix"></div>
<div class="clear"></div>
    @if ($videos->count() > 0)
    <div class="table-responsive">
        <table class="table user-table no-wrap" id="myDTable">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">البرنامج</th>
                    <th class="border-top-0">اسم القسم</th>
                    <th class="border-top-0">الصورة</th>
                    <th class="border-top-0">اجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videos as $video)
                <tr>
                    <td>{{$video->id}}</td>
                    <td style="">
                        {{$video->head}}
                    </td>
                    <td style="">
                        {{$video->category->name}}
                    </td>
                    <td>
                        <a data-fancybox="gallery" href="{{asset($video->img)}}"> <img src="{{asset($video->img)}}" style="width: 50px;height: 50px;" class="img-thumbnail" alt=""></a>
                    </td>
                    <td>
                        {{-- <form style="display: inline;" action="{{route('admin.video.destroy', $video->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Delete</button>
                        </form> --}}
                        <button class="btn btn-danger delete-btn" data-id="{{ $video->id }}" data-toggle="modal" data-target="#deleteModal">حذف</button>
                        <a  style="margin-left: 20px;cursor: pointer;" href="{{route('admin.news.edit', $video->id)}}"> <button class="btn btn-success" >تعديل</button></a>
                        {{-- <a  style="margin-left: 20px;cursor: pointer;" href="{{route('admin.news.edit', $video->id)}}">
                            <i class="fas fa-edit text-danger  fa-lg"></i>
                        </a> --}}
                    </td>

                </tr>

                @endforeach
            </tbody>
        </table>
    </div>

    @else
        <div class="text-center">لا يوجد فيديوهات</div> 
    @endif
    @if (isset($videos))
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">تاكيد الحذف </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              هل تريد الحذف
            </div>
            <div class="modal-footer">
              <form action="{{ route('admin.newdel') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="deleteItemId" value="">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">لا</button>
                <button type="submit" class="btn btn-danger">نعم</button>
              </form>
            </div>
          </div>
        </div>
      </div>

@endif
@push('custom-scripts')
    <script>
        $(document).on('click', '.delete-btn', function() {
        var itemId = $(this).data('id');
        $('#deleteItemId').val(itemId);
        $('#deleteModal').modal('show');
        });

    </script>
@endpush
@endsection
