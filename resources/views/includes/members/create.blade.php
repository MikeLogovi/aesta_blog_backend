<div class="modal fade" id="member" tabindex="-1" role="dialog" aria-labelledby="member" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent pb-1">
                        <div class="bigTitle text-center mt-2 mb-3">New member registration</div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form">
                          
                        <div class="form-group">
                            <label for="fullname" class="form-control-label">Full name</label>
                            <input class="form-control" type="text" value="John Snow" id="fullname" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input class="form-control" type="email" value="member@gmail.com" id="email" name="email">
                        </div>
                        
                        <div class="form-group">
                            <label for="userId">Role</label>
                            <div class="form-group">
                                <label for="roles">Administrator</label>
                                <input type="checkbox"  id="roles" name="roles[]">
                            </div>
                            <div class="form-group">
                                <label  for="roles">Moderator</label>
                                <input type="checkbox"  id="roles" name="roles[]">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="customFileLang">Profile picture</label>
                            <input type="file" class="form-control" id="customFileLang" lang="en" name="picture">
                        </div>
   
                            <div class="text-center">
                                <button type="button" class="btn btn-primary my-4">Create</button>
                            </div>
                        </form>
                    </div>
             </div>
         </div>
     </div>
  </div>   
