@extends('layouts.app2')
@section('content')
<div class="row align-items-center mb-3">
  <div class="col-sm-6">
    <h3 class="mb-0 font-weight-bold">User List</h3>
  </div>
  <div class="col-sm-6 text-sm-right">
    @guest
    @else
      <a href="{{ route('dashboard.usercreate') }}" class="btn btn-sm btn-success btn-icon-text border">
        <i class="typcn typcn-plus mr-2"></i>Add New
      </a>
    @endguest
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
                            User pic
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Email
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
                        @foreach ($user as $member)
                          <tr>
                            <td class="py-1">
                              <img src="{{ asset('assets/images/' . $member->image) }}" />
                            </td>
                            <td>
                              {{ $member->name }}
                            </td>
                            <td>
                              {{ $member->email }}
                            </td>
                            <td>
                              {{ $member->created_at }}
                            </td>
                            @guest
                            @else
                            <td>
                              <div style="display: flex; gap: 8px;">
                                <a href="{{ route('dashboard.useredit', $member) }}" class="btn btn-secondary btn-sm">Edit</a>
                                <form action="{{ route('dashboard.userdelete', $member) }}" method="POST" style="display: inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this user?')">Delete</button>
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