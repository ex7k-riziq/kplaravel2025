@extends('layouts.app')
@section('content')
    <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0 font-weight-bold">Blog Menu</h3>
                <p>Your last login: 21h ago from newzealand.</p>
              </div>
              <div class="col-sm-6">
                <div class="d-flex align-items-center justify-content-md-end">
                  <div class="pr-1 mb-3 mb-xl-0">
                    <a href="{{ route('dashboard.blogcreate') }}" class="btn btn-sm btn-success btn-icon-text border">
                      <i class="typcn typcn-plus mr-2"></i>Add New
                    </a>
                  </div>
                </div>
              </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Title
                          </th>
                          <th>
                            Category
                          </th>
                          <th>
                            Creator
                          </th>
                          <th>
                            Created at
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($entry as $member)
                        <tr>
                          <td class="py-1">
                            {{ $member->title }}
                          </td>
                          <td>
                            {{ $member->category }}
                          </td>
                          <td>
                            {{ $member->creator }}
                          </td>
                          <td>
                            {{ $member->created_at }}
                          </td>
                          <td>
                            <div style="display: flex; gap: 8px;">
                              <a href="{{ route('dashboard.blogedit', ['id' => $member->id]) }}" class="btn btn-secondary btn-sm">Edit</a>
                              <form action="{{ route('dashboard.blogdelete', ['id' => $member->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this blog?')">Delete</button>
                              </form>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
@endsection