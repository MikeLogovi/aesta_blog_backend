@extends('layouts.app')

@section('content')
    
    <div class="main-content">
    
            <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
@include('includes.banner',['title'=>'Our Clients messages'])
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
                         {{$messagesNew->count()}} new messages
                       </div>
                       
                    </div>
                </div>
                
                <div class="col-12">
                                        </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Author name</th>
                                <th scope="col">Author email</th>
                                <th scope="col">Sent day</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                              <tr @if(!$message->read) style="background-color:#7CB342;color:white" @endif>
                                    <td>{{$message->name}}</td>
                                    <td>
                                        {{$message->email}} 
                                   </td>
                                    <td>{{$message->created_at}}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="text-center dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            
                                            <button type="button" onclick="makeRead({{$message->id}})" class="btn btn-info" data-toggle="modal" data-target="#message{{$message->id}}">Read</button>  
                                            <input type="hidden" value="{{$message->id}}"/>                         
 
                                                   <form method="post" action="{{route('messages.destroy',$message->id)}}" class="form_delete">
                                                    {{method_field('delete')}}
                                                    {{csrf_field()}}
                                                   <button class="btn btn-danger" type="submit" >Delete</button>
                                                 </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                            @include('includes.messages.read',['message'=>$message])
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
       <script src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>
    <script >
           function makeRead(id){
  $.ajax({
    url : '/api/messages/makeRead/'+id,
    type : 'get',
    dataType : 'html',
    success : function(code_html, statut){
      Swal.fire(
        'Good job!',
        'Your article has been edited successfully!',
        'success'
      )
    },
    error:function(code_html,statut){
        console.log('error')
    }          
 })
}

    </script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush





