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
        <table class="table user-table no-wrap" id="myDTable">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">الاسم</th>
                    <th class="border-top-0">الاجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cats as $key =>  $cat)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$cat->name}}</td>
                    <td>
                        <a data-toggle="modal" id="smallButton" data-target="#smallModal" data-attr="{{ route('admin.categories.destroy', $cat->id) }}" title="Delete Project">
                            <i class="fas fa-trash text-danger  fa-lg"></i>
                        </a>
        
                        {{-- <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> حذف</button> --}}
                        {{-- <form style="display: inline;" action="{{route('admin.categories.destroy', $cat->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                        </form> --}}
                        {{-- <a href="{{Route('admin.cats.edit', $cat->id)}} ">
                            <button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</button>
                        </a> --}}

                    </td>

                </tr>

                @endforeach
            </tbody>
        </table>
    </div>

    @else
        <div class="text-center">No Data Available</div> 
    @endif
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
@endsection
