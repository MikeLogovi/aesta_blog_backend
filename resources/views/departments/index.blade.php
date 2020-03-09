@extends('layouts.app')

@section('content')
    
    <div class="main-content">
    
            <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
@include('includes.banner',['title'=>'Our Departments'])
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Departements</h3>
                        </div>
                        <div class="col-4 text-right">
                        <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#department">Add department</button>                           
                       @include('includes.departments.create')
                       </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                                        </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Picture</th>
                                <th scope="col">Updated at</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($departments as $department)
                              <tr>
                                    <td>{{$department->name}}</td>
                                    <td>
                                        <a href="{{asset('/storage/'.$department->picture)}}"><img width=100 height=60 src="{{asset('/storage/'.$department->picture)}}" alt="{{$department->name}}'s picture"/></a>
                                    </td>
                                    <td>{{$department->updated_at}}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="text-center dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#departmentEdit{{$department->id}}">Edit</button>                           
 
                                                   <form method="post" action="{{route('departments.destroy',$department->id)}}" class="form_delete">
                                                    {{method_field('delete')}}
                                                    {{csrf_field()}}
                                                   <button class="btn btn-danger" type="submit" >Delete</button>
                                                 </form>
                                            </div>
                                            @include('includes.departments.edit',['department'=>$department])
                                        </div>
                                    </td>
                                </tr>
                           @endforeach
                           </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        
                    </nav>
                </div>
            </div>
        </div>
    </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush





