@extends('Admin.master')
@section('content')
<h2 style="padding-bottom: 35px;float: left;margin-top: 0">كل الاقسام</h2>
<a href="{{route('admin.categories.create')}}">  
    <button class="btn btn-primary" style="float: right"><i class="fa fa-plus"> </i> قسم جديد</button>
</a>
<div class="clearfix"></div>
<div class="clear"></div>
    @if ($cats->count() > 0)
    <div class="table-responsive">
        <table class="table user-table no-wrap" id="myDTable" dir="rtl">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">الاسم</th>
                    <th class="border-top-0">الصورة</th>
                    <th class="border-top-0">الاجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cats as $key =>  $cat)
                <tr>
                    <td>{{$key+1}}</td>
                    <td> <span style="background: green;color: #FFF;padding: 1px 5px;border-radius: 5px;margin-bottom: 10px;display: inline-block"> {{$cat->name}}</span>
                    @if ($cat->categories->count() > 0)<br/>
                        <span style="margin-bottom: 10px;display: block">الاقسام الداخلية</span>
                        @foreach ($cat->categories as $item)
                        <a href="{{Route('admin.categories.edit', $item->id)}} "><li style="list-style: none;
                            direction: rtl;
                            background: yellow;
                            color: #000;
                            padding: 1px 5px;
                            border-radius: 5px;
                            margin-bottom: 10px;
                            width: fit-content;
                            text-align: center;
                            margin: auto;
                            margin-bottom: 10px;
                            display: initial;
                            margin-bottom: 20px;
                            cursor: pointer;
                            "> - {{$item->name}}</li></a>
                            <i class="fa fa-trash delete-btn"   data-id="{{ $item->id }}" data-toggle="modal" data-target="#deleteModal" style="color: red;cursor: pointer;"></i>
                            <div class="clearfix" style="margin-bottom: 20px"></div>
                        @endforeach
                    @endif
                    </td>
                    <td>
                        @if ($cat->img)

                        <a data-fancybox="gallery" href="{{asset($cat->img)}}"> <img src="{{asset($cat->img)}}" style="width: 100px;height: 100px;" class="img-thumbnail" alt=""></a>    
                        @else
                        لا يوجد
                        @endif
                    </td>
                    <td>
                        {{-- <a data-toggle="modal" id="smallButton" data-target="#smallModal" data-attr="{{ route('admin.categories.destroy', $cat->id) }}" title="Delete Project">
                            <i class="fas fa-trash text-danger  fa-lg"></i>
                        </a>
         --}}
                        {{-- <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> حذف</button> --}}
                        {{-- <form style="display: inline;" action="{{route('admin.categories.destroy', $cat->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                        </form> --}}
                         {{-- <a style="font-size: 20px;margin-right: 10px" href="{{Route('admin.categories.edit', $cat->id)}} ">
                             <i class="fa fa-pencil-square-o"></i>   
                        </a>   --}}
                        <a style="font-size: 20px;margin-right: 10px" href="{{Route('admin.categories.edit', $cat->id)}} ">
                            <button class="btn btn-primary  "  >تعديل</button>
                       </a>  

                        <button class="btn btn-danger delete-btn" data-id="{{ $cat->id }}" data-toggle="modal" data-target="#deleteModal">حذف</button>

                    </td>

                </tr>

                @endforeach
            </tbody>
        </table>
    </div>

    @else
        <div class="text-center">No Data Available</div> 
    @endif
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              هل تريد الحذف
            </div>
            <div class="modal-footer">
              <form action="{{ route('admin.catdel') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="deleteItemId" value="">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">لا</button>
                <button type="submit" class="btn btn-danger">نعم</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      
    @if (isset($cat))
    <!-- small modal -->
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
                            <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="post">
                                <div class="modal-body">
                                    @csrf
                                    @method('DELETE')
                                    <h5 class="text-center"> {{ $cat->name }} هل تريد حذف قسم ?</h5>
                                </div>
                                <button type="button" class="btn btn-secondary" style="width: 100%;margin-bottom: 20px" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger" style="width: 100%;margin-bottom: 20px" >Yes, Delete Project</button>
                                <div class="modal-footer">
                                </div>
                            </form>
                        </div>
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
