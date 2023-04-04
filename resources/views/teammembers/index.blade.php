@extends('layouts.vertical', ['title' => 'Team Members'])

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Monez</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item active">Team Members</li>
                    </ol>
                </div>
                <h4 class="page-title">Team Members</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-danger waves-effect waves-light" data-trigger="modal" data-target="add-member-modal"><i class="mdi mdi-plus-circle mr-1"></i></i>Add Member
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-striped" id="products-datatable">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Advertiser ID</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>name</td>
                                    <td>email</td>
                                    <!-- Please add advertiser id here -->
                                    <td>Advertiser ID</td>

                                    <td>
                                        <span class="d-inline-flex" style="gap: 5px;">
                                            <a class="btn bg-secondary text-white" data-trigger="modal" data-target="edit-member-modal">View Info</a>
                                            <form action="" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </span>
                                    </td>
                                </tr>
                                @foreach($teamMembers as $teamMember)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>{{ $teamMember->name }}</td>
                                    <td>{{ $teamMember->email }}</td>
                                    <!-- Please add advertiser id here -->
                                    <td>Advertiser ID</td>

                                    <td>
                                        <a class="btn bg-secondary text-white" data-trigger="modal" data-target="edit-member-modal">View Info</a>
                                        <!-- <a class="action-icon" data-trigger="modal" data-target="edit-member-modal">
                                            <i class="mdi mdi-square-edit-outline"></i>
                                        </a> -->
                                    </td>
                                    <td>
                                        <form action="{{ route('team-members.destroy', $teamMember->id )  }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div> <!-- container -->
@include('teammembers.edit')
@include('teammembers.add-members-modal')

@endsection
@section('script-bottom')
<script type="text/javascript">
    $('#products-datatable').DataTable();
</script>
<script>
    const allModals = document.querySelectorAll(".modal");
    for (let i = 0; i < allModals.length; i++) {
        const modal = allModals[i];
        let dismissBtns = modal.querySelectorAll('[data-dismiss="modal"]');
        for (let j = 0; j < dismissBtns.length; j++) {
            dismissBtns[j].addEventListener("click", () => {
                modal.classList.remove("show");
                modal.style.display = "none"
            })
        }
    }

    const modalTriggerBtns = document.querySelectorAll('[data-trigger="modal"]');
    for (let i = 0; i < modalTriggerBtns.length; i++) {
        modalTriggerBtns[i].addEventListener("click", () => {
            let modal = document.getElementById(modalTriggerBtns[i].getAttribute("data-target"))
            modal.classList.add("show");
            modal.style.display = "block"
        })
    }
</script>
@endsection