<?php
$title = $member ? "Member : {$member->membername} ($member->memberid)" : 'DHA Member';
$page_title = $member ? $member->membername . " ($member->memberid)" : 'Member :';
$box_color = $member && $member->status != 'CANCEL' ? 'primary' : 'danger';
$phone_residences = $member ?  explode(',', $member->phoneresidence) : [];
$mobile_numbers = $member ?  explode(',', $member->mobileno2) : [];
array_unshift($mobile_numbers, $member->mobileno);
?>

@extends('layouts.admin', ['title'=> $title, 'page_title' => $page_title])

@section('buttons')
  <button onclick="window.print();" class="btn btn-sm btn-success"><i class="fas fa-print mr-2"></i> Print</button>
  @if($member)
  <a href="{{ route('member.reports.member-info') }}?memberid={{$member->memberid}}" class="btn btn-sm btn-primary"><i class="fas fa-info-circle mr-1"></i> Info Report</a>
  <a href="{{ route('member.edit', ['memberid' => $member->memberid]) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit mr-1"></i> Edit</a>
  @endif
  @include('members.includes.homeButton')
@stop

@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-{{$box_color}} card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <!-- <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> -->
              @if($member && $member->picture)
              <img class="img" src="{{ asset('storage/images/memberpics/' . $member->picture) }}" height="200" alt="Photograph" />
              @elseif($member && $member->memberpic)
              <img class="img" src="data:image/bmp;base64,{{ chunk_split(base64_encode($member->memberpic)) }}" height="200" alt="Photograph" />
              @else
              <img class="img" src="{{ asset('dist/img/profile_pic01.jpg') }}" height="200" alt="Photograph" />
              @endif
            </div>

            <h3 class="profile-username text-center">{{$member->memberid}}</h3>

            <p class="text-muted text-center">{{$member->membername}}</p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Mobile</b> <a class="float-right">{{ $mobile_numbers[0]}}</a>
              </li>
              <li class="list-group-item">
                <b>Ph Off:</b> <a class="float-right">{{$member->phoneoffice}}</a>
              </li>
              <li class="list-group-item">
                <b>Ph Res:</b> <a class="float-right">{{$phone_residences[0]}}</a>
              </li>
            </ul>

            <a href="#" class="btn btn-{{$box_color}} btn-block d-print-none"><b>Transactions</b></a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-{{$box_color}}">
          <div class="card-header">
            <h3 class="card-title">About Member</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Mailing Address</strong>
            <p class="text-muted">{{$member->mailingaddress}}</p>
            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Working Address</strong>
            <p class="text-muted">{{ $member->workingaddress }}</p>
            <hr>

            <strong><i class="fas fa-phone mr-1"></i> Phone </strong>
            <div class="row">
              <div class="col-sm-5 mb-0"><p class="text-muted text-bold mb-0">Mobile No:</p></div>
              <div class="col-sm-7 mb-0">
                <p class="text-muted mb-0" align="right">
                  @foreach($mobile_numbers as $mobile)
                    {{trim($mobile)}}
                    @if(!$loop->last)
                      <br />
                    @endif
                  @endforeach

                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5 mb-0"><p class="text-muted text-bold mb-0">Ph Office:</p></div>
              <div class="col-sm-7 mb-0"><p class="text-muted mb-0" align="right">{{$member->phoneoffice}}</p></div>
            </div>
            <div class="row">
              <div class="col-sm-5 mb-0"><p class="text-muted text-bold mb-0">Ph Residence:</p></div>
              <div class="col-sm-7 mb-0">
                <p class="text-muted mb-0" align="right">
                  @foreach($phone_residences as $ph_res)
                    {{trim($ph_res)}}
                    @if(!$loop->last)
                      <br />
                    @endif
                  @endforeach
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5 mb-0"><p class="text-muted text-bold mb-0">Fax:</p></div>
              <div class="col-sm-7 mb-0"><p class="text-muted mb-0" align="right">{{$member->fax}}</p></div>
            </div>
            <!-- <p class="text-muted mb-0 col-sm-3"><strong class="mr-3">Mobile No :</strong> {{$member->mobile2 ? $member->mobileno2 : $member->mobileno}}</p>
            <p class="text-muted mb-0 col-sm-3"><strong class="mr-5">Office :</strong> {{$member->phoneoffice}}</p>
            <p class="text-muted mb-0 col-sm-3"><strong class="mr-3">Residence :</strong> {{$member->phoneresidence}}</p>
            <p class="text-muted mt-0 col-sm-3"><strong class="mr-5">Fax :</strong> {{$member->fax}}</p> -->
            <hr>

            <strong><i class="fas fa-at mr-1"></i> Email</strong>
            <p class="text-muted">{{$member->email}}</p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2 d-print-none">
            <div class="row d-flex justify-content-between">
              <div class="col-sm-6">
              </div>
              <div class="col-sm-5">
                <input value="{{$member->memberid}}" type="text" class="form-control form-control-sm" id="memberid_search" />
              </div>
              <div class="col-sm-1">
                <button class="btn btn-primary btn-sm" id="btnSearchView">Search</button>
              </div>
            </div>

          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="member_info_tab">
                <table class="table table-sm">
                  <tbody>
                    <tr>
                      <th class="border-top-0">Member ID</th>
                      <td class="border-top-0">{{ $member->memberid }}</td>
                      <th class="border-top-0">Club</th>
                      <td class="border-top-0">{{$member->club ? $member->club->name : 'J CLub'}}</td>
                    </tr>
                    <tr>
                      <th>Member Name</th>
                      <td colspan="3">{{$member->membername}}</td>
                    </tr>
                    <tr>
                      <th>Category</th>
                      <td colspan="3">{{$member->category ? $member->category->des : ''}}</td>
                    </tr>
                    <tr>
                      <th>Type</th>
                      <td colspan="3">{{$member->type ? $member->type->des : ''}}</td>
                    </tr>
                    <tr>
                      <th>Father Name</th>
                      <td colspan="3">{{$member->memberfname}}</td>
                    </tr>
                    <tr>
                      <th>CNIC</th>
                      <td>{{$member->cnic}}</td>
                      <th>Married</th>
                      <td>{{ $member->married ? 'YES' : 'NO' }}</td>
                    </tr>
                    <tr>
                      <th>Date of Birth</th>
                      <td>{{ $member->dob ? \Carbon\Carbon::parse($member->dob)->format('d-M-Y') : ''}}</td>
                      <th>Membership Date</th>
                      <td>{{ $member->membershipdate ? \Carbon\Carbon::parse($member->membershipdate)->format('d-M-Y') : '' }}</td>
                    </tr>
                    <tr>
                      <th>Card Issue Date</th>
                      <td>{{ $member->cardissuedate ? \Carbon\Carbon::parse($member->cardissuedate)->format('d-M-Y') : '' }}</td>
                      <th>Card Expiry Date</th>
                      <td>{{ $member->cardexpirydate ? \Carbon\Carbon::parse($member->cardexpirydate)->format('d-M-Y') : '' }}</td>
                    </tr>
                    <tr>
                      <th>Occupation</th>
                      <td colspan="3">{{ $member->occupation ? $member->occupation->des : '' }}</td>
                    </tr>
                    <tr>
                      <th>Department</th>
                      <td colspan="3">{{$member->department}}</td>
                    </tr>
                    <tr>
                      <th>Organisation</th>
                      <td colspan="3">{{$member->organisation}}</td>
                    </tr>

                    <tr>
                      <th>Status</th>
                      <td>{{$member->status}}</td>
                      <th>Block Status</th>
                      <td>{{$member->blockstatus}}</td>
                    </tr>
                    <tr>
                      <th>Remarks</th>
                      <td colspan="3">{{ $member->remarks }}</td>
                    </tr>
                    <tr>
                      <th>Other Info</th>
                      <td>{{ $member->otherinfo }}</td>
                      <th>DHA Discount</th>
                      <td>{{$member->discperc}}</td>
                    </tr>
                  </tbody>
                </table>
                
                <div class="row">
                  <div class="col-sm-12 mt-3">
                    <h3>Member Family</h3>
                  </div>
                </div>
                <div class="row">
                  @forelse($member->family as $family)
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header border-bottom-0"></div>
                      <div class="card-body pt-0">
                        <div class="row">
                          <div class="col-8">
                            <div class="row">
                              <div class="col-sm-5 text-bold">Member ID</div>
                              <div class="col-sm-7">{{$family->memberid}}</div>
                            </div>
                            <div class="row">
                              <div class="col-sm-5 text-bold">Name</div>
                              <div class="col-sm-7">{{$family->membername}}</div>
                            </div>
                            <div class="row">
                              <div class="col-sm-5 text-bold">Relation</div>
                              <div class="col-sm-7">{{$family->relation}}</div>
                            </div>
                            <div class="row">
                              <div class="col-sm-5 text-bold">Credit Allowed</div>
                              @if($family->creditallow)
                                <div class="col-sm-7 text-success"> <img src="{{ asset('dist/img/icon-yes.svg') }}" class="d-print-none" /> Yes</div>
                              @else
                                <div class="col-sm-7 text-danger"> <img src="{{ asset('dist/img/icon-no.svg') }}" class="d-print-none" />  No</div>
                              @endif
                            </div>
                            <div class="row">
                              <div class="col-sm-5 text-bold">Date of birth</div>
                              <div class="col-sm-7">{{ $family->dob ? \Carbon\Carbon::parse($family->dob)->format('d-M-Y') : '' }}</div>
                            </div>
                            <div class="row">
                              <div class="col-sm-5 text-bold">Card Issue Date</div>
                              <div class="col-sm-7">{{ $family->cardissuedate ? \Carbon\Carbon::parse($family->cardissuedate)->format('d-M-Y') : '-' }}</div>
                            </div>
                            <div class="row">
                              <div class="col-sm-5 text-bold">Card Expiry Date</div>
                              <div class="col-sm-7">{{ $family->cardexpirydate ? \Carbon\Carbon::parse($family->cardexpirydate)->format('d-M-Y') : '-' }}</div>
                            </div>
                          </div>
                          <div class="col-4 text-right">
                            @if($family->picture)
                              <img class="img-fluid" id="member_sign_img" src="{{ asset('storage/images/memberpics/' . $family->picture) }}" width="125" alt="Photograph" style="cursor: pointer;" />
                            @elseif($family->fmemberpic)
                              <img class="img-fluid" id="member_sign_img" src="data:image/bmp;base64,{{ chunk_split(base64_encode($family->fmemberpic)) }}" width="125" alt="Photograph" style="cursor: pointer;" />
                            @else
                            <img class="img-fluid" id="member_sign_img" src="{{ asset('dist/img/profile_pic01.jpg') }}" width="125" alt="Photograph" style="cursor: pointer;" />
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @empty
                  <div class="col-sm-12 text-center">
                    <h4 class="w-1100">No Family</h4>
                  </div>
                  @endforelse
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@stop
@push('custom-scripts')
<script>
  $(document).on('click', '#btnSearchView', gotoView)
  $(document).on('keydown', '#memberid_search', function(e) {
    if (e.key === 'Enter' || e.keyCode === 13 || e.key === 'F8' || e.keyCode === 119) {
      gotoView(e)
    }
  })

  function gotoView(e) {
    const memberid = $('#memberid_search').val()
    window.location.href = `${_baseURL}members/${memberid}`
  }
</script>
@endpush