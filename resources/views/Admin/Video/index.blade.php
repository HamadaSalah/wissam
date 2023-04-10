@extends('Admin.master')
@section('content')
<h2 style="padding-bottom: 35px;float: left;margin-top: 0">الفيديوهات</h2>
<a href="{{route('admin.video.create')}}">  
    <button class="btn btn-primary" style="float: right"><i class="fa fa-plus"> </i>  اضافة</button>
</a>
<div class="clearfix"></div>
<div class="clear"></div>
    @if ($videos->count() > 0)
    <div class="table-responsive">
        <table class="table user-table no-wrap" id="myDTable">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">البرنامج</th>
                    <th class="border-top-0">اسم الحلقة</th>
                    <th class="border-top-0">الصورة</th>
                    <th class="border-top-0">اجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videos as $video)
                <tr>
                    <td>{{$video->id}}</td>
                    <td style="">
                        {{$video->program->name}}
                    </td>
                    <td style="">
                        {{$video->title}}
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
                        <a   style="cursor: pointer;" data-toggle="modal" id="smallButton" data-target="#smallModal" data-attr="{{ route('admin.video.destroy', $video->id) }}" title="Delete Project">
                            <i class="fas fa-trash text-danger  fa-lg"></i>
                        </a>
                        <a  style="margin-left: 20px;cursor: pointer;" href="{{route('admin.video.edit', $video->id)}}">
                            <i class="fas fa-edit text-danger  fa-lg"></i>
                        </a>
                    </td>

                </tr>

                @endforeach
            </tbody>
        </table>
    </div>

    @else
        <div class="text-center">لا يوجد فيديوهات</div> 
    @endif
    @if (isset($video))
        
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <form action="{{ route('admin.video.destroy', $video->id) }}" method="post">
                            <div class="modal-body">
                                @csrf
                                @method('DELETE')
                                <h5 class="text-center"> {{ $video->name }} هل تريد حذف برنامج ?</h5>
                            </div>
                            <button type="button" class="btn btn-secondary" style="width: 100%;margin-bottom: 20px" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger" style="width: 100%;margin-bottom: 20px" >نعم حذف</button>
                            <div class="modal-footer">
                            </div>
                        </form>
                                        </div>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection
