@extends('layouts.app')

@section('content')
    
    <div class="main-content">
    
            <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
@include('includes.banner',['title'=>'Our Articles'])
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Articles</h3>
                        </div>
                        <div class="col-4 text-right">
                        <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#article">Add an article</button>                           
                        @include('includes.articles.create',['departments'=>$departments,
                            'categories'=>$categories,
                            'users'=>$users
                        ])
                    </div>
                </div>
                
                <div class="col-12">
                                        </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Brand image</th>
                                <th scope="col">Category</th>  
                                <th scope="col">Departement</th>   
                                <th scope="col">Pdf</th> 
                                <th scope="col">Actions</th>                           
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                            <tr>
                                    <td><a href="{{route('articles.show',$article->id)}}">{{$article->title}}</a></td>
                                    <td><a href="{{route('user.show',$article->user()->first()->id)}}">{{$article->user()->first()->name}}</a></td>
                                    <td><a href="{{route('articles.show',$article->id)}}"><img width=100 height=60 src="{{asset('/storage/'.$article->picture)}}" alt="Image d'article"></a></td>
                                    <td>@if($article->category!=null)
                                        <a href="{{route('categories.show',$article->category->id)}}">{{$article->category->name}}</a>
                                        @else
                                            Not categorized
                                        @endif
                                    </td>
                                    <td>{{$article->department->first()->name}}</td>
                                    <td><a class="btn btn-success" href="{{route('article.download',$article->id)}}">DOWNLOAD</a></td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow text-center">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#articleEdit{{$article->id}}">Edit</button>                           
                                                 <a class="btn btn-info " href="{{route('article.html_editor',$article->id)}}">HTML Editor</a>
                                                 <form method="post" action="{{route('articles.destroy',$article->id)}}" class="form_delete">
                                                   {{method_field('delete')}}
                                                   {{csrf_field()}}
                                                   <button class="btn btn-danger" type="submit" >Delete</button>
                                                 </form>
                                            </div>
                                            @include('includes.articles.edit_part',['article'=>$article,'users'=>$users,'categories'=>$categories,'departments'=>$departments])
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





