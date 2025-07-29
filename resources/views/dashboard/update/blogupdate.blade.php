<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CelestialUI Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css">
    <link rel="stylesheet" href="{{ url('assets/css/typicons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link rel="shortcut icon" href="images/favicon.png" />
    <script src="https://cdn.tiny.cloud/1/2z7af7uf3230kkzbeprwgj1glhfdy7lxwghi9kb5kw3g4s0k/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

    <script>
      tinymce.init({
        selector: '#description',
        plugins: [
          'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
          { value: 'First.Name', title: 'First Name' },
          { value: 'Email', title: 'Email' },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
      });
    </script>
  </head>
  <body>
    
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-1 px-4 px-sm-5">
                <div class="card-body">
                    <h2 class="card-title py-3">Edit blog data</h2>

                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul class="mb-0">
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif

                    <form class="forms-sample" method="POST" action="{{ route('dashboard.blogupdate', $blog) }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                        <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" id="title" name="title" placeholder="Blog title" value="{{ old('title', $blog->title) }}">
                        </div>

                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea type="text" class="form-control" id="description" name="description" placeholder="Blog Description">{{ old('description', $blog->description) }}</textarea>
                        </div>

                        <div class="form-group">
                          <label for="category_id">Category</label>
                          <select class="form-control" id="category_id" name="category_id">
                            <option value="">Category</option>
                              @foreach($category as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $blog->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                              @endforeach
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="creator_id">Creator</label>
                          <select class="form-control" id="creator_id" name="creator_id"_id>
                            <option value="">Creator</option>
                              @foreach($user as $users)
                                <option value="{{ $users->id }}" {{ old('creator_id', $blog->creator_id) == $users->id ? 'selected' : '' }}>{{ $users->name }}</option>
                              @endforeach
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="image">User Pic</label>
                          <input type="file" class="form-control" accept="image/*" id="image" name="image">
                          @if ($blog->image && file_exists(public_path('assets/images/' . $blog->image)))
                            <img src="{{ asset('assets/images/' . $blog->image) }}" alt="Blog Image" style="max-height: 100px;">
                          @endif
                        </div>
                        
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ route('dashboard.blog') }}" class="btn btn-light">Cancel</a>
                    </form>
                    </div>
                </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    
    <script src="{{ url('assets/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ url('assets/js/off-canvas.js') }}"></script>
    <script src="{{ url('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ url('assets/js/template.js') }}"></script>
    <script src="{{ url('assets/js/settings.js') }}"></script>
    <script src="{{ url('assets/js/todolist.js') }}"></script>
    <script src="{{ url('assets/js//progressbar.min.js') }}"></script>
    <script src="{{ url('assets/js/Chart.min.js') }}"></script>
    <script src="{{ url('assets/js/dashboard.js') }}"></script>
    </body>
 </html>