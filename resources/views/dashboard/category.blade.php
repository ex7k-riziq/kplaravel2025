@extends('layouts.app2')
@section('content')
    <div class="row align-items-center mb-3">
              <div class="col-sm-6">
                <h3 class="mb-0 font-weight-bold">Categories List</h3>
              </div>
              <div class="col-sm-6 text-sm-right">
                <div class="d-flex align-items-center justify-content-md-end">
                  <div class="pr-1 mb-3 mb-xl-0">
                  @guest
                  @else
                    <a href="{{ route('dashboard.categorycreate') }}" class="btn btn-sm btn-success btn-icon-text border">
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
                          @guest
                          @else
                          <th>
                            Action
                          </th>
                          @endguest
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($category as $member)
                        <tr>
                          <td class="py-1">
                            {{ $member->name }}
                          </td>
                          @guest
                          @else
                          <td>
                            <div style="display: flex; gap: 8px;">
                              <a href="{{ route('dashboard.categoryedit', $member) }}" class="btn btn-secondary btn-sm">Edit</a>
                              <form action="{{ route('dashboard.categorydelete', $member) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this category?')">Delete</button>
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