<div class="modal fade" id="article" tabindex="-1" role="dialog" aria-labelledby="article" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent pb-1">
                        <div class="bigTitle text-center mt-2 mb-3">Article Creation</div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" enctype="multipart/form-data" method="post" action="{{route('articles.store')}}">
                          {{csrf_field()}}
                        <div class="form-group">
                            <label for="title" class="form-control-label">Title</label>
                            <input class="form-control" type="text" value="John Snow" id="title" name="title">
                            @if($errors->has('title'))
                                    <small class="text-danger">
                                    {{$errors->first('title')}}
                                    </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="userId">Author</label>
                            <select class="form-control" id="userId" name="userId">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('userId'))
                                    <small class="text-danger">
                                    {{$errors->first('userId')}}
                                    </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="departmentId">Department</label>
                            <select class="form-control" id="departmentId" name="departmentId">
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('departementId'))
                                    <small class="text-danger">
                                    {{$errors->first('departementId')}}
                                    </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="departmentId">Category</label>
                            <select class="form-control" id="categoryId" name="categoryId">
                            <option value="" selected></option>

                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" >{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="departmentId">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                            @if($errors->has('description'))
                                    <small class="text-danger">
                                    {{$errors->first('description')}}
                                    </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="customFileLang">PDF file</label>
                            <input disabled type="file" class="form-control" id="customFileLang" lang="en" name="pdf">
                            @if($errors->has('pdf'))
                                    <small class="text-danger">
                                    {{$errors->first('pdf')}}
                                    </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="customFileLang">PDF file link </label>
                            <input  type="text" class="form-control" name="pdf_link">
                            @if($errors->has('pdf_link'))
                                    <small class="text-danger">
                                    {{$errors->first('pdf_link')}}
                                    </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="customFileLang">Brand image file</label>
                            <input disabled type="file" class="form-control" id="customFileLang" lang="en" name="picture">
                            @if($errors->has('picture'))
                                    <small class="text-danger">
                                    {{$errors->first('picture')}}
                                    </small>
                             @endif
                        </div>
                        <div class="form-group">
                            <label for="customFileLang">Brand image file link</label>
                            <input  type="text" class="form-control" id="customFileLang" lang="en" name="picture_link">
                            @if($errors->has('picture_link'))
                                    <small class="text-danger">
                                    {{$errors->first('picture_link')}}
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
