@section('css')
<!-- Plugins css -->
<link href="{{asset('assets/libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

<!-- Personal Info -->
<div class="form-category">
    <h5 class="mb-3 text-uppercase"><i class="mdi mdi-account-circle mr-2"></i> Contact Info (Account Manager)
    </h5>
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="amFirstName" class="form-label">First Name</label><label class="text-danger">*</label>
                <input type="text" class="form-control" id="amFirstName" name="amFirstName" placeholder="Enter first name" required value="{{ $advertiser->amFirstName ??  old('amFirstName') }}">
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">
                    You must enter valid input
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="amLastName" class="form-label">Last Name</label><label class="text-danger">*</label>
                <input type="text" class="form-control" id="amLastName" name="amLastName" placeholder="Enter last name" required value="{{ $advertiser->amLastName ??  old('amLastName') }}">
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">
                    You must enter valid input
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-md-4">
            <div class="mb-3">
                <label for="amEmail" class="form-label"> Email</label><label class="text-danger">*</label>
                <input type="email" class="form-control" id="amEmail" name="amEmail" placeholder="Enter email" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" required value="{{ $advertiser->amEmail ??  old('amEmail') }}">
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">
                    You must enter valid input
                </div>
            </div>
        </div>
    </div> <!-- end row -->
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="amPhone" class="form-label">Phone</label>
                <div class="input-group input-group-merge">
                    <div class="input-group-prepend" style="min-width: 150px;">
                        <select class="form-control " id="phone-code-dropdown" data-toggle="select2">
                            @foreach ($countries as $key => $country)
                            <option value="{{$country->countryCode}}">{{$country->countryCode}} ({{$country -> title}})</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="number" class="form-control ml-2" id="amPhone" name="amPhone" placeholder="Enter phone number">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="amSkype" class="form-label">Skype</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fab fa-skype"></i></span>
                    <input type="text" class="form-control" id="amSkype" name="amSkype" placeholder="@username" value="{{ $advertiser->amSkype ??  old('amSkype') }}">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="amLinkedIn" class="form-label">Linkedin</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                    <input type="url" class="form-control" id="amLinkedIn" name="amLinkedIn" placeholder="Url" pattern="(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})" value="{{ $advertiser->amLinkedIn ??  old('amLinkedIn') }}">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">
                        You must enter valid input
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>

<div class="form-category">
    <!-- Agreement & Terms -->
    <h5 class="mb-3 text-uppercase"><i class="mdi mdi-office-building mr-2"></i>Operations Info
    </h5>
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="revSharePer" class="form-label">Revenue Share (%)</label><label class="text-danger">*</label>
                <input type="number" class="form-control" onchange="this.value = Math.min(this.value, 100)" id="revSharePer" name="revSharePer" placeholder="Enter Revenue Share (%)" required value="{{ $advertiser->revSharePer ??  old('revSharePer') }}">
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">
                    You must enter valid input
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-md-4">
            <div class="mb-3">
                <label for="paymentTerms" class="form-label">Payment Terms </label><label class="text-danger">*</label>
                <div class="input-group">
                    <select class="form-control" data-toggle="select2" id="paymentTerms" name="paymentTerms" required>
                        <option value="" selected>Select Payment Term</option>
                        <option value="SH1">Net 15</option>
                        <option value="SH1">Net 30</option>
                        <option value="SH1">Net 45</option>
                        <option value="SH1">Net 60</option>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">
                        You must enter valid input
                    </div>
                </div>
                <!-- <input type="text" class="form-control" id="paymentTerms" name="paymentTerms" placeholder="Enter Payment Terms here ..."> -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="reportEmail" class="form-label">Reporting Email</label><label class="text-danger">*</label>
                <input type="email" class="form-control" id="reportEmail" name="reportEmail" placeholder="Enter reporting email" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" required value="{{ $advertiser->reportEmail ??  old('reportEmail') }}">
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">
                    You must enter valid input
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-md-4">
            <div class="mb-3">
                <label for="reportType" class="form-label">Report Type</label><label class="text-danger">*</label>
                <div class="input-group input-group-merge">
                    <select class="form-control" id="reportType" data-toggle="select2" onchange="showReportCredsPopup(this.value)" name="reportType" required value="{{ $advertiser->reportType ??  old('reportType') }}">
                        <option value="" selected>Report Type</option>
                        <option value="api">API</option>
                        <option value="email">EMAIL</option>
                        <option value="gdrive">Google Drive</option>
                        <option value="dashboard">Dashboard</option>
                    </select>
                    <div class="input-group-append">
                        <button type="button" data-trigger="modal" data-target="report-type-modal" data-enable-target="reportType" class="btn btn-secondary d-none display-on-valid">
                            <span class="dripicons-document-edit"></span>
                        </button>
                    </div>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">
                        You must enter valid input
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="reportColumns" class="form-label">Report Columns</label><label class="text-danger">*</label>
            <div class="input-group input-group-merge">
                <input type="text" class="form-control" style="pointer-events: none;" id="reportColumns" name="reportColumns" placeholder="Define report columns" value="{{ $advertiser->reportColumns ??  old('reportColumns') }}">
                <div class="input-group-append">
                    <button type="button" data-trigger="modal" data-target="define-report-columns-modal" class="btn btn-secondary">
                        <span class="dripicons-document-edit"></span>
                    </button>
                </div>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">
                    You must enter valid input
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="successManager" class="form-label">Success Manager</label><label class="text-danger">*</label>
            <select class="form-control" data-toggle="select2" id="successManager" name="successManager" required>
                <option value="" selected>Select Success Manager</option>
                <option value="1">Success Manager</option>
            </select>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">
                You must enter valid input
            </div>
        </div>

    </div> <!-- end row -->
