@extends('layouts.app')

@section('content')
    
    <div class="main-content">
    
            <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
@include('includes.banner',['title'=>'Our Members'])
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Members</h3>
                        </div>
                        <div class="col-4 text-right">
                        <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#member">Add a member</button>                           
                            @include('includes.members.create')
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
                                <th scope="col">Email</th>
                                <th scope="col">Picure</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($users as $user)
                             <tr>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                                    </td>
                                    <td>
                                       @if($user->picture!=null || $user->picture_link!=null)
                                          <a href="@if($user->picture){{asset('/storage/'.$user->picture)}} @else {{$user->picture_link}} @endif"><img width=100 height=60 src="@if($user->picture){{asset('/storage/'.$user->picture)}} @else {{$user->picture_link}} @endif" alt="image de l'utilisateur"/></a>
                                       @else
                                       <a href="{{ asset('argon') }}/img/theme/team-4-800x800.jpg"><img width=100 height=60 src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg" alt="image de l'utilisateur"/></a>

                                       
                                       @endif
                                    </td>
                                    <td>
                                        @foreach($user->roles as $role)
                                           <span style="color:red">{{$role->name}}</span>
                                           @if(!$loop->last)
                                                |
                                           @endif
                                        @endforeach
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow text-center">
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#memberRoles{{$user->id}}">Grant Roles</button>                           
                                                 <form method="post" action="{{route('user.destroy',$user->id)}}" class="form_delete">
                                                   {{method_field('delete')}}
                                                   {{csrf_field()}}
                                                   <button class="btn btn-danger" type="submit" >Delete</button>
                                                 </form>
                                            </div>
                                            @include('includes.members.grant_roles',['user'=>$user,'roles'=>$roles])
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





