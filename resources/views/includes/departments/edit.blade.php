<div class="modal fade" id="departmentEdit{{$department->id}}" tabindex="-1" role="dialog" aria-labelledby="departmentEdit{{$department->id}}" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent pb-1">
                        <div class="bigTitle text-center mt-2 mb-3">Department Update</div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="post" enctype="multipart/form-data" action="{{route('departments.update',$department)}}">
                          {{csrf_field()}}
                          {{method_field('put')}}
                            <div class="form-group">
                                <label for="customFileLang">New Name</label>

                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-diamond"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="{{$department->name}}" type="text" name="name">
                                </div>
                                @if($errors->has('name'))
                                    <small class="text-danger">
                                    {{$errors->first('name')}}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="customFileLang">Brand image file</label>
                                <input type="file" class="form-control" id="customFileLang" lang="en" name="picture">
                            
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
