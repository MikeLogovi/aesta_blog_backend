<div class="container-fluid">
@if (Session::has('Message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Success!</strong>&nbsp;{{ Session::get('Message') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    <div class="alert alert-danger" role="alert">
        <strong>{{strtoupper($title)}}</strong>
        @if ($errors->any())
        <div class="text-center errors_messages">
                Des erreurs sont survenus lors de la soumission du formulaire!
            </div>
        @endif
    </div>
  
</div>