@extends('layouts.app2')
@section('content')
    <div class="row align-items-center mb-3">
              <div class="col-sm-6">
                <h3 class="mb-0 font-weight-bold">Blog Menu</h3>
              </div>
              <div class="col-sm-6 text-sm-right">
                <div class="d-flex align-items-center justify-content-md-end">
                  <div class="pr-1 mb-3 mb-xl-0">
                  @guest
                  @else
                    <a href="{{ route('dashboard.blogcreate') }}" class="btn btn-sm btn-success btn-icon-text border">
                      <i class="typcn typcn-plus mr-2"></i>Add New
                    </a>
                  @endguest
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
                            Slug
                          </th>
                          <th>
                            Description
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
                          @guest
                          @else
                          <th>
                            Action
                          </th>
                          @endguest
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($blog as $member)
                        <tr>
                          <td class="py-1">
                            <img src="{{ asset('assets/images/' . $member->image) }}" />
                          </td>
                          <td class="py-1">
                            {{ $member->title }}
                          </td>
                          <td class="py-1">
                            {{ $member->slug }}
                          </td>
                          <td>
                            {!! $member->description !!}
                          </td>
                          <td>
                            {{ $member->category->name ?? '-' }}
                          </td>
                          <td>
                            {{ $member->creator->name ?? '-'  }}
                          </td>
                          <td>
                            {{ $member->created_at }}
                          </td>
                          @guest
                          @else
                          <td>
                            <div style="display: flex; gap: 8px;">
                              <a href="{{ route('dashboard.blogedit', $member) }}" class="btn btn-secondary btn-sm">Edit</a>
                              <form action="{{ route('dashboard.blogdelete', $member) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this blog?')">Delete</button>
                              </form>
                            </div>
                          </td>
                          @endguest
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
@endsection