</div>

<div class="form-category">
    <h5 class="mb-3 text-uppercase"><i class="mdi mdi-office-building mr-2"></i>Finance Info
    </h5>
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="billEmail" class="form-label">Billing / Finance Email</label><label class="text-danger">*</label>
                <input type="email" class="form-control" id="billEmail" name="billEmail" placeholder="Enter billing / financial email" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" required value="{{ $advertiser->billEmail ??  old('billEmail') }}">
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">
                    You must enter valid input
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="bank" class="form-label">Bank <span class="text-danger"></span></label>
                <div class="input-group input-group-merge">
                    <input type="text" style="pointer-events: none;" class="form-control" id="bank" name="bank" placeholder="Enter Bank account" value="{{ $advertiser->bank ??  old('bank') }}">
                    <div class="input-group-append">
                        <button type="button" data-trigger="modal" data-target="add-bank-details-modal" class="btn btn-secondary">
                            <span class="mdi mdi-bank-plus"></span>
                        </button>
                    </div>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">
                        You must enter valid input
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-md-4">
            <div class="mb-3">
                <label for="paypal" class="form-label">Paypal</label>
                <input type="text" class="form-control" id="paypal" name="paypal" placeholder="Enter Paypal account" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" value="{{ $advertiser->paypal ??  old('paypal') }}">
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">
                    You must enter valid email format
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="payoneer" class="form-label">Payoneer</label>
                <input type="text" class="form-control" id="payoneer" name="payoneer" placeholder="Enter payoneer account" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" value="{{ $advertiser->payoneer ??  old('payoneer') }}">
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">
                    You must enter valid email format
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>


<div class="row px-2">
    <button class="btn btn-primary" type="submit">Submit</button>
    <a href="{{ route('advertiser.index') }}" class="btn btn-secondary ml-1" type="button">Cancel</a>
</div>

@include('advertiser.form')
@include('advertiser.modals.report-columns')
@include('advertiser.modals.bank-details-modal')
@include('advertiser.modals.reports-modal')

@section('script')
<!-- Plugins js-->
<script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>

<!-- Page js-->
<script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
<script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
<script src="{{asset('assets/js/modal-init.js')}}"></script>

<script>
    $('.dropify').dropify();
    window.addEventListener("DOMContentLoaded", () => {
        generateRandomPassword(null)
    })


    function setCountryCodeToPhone(countryCode) {
        $("#phone-code-dropdown").select2().val(countryCode).trigger("change");
    }

    document.querySelectorAll(".enable-on-valid").forEach((el) => {
        let input = document.getElementById(el.getAttribute("data-enable-target"));
        input.addEventListener("change", (e) => {
            el.disabled = e.target.value === "";
        })
    })
    document.querySelectorAll(".display-on-valid").forEach((el) => {
        let input = document.getElementById(el.getAttribute("data-enable-target"));
        input.addEventListener("change", (e) => {
            if (e.target.value !== "") el.classList.remove("d-none");
            else el.classList.add("d-none")
        })
    })

    //Report Type Popup Script
    const reportTypeModal = document.getElementById("report-type-modal");
    const reportCredsInputs = reportTypeModal.getElementsByClassName("report-creds-input");

    function showReportCredsPopup(value) {
        for (let i = 0; i < reportCredsInputs.length; i++) {
            reportCredsInputs[i].classList.add("d-none");
            // reportCredsInputs[i].querySelector("input").setAttribute("required", false);
        }
        if (value !== "") {
            reportTypeModal.getElementsByClassName(value + "-input-group")
                .forEach((inpGroup) => {
                    inpGroup.classList.remove("d-none");
                    // inpGroup.querySelector("input").setAttribute("required", true);
                })
            reportTypeModal.classList.add("show");
            reportTypeModal.style.display = "block";
        }
    }


    $(document).ready(function() {
        $('#dbaId').on('input', function() {
            var inputVal = $(this).val();
            if (inputVal.length > 0) {
                $.ajax({
                    url: '{{ route("check.unique.value") }}',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        input_field: inputVal
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'error') {
                            validateInput("#dbaId", false);
                            $("#dba-invalid").text('Advertiser ID already exists.');
                        } else {
                            console.log(response);
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            } else {
                $("#dba-invalid").text('You must enter valid input.');
            }
        });
    });


    function onSaveColumnsModal() {
        let allInpValid = true;
        $("#define-report-columns-modal").find("input,select").each((i, inp) => {
            if (inp.value === "") {
                allInpValid = false;
            }
        })
        let reportColsInp = $("#reportColumns")
        reportColsInp.val("Report Columns Set");
        validateInput(reportColsInp);
    }
    $(document).ready(() => {
        $("#add-bank-details-modal").find("#bankName").on("input", (e) => {
            $("#bank").val(e.target.value)
            console.log(e.target.value);
            validateInput("#bank");
        })
    })
</script>

@endsection