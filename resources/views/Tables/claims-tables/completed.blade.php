@extends('Admin.layout')
@section('admin.content')
 <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid" style="padding: 1em; display: flex; flex-direction:column; justify-content:center; align-items:center; gap:1em">

                        <div class="row card-tags">
                            <div class="card-items">
                                <div class="card tilebox-one">
                                    <div class="card-body py-4">
                                        <h5 style="color:black">Member-capture</h3>
                                        <h6 style="margin-bottom: 0.5em; color:black">Completed</h3>
                                        {{-- <h4>{{ $count_success }}/{{ $count_total }}</h4> --}}
                                    </div>
                                    <div class="card-footer d-flex" style="background-color: rgba(219, 219, 219, 0.877);">
                                        <a href={{url('/dashboard')}} style="text-decoration: none; color:rgb(0, 0, 0)">View Details</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-items">
                                <div class="card tilebox-one">
                                    <div class="card-body py-4">
                                        <h5 style="color:black">Member-capture</h3>
                                        <h6 style="margin-bottom: 0.5em; color:black">In-Progress</h3>
                                        {{-- <h4>{{ $count_success }}/{{ $count_total }}</h4> --}}
                                    </div>
                                    <div class="card-footer d-flex" style="background-color: rgba(219, 219, 219, 0.877);">
                                        <a href={{url('/tables-member-capture')}} style="text-decoration: none; color:black">View Details</a>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-items">
                                <div class="card tilebox-one">
                                    <div class="card-body py-4">
                                        <h5 style="color:black">Claims</h3>
                                        <h6 style="margin-bottom: 0.5em; color:black">Completed</h3>
                                        {{-- <h4>{{ $count_success }}/{{ $count_total }}</h4> --}}
                                    </div>
                                    <div class="card-footer d-flex" style="background-color: rgba(219, 219, 219, 0.877);">
                                        <a href={{url('/tables-claims-completed')}} style="text-decoration: none; color:black">View Details</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-items">
                                <div class="card tilebox-one">
                                    <div class="card-body py-4">
                                        <h5 style="color:black">Claims</h3>
                                        <h6 style="margin-bottom: 0.5em; color:black">In-Progress</h3>
                                        {{-- <h4>{{ $count_success }}/{{ $count_total }}</h4> --}}
                                    </div>
                                    <div class="card-footer d-flex" style="background-color: rgba(219, 219, 219, 0.877);">
                                        <a href={{url('/tables-claims-in-progress')}} style="text-decoration: none; color:black">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <!-- end row -->
                        <div class="table-responsive card" style="width: 100%; border-radius: 0.3em ">
                            <div class="" style="background: green; width: 100%; min-height:10%; padding:1em 2em; ">
                                <h4 style=" color: white">Claims Forms Completed</h4>
                            </div>
                            <div class="" style="padding:1em 2em; min-height:90%; background:white; margin-top:0.5em">
                                <table id="claims_completeProgressTable" class="table table-striped" style="width:100%; background:rgba(219, 219, 219, 0.877);">
                                    <thead>
                                        <tr>
                                            <th>No#</th>
                                            <th>Name</th>
                                            <th>Surname</th>
                                            <th>ID Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($claims_CompletedForm_MainMembers as $index => $claims_CompletedForm_MainMember)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $claims_CompletedForm_MainMember->fullname }}</td>
                                            <td>{{ $claims_CompletedForm_MainMember->surname }}</td>
                                            <td>{{ $claims_CompletedForm_MainMember->id_number }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-success show-confirm action" onclick="claimPageCompletedForm({{ $claims_CompletedForm_MainMember->mm_id }})">
                                                    Edit Claims
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger show-confirm action" onclick="deleteMemberForm('claims '+{{ $claims_CompletedForm_MainMember->mm_id }})">
                                                    <i class="fa fa-trash fa-lg"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No#</th>
                                            <th>Name</th>
                                            <th>Surname</th>
                                            <th>ID Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- end row -->

                    </div>
                    <!-- end container-fluid -->

                    <!-- DataTables CSS -->
                    <script>
                        console.log("claims_CompletedForm_MainMembers", <?php echo json_encode($claims_CompletedForm_MainMembers); ?>)

                        function deleteMemberForm(form_Id) {
                            fetch('/dashboard/' + form_Id, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                                        section: 3,
                                                        _method: 'DELETE'
                                                    })
                            })
                            .then(async function (response) {  // Add the 'async' keyword here
                                if (response.ok) {
                                    // Success! Refresh the page or update the UI as needed
                                    const data = await response.json();
                                    console.log("form_Id result", data);
                                    location.reload();
                                } else {
                                    // Error handling
                                    console.log('Delete request failed with status:', response.status);
                                }
                                })
                                .catch(function (error) {
                                console.log('Delete request error:', error);
                            });
                        }

                        function claimPageCompletedForm(memberId) {
                            fetch('/dashboard/claims/' + memberId, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                }
                            })
                            .then(async function (response) {  // Add the 'async' keyword here
                                if (response.ok) {
                                    // Redirect or handle successful response
                                    window.location.href = '/member-claim';
                                } else {
                                    throw new Error('Request error: ' + response.status);
                                }
                            })
                            .catch(error => {
                                console.log('Delete request error:', error);
                            });
                        }

                    </script>

                </div> <!-- end content -->



                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Tshitshithe.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Crafted with <i class="mdi mdi-heart text-danger"></i> by Tendani ICT
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


@endsection
