<div class="modal fade" id="member" tabindex="-1" role="dialog" aria-labelledby="member" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent pb-1">
                        <div class="bigTitle text-center mt-2 mb-3">New member registration</div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                      
                        <form role="form" enctype="multipart/form-data" method="post" action="{{route('user.store')}}">
                          {{csrf_field()}}
                        <div class="form-group">
                            <label for="fullname" class="form-control-label">Full name</label>
                            <input class="form-control" type="text" value="John Snow" id="fullname" name="name">
                        </div>
                        @if($errors->has('name'))
                                    <small class="text-danger">
                                    {{$errors->first('name')}}
                                    </small>
                        @endif
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input class="form-control" type="email" value="member@gmail.com" id="email" name="email">
                        </div>
                        @if($errors->has('email'))
                                    <small class="text-danger">
                                    {{$errors->first('email')}}
                                    </small>
                        @endif
                        <div class="form-group">
                                <label for="userId">Role</label>
                           <div class="row">
                              
                                  <?php $i=0; ?>
                                
                                @foreach($roles as $role)
                                      <?php $i++; ?>
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <label for="roles">{{strtoupper($role->name)}}</label>
                                            <input type="checkbox" value="{{$role->name}}" id="roles" name="roles[]">
                                        </div>
                                    </div>
                                    <?php if($i%3==0):?>
                                        <div class="clearfix"></div>
                                    <?php endif; ?>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="customFileLang">Profile picture</label>
                            <input disabled type="file" class="form-control" id="customFileLang" lang="en" name="picture">
                        </div>
                        @if($errors->has('picture'))
                                    <small class="text-danger">
                                    {{$errors->first('picture')}}
                                    </small>
                        @endif
                        <div class="form-group">
                            <label for="customFileLang">Profile picture link </label>
                            <input  type="text" class="form-control" id="customFileLang" lang="en" name="picture_link">
                        </div>
                        @if($errors->has('picture_link'))
                                    <small class="text-danger">
                                    {{$errors->first('picture_link')}}
                                    </small>
                        @endif
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">Create</button>
                            </div>
                        </form>
                    </div>
             </div>
         </div>
     </div>
  </div>   
