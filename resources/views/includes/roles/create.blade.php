<div class="modal fade" id="role" tabindex="-1" role="dialog" aria-labelledby="role" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent pb-1">
                        <div class="bigTitle text-center mt-2 mb-3">Role Creation</div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" action="{{route('roles.store')}}" method="post">
                          {{csrf_field()}}
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-fat-add"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Role's name" type="text" name="name">
                                </div>
                                @if($errors->has('name'))
                                    <small class="text-danger">
                                    {{$errors->first('name')}}
                                    </small>
                                @endif
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">Create</button>
                            </div>
                        </form>
                    </div>
             </div>
         </div>
     </div>
  </div>   
