@extends('layouts.app')

@section('content')
    
    <div class="main-content">
    
            <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
@include('includes.banner',['title'=>'Write article content'])
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{$article->department->first()->name}}/@if($article->category!=null)<a href="route('categories.show',$article->category->id)">{{$article->category->name}}</a>/@endif {{$article->title}}</h3>
                        </div>  
                    </div>          
                </div>
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <h3 class="mb-0">Description</h3>
                        </div>  
                        <p>
                           {!!$article->description!!}
                        </p>
                    </div>          
                </div>
                <hr/>
                <div class="col-12">
                    <div id="editorjs">
                        
                    </div>
                    <input type="hidden" id="article" value="{{$article->id}}"/>
                    <button class="btn btn-success" id="save">Save article</button>
                    <button class="btn btn-success" id="refresh">refresh</button>

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
       <script src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>
    <script src="/js/app.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

@endpush





