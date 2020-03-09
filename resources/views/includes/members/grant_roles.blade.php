<div class="modal fade" id="memberRoles{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="memberRoles{{$user->id}}" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent pb-1">
                        <div class="bigTitle text-center mt-2 mb-3">Grant Roles</div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                      
                        <form role="form" enctype="multipart/form-data" method="post" action="{{route('user.grant_roles',$user->id)}}">
                          {{csrf_field()}}
                         
                       
                       
                        <div class="form-group text-center">                                
                                @foreach($roles as $role)
                                        <div class="form-group">
                                            <label for="roles">{{strtoupper($role->name)}}</label>
                                            <input type="checkbox" value="{{$role->name}}" id="roles" name="roles[]">
                                        </div>
                                   
                                @endforeach
                            
                        </div>
                    
                            <div class="text-center">
                                <button type="submit" class="btn btn-success my-4">Grant Roles</button>
                            </div>
                        </form>
                    </div>
             </div>
         </div>
     </div>
  </div>   
