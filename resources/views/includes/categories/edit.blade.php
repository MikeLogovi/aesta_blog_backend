<div class="modal fade" id="categoryEdit{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="categoryEdit{{$category->id}}" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent pb-1">
                        <div class="bigTitle text-center mt-2 mb-3">Category Update</div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="post" action="{{route('categories.update',$category->id)}}">
                          {{csrf_field()}}
                          {{method_field('put')}}
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-fat-add"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="{{$category->name}}" type="text" name="name">
                                </div>
                                @if($errors->has('name'))
                                    <small class="text-danger">
                                    {{$errors->first('name')}}
                                    </small>
                                @endif
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-success my-4">Update</button>
                            </div>
                        </form>
                    </div>
             </div>
         </div>
     </div>
  </div>   
