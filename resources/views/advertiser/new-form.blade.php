@section('css')
<!-- Plugins css -->
<link href="{{ asset('assets/libs/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
<div id="btnwizard">
    <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-4">
        <li class="nav-item">
            <a data-target="#accountInfoTab" data-toggle="tab" id="accountInfoTabbutton" style="pointer-events: none; user-select: none;" class="nav-link rounded-0 {{ $activeTab == 'accountInfoTab' ? 'active' : '' }} pt-2 pb-2">
                <i class="mdi mdi-office-building mr-2"></i>
                Account Info
            </a>
        </li>
        <li class="nav-item">
            <a data-target="#contactInfoTab" data-toggle="tab" id="contactInfoTabbutton" style="pointer-events: none; user-select: none;" class="nav-link rounded-0 {{ $activeTab == 'contactInfoTab' ? 'active' : '' }} pt-2 pb-2">
                <i class="mdi mdi-account-circle mr-2"></i>
                Contact Info (Account Manager)
            </a>
        </li>
        <li class="nav-item">
            <a data-target="#operationsInfoTab" data-toggle="tab" id="operationInfoTabbutton" style="pointer-events: none; user-select: none;" class="nav-link rounded-0 {{ $activeTab == 'operationsInfoTab' ? 'active' : '' }} pt-2 pb-2">
                <i class="mdi mdi-office-building mr-2"></i>
                Operations Info
            </a>
        </li>
        <li class="nav-item">
            <a data-target="#financeInfoTab" data-toggle="tab" id="financeInfoTabbutton" style="pointer-events: none; user-select: none;" class="nav-link rounded-0 {{ $activeTab == 'financeInfoTab' ? 'active' : '' }} pt-2 pb-2">
                <i class="mdi mdi-office-building mr-2"></i>
                Finance Info
            </a>
        </li>
    </ul>

    <div class="tab-content mb-0 b-0 pt-0">
        {{-- {{ \Session::get('activeTab') == 'accountInfoTab' ? 'active show' : '' }} --}}
        <!-- Account Info Tab Start  -->
        <div class="tab-pane {{ $activeTab == 'accountInfoTab' ? 'active show' : '' }} fade" id="accountInfoTab">
            <form class="needs-validation" id="accountInfofor" method="post" action="{{ route('advertiser.storeAccountInfo') }}" enctype="multipart/form-data" novalidate>
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="dbaId" class="form-label">Advertiser ID</label><label class="text-danger">*</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span>adv_</span>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="dbaId" name="dbaId" data-check-unique="oninput" data-invalid-message="Advertiser ID already registered." data-unique-path="{{ route('check.unique.value') }}" placeholder="Enter Advertiser ID" required value="{{ session()->get('advertiser.dbaId') }}" />
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback" id="dba-invalid">
                                    You must enter valid input
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="companyName" class="form-label">Company / Legal Name</label><label class="text-danger">*</label>
                            <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Enter Company / Legal Name" required value="{{ session()->get('advertiser.companyName') }}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">
                                You must enter valid input
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="regId" class="form-label">Registration / National ID</label>
                            <input type="text" class="form-control" id="regId" name="regId" placeholder="Enter Registration / National ID" value="{{ session()->get('advertiser.regId') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="vat" class="form-label">VAT ID</label>
                            <input type="text" class="form-control" id="vat" name="vat" placeholder="Enter VAT" value="{{ session()->get('advertiser.vat') }}">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="url" class="form-label">Website</label><label class="text-danger">*</label>
                            <input type="text" class="form-control" id="website-url-input" name="url" placeholder="Enter website url" pattern="(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})" required value="{{ session()->get('advertiser.url') }}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">
                                You must enter valid input
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="accEmail" class="form-label">Account Email</label><label class="text-danger">*</label>
                            <input type="email" class="form-control" id="accEmail" name="accEmail" placeholder="Enter account email" oninput="confirmEmail()" data-check-unique="oninput" data-invalid-message="Email already registered." data-unique-path="{{ route('check.unique.accEmail') }}" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" required value="{{ session()->get('advertiser.accEmail') }}">
                            <div class="valid-feedback">Valid.</div>
                            <div id="accEmail-invalid" class="invalid-feedback">
                                You must enter valid input
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="confemail" class="form-label">Confirm Email</label><label class="text-danger">*</label>
                            <input type="text" class="form-control" name="" data-autovalidate="false" placeholder="Enter confirm account email" required id="confemail" oninput="confirmEmail()" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" required value="{{ session()->get('advertiser.accEmail') }}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">
                                Email and confirm email should be same.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label><label class="text-danger">*</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password-input-field" class="form-control" name="password" placeholder="Enter password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}" value="{{ session()->get('advertiser.password') }}" required>
                                <div class="input-group-append" data-password="false">
                                    <div class="input-group-text btn">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                                <div class="pl-2">
                                    <div class="btn btn-secondary" onclick="generateRandomPassword(this)">Regenerate
                                    </div>
                                </div>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">
                                    Your password must contain least 8 characters, at least one number and one uppercase
                                    and lowercase
                                    letter.
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="address1" class="form-label">Address</label><label class="text-danger">*</label>
                            <!-- <label for="cwebsite" class="form-label">Address Line 1</label> -->
                            <input type="text" class="form-control" id="address1" name="address1" placeholder="Enter address line 1" required value="{{ session()->get('advertiser.address1') }}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">
                                You must enter valid input
                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="address1" class="form-label">Address 2</label>
                            <input type="text" class="form-control" id="address2" name="address2" placeholder="Enter address line 2" value="{{ session()->get('advertiser.address2') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="address1" class="form-label">City</label><label class="text-danger">*</label>
                            <!-- <label for="cwebsite" class="form-label">Address Line 1</label> -->
                            <input type="text" class="form-control" id="city" name="city_id" placeholder="Enter city" required value="{{ session()->get('advertiser.city_id') }}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">
                                You must enter valid input
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="address1" class="form-label">State / Province</label>
                            <!-- <label for="cwebsite" class="form-label">Address Line 1</label> -->
                            <input type="text" class="form-control" id="state_id" name="state_id" placeholder="Enter state / province" value="{{ session()->get('advertiser.state_id') }}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">
                                You must enter valid input
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="address1" class="form-label">Zip Code</label>
                            <!-- <label for="cwebsite" class="form-label">Address Line 1</label> -->
                            <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="Enter zip / code" value="{{ session()->get('advertiser.zipCode') }}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">
                                You must enter valid input
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-4">
                        <label for="country" class="form-label">Country</label><label class="text-danger">*</label>
                        <select class="form-control" name="country_id" id="country-dropdown" data-toggle="select2" required>
                            <option>Select Country</option>
                            @foreach ($countries as $key => $country)
                            <option value="{{ $country->id }}" @if ( session()->has('advertiser.country_id') && $country->id == session()->get('advertiser.country_id')) selected @endif
                                phone-code="{{ $country->countryCode }}">{{ $country->title }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">
                            You must enter valid input
                        </div>
                    </div>
                </div> <!-- end row -->
                <div class="row mb-3">
                    <div class="col-md-6 h-100 mb-3">
                        <label for="io" class="form-label">IO</label>
                        <input type="file" name="ios[]" class="dropify" data-height="200" data-allowed-file-extensions="pdf" accept="application/pdf" data-max-file-size="5M" multiple />
                    </div>
                    <div class="col-md-6 h-100 mb-3">
                        <label for="documents" class="form-label">Documents</label>
                        <input type="file" name="documents[]" class="dropify" data-height="200" data-allowed-file-extensions="pdf" accept="application/pdf" data-max-file-size="5M" multiple />
                    </div>
                </div>
                <div class="row px-2 justify-content-between">
                    <a href="{{ route('advertiser.index') }}" class="btn btn-secondary ml-1" type="button">Cancel</a>
                    <button class="btn btn-primary" id="accountInfobtn" type="submit">Next</button>
                </div>
            </form> <!-- end row -->
        </div>
        <!-- Account Info Tab End  -->

        <!-- Contact Info Tab Start  -->
        <div class="tab-pane {{ $activeTab == 'contactInfoTab' ? 'active show' : '' }} fade" id="contactInfoTab">

            <form class="needs-validation" id="contactInfoform" method="post" action="{{ route('advertiser.storeContactInfo') }}" enctype="multipart/form-data" novalidate>

                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="amFirstName" class="form-label">First Name </label><label class="text-danger">*</label>
                            <input type="text" class="form-control" id="amFirstName" name="amFirstName" placeholder="Enter first name" required value="{{ session()->get('advertiser.amFirstName') }}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">
                                You must enter valid input
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="amLastName" class="form-label">Last Name</label><label class="text-danger">*</label>
                            <input type="text" class="form-control" id="amLastName" name="amLastName" placeholder="Enter last name" required value="{{ session()->get('advertiser.amLastName') }}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">
                                You must enter valid input
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="amEmail" class="form-label"> Email</label><label class="text-danger">*</label>
                            <input type="email" class="form-control" id="amEmail" name="amEmail" placeholder="Enter email" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" required value="{{ session()->get('advertiser.amEmail') }}">
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
                                    <select class="form-control " name="country_code" id="phone-code-dropdown" data-toggle="select2">

                                        @foreach ($countries as $key => $country)
                                        <option value="{{ $country->id }}" {{ $country->countryCode == '1' ? 'selected' : '' }}>
                                            {{ $country->countryCode }} ({{ $country->title }})
                                        </option>
                                        <!-- <option value="{{ $country->countryCode }}">{{ $country->countryCode }} ({{ $country->title }})</option> -->
                                        @endforeach
                                    </select>
                                </div>
                                <input type="number" class="form-control ml-2" id="amPhone" name="amPhone" placeholder="Enter phone number" value="{{ session()->get('advertiser.amPhone') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="amSkype" class="form-label">Skype</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-skype"></i></span>
                                <input type="text" class="form-control" id="amSkype" name="amSkype" placeholder="@username" value="{{ session()->get('advertiser.amSkype') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="amLinkedIn" class="form-label">Linkedin</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                                <input type="url" class="form-control" id="amLinkedIn" name="amLinkedIn" placeholder="Url" pattern="(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})" value="{{ session()->get('advertiser.amLinkedIn') }}">
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">
                                    You must enter valid input
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <div class="row px-2 justify-content-between">
                    <button class="btn btn-secondary ml-1 previous-tab-btn" type="button">Previous</button>
                    <button class="btn btn-primary" type="submit">Next</button>
                </div>
            </form>
        </div>
        <!-- Contact Info Tab End  -->


        <!-- Operations Info Tab Start  -->
        <div class="tab-pane {{ $activeTab == 'operationsInfoTab' ? 'active show' : '' }} fade" id="operationsInfoTab">
            <form class="needs-validation" id="operationInfoform" method="post" action="{{ route('advertiser.storeOperationInfo') }}" enctype="multipart/form-data" novalidate>
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="revSharePer" class="form-label">Revenue Share (%)</label><label class="text-danger">*</label>
                            <input type="number" class="form-control" onchange="this.value = Math.min(this.value, 100)" id="revSharePer" name="revSharePer" placeholder="Enter Revenue Share (%)" required value="{{ session()->get('advertiser.revSharePer') }}">
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
                                    <option {{session()->get('advertiser.paymentTerms') == 'SH1' ? 'selected' : '' }} value="SH1">Net 15</option>
                                    <option {{session()->get('advertiser.paymentTerms') == 'SH2' ? 'selected' : '' }} value="SH2">Net 30</option>
                                    <option {{session()->get('advertiser.paymentTerms') == 'SH3' ? 'selected' : '' }} value="SH3">Net 45</option>
                                    <option {{session()->get('advertiser.paymentTerms') == 'SH4' ? 'selected' : '' }} value="SH4">Net 60</option>
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
                            <input type="email" class="form-control" id="reportEmail" name="form_reportEmail" placeholder="Enter reporting email" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" required value="{{ session()->get('advertiser.reportEmail') }}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">
                                You must enter valid input
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-4 mb-3">
                        <label for="reportColumns" class="form-label">Report Details</label>
                        <div class="input-group input-group-merge">
                            <input type="text" class="form-control" style="pointer-events: none;" id="reportColumns" name="reportColumns" placeholder="Define report details">
                            <input type="text" class="form-control d-none" id="reportColumnsId" name="report_columns_id" value="{{ session()->get('advertiser.report_columns_id') }}">
                            <div class="input-group-append">
                                <button type="button" data-trigger="modal" data-target="report-details-modal" class="btn btn-secondary">
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
                        <select class="form-control" data-toggle="select2" id="successManager" name="team_member_id" required>
                            <option value="" selected disabled>Select Success Manager</option>
                            @foreach ($availableTeamMembers as $key => $teamMember)
                            <option value="{{ $teamMember->id }}" @if ( session()->get('advertiser.team_member_id') == $teamMember->id) selected @endif>
                                {{ $teamMember->name }}
                            </option>
                            @endforeach
                            <!-- <option value="1">Success Manager</option> -->
                        </select>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">
                            You must enter valid input
                        </div>
                    </div>

                </div>
                <div class="row px-2 justify-content-between">
                    <button class="btn btn-secondary ml-1 previous-tab-btn" type="button">Previous</button>
                    <button class="btn btn-primary" type="submit">Next</button>
                </div>
            </form>
        </div>
        <!-- Operations Info Tab End  -->


        <!-- Finance Info Tab Start -->
        <div class="tab-pane {{ $activeTab == 'financeInfoTab' ? 'active show' : '' }}" id="financeInfoTab">

            <form class="needs-validation" id="financeInfoform" method="post" action="{{ route('advertiser.storeFinanceInfo') }}" enctype="multipart/form-data" novalidate>

                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="billEmail" class="form-label">Billing / Finance Email</label><label class="text-danger">*</label>
                            <input type="email" class="form-control" id="billEmail" name="billEmail" placeholder="Enter billing / financial email" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" required value="{{ session()->get('advertiser.billEmail') }}">
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
                                <input type="text" style="pointer-events: none;" tabindex="-1" class="form-control" id="bank" name="bank" placeholder="Enter Bank account" value="{{ session()->get('advertiser.bank') }}">
                                <input type="text" class="form-control d-none" id="bankId" name="bank_id">
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
                            <input type="text" class="form-control" id="paypal" name="paypal" placeholder="Enter Paypal account" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" value="{{ session()->get('advertiser.paypal') }}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">
                                You must enter valid email format
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="payoneer" class="form-label">Payoneer</label>
                            <input type="text" class="form-control" id="payoneer" name="payoneer" placeholder="Enter payoneer account" value="{{ session()->get('advertiser.payoneer') }}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">
                                You must enter valid email format
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <div class="row px-2 justify-content-between">
                    <button class="btn btn-secondary ml-1 previous-tab-btn" type="button">Previous</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
        <!-- Finance Info Tab End -->


    </div> <!-- tab-content -->
</div>



@section('script-bottom')
<!-- Plugins js-->
<script src="{{ asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
<script src="{{ asset('assets/libs/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/libs/twitter-bootstrap-wizard/twitter-bootstrap-wizard.min.js') }}"></script>


<!-- Page js-->
<script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('assets/js/modal-init.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-wizard.init.js') }}"></script>


<script>
    function confirmEmail() {
        if ($("#confemail").val() === "") return;
        $($("#confemail")).removeClass('is-valid is-invalid')
            .addClass(($("#accEmail").val() === $("#confemail").val()) ? ($("#confemail")[0].checkValidity() ?
                'is-valid' : 'is-invalid') : 'is-invalid');
    }


    $('.dropify').dropify();
    window.addEventListener("DOMContentLoaded", () => {
        generateRandomPassword(null)
    })


    $("#country-dropdown").on("change", (e) => {
        console.log(e.target);
        let countryCode = $("#country-dropdown option:selected").attr("phone-code");
        console.log(countryCode)
        $("#phone-code-dropdown").select2().val(countryCode).trigger("change");

    })

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



    //Report Type Script
    const reportTypeModal = document.getElementById("report-details-modal");
    const reportCredsInputs = reportTypeModal.getElementsByClassName("report-creds-input");

    function showReportCredsReleventInputs(value) {
        for (let i = 0; i < reportCredsInputs.length; i++) {
            reportCredsInputs[i].classList.add("d-none");
        }
        if (value !== "") {
            reportTypeModal.getElementsByClassName(value + "-input-group")
                .forEach((inpGroup) => {
                    inpGroup.classList.remove("d-none");
                })
        }
    }

    $("#reportType").on("select2:close", function() {
        showReportCredsReleventInputs($(this).val());
    })




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
    $("#add-bank-details-modal").find("#bankName").on("input", (e) => {
        $("#bank").val(e.target.value)
        validateInput("#bank");
    })


    $("#bankDetailsForm").submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            success: (response) => {
                $("#bankId").val(response.id);
                $(this).closest(".modal")
                    .removeClass("show")
                    .css("display", "none");
                console.log(response);
            },
            error: (error) => {
                console.log(error);
            }
        });
    });

    $("#reportTypeForm").submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            success: (response) => {
                // $("#reportColumnsId").val(response.id);
                $(this).closest(".modal")
                    .removeClass("show")
                    .css("display", "none");
                console.log(response)
            },
            error: (error) => {
                console.log(error);
            }
        });
    });


    $("#accountInfoform").submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            success: (response) => {
                $("#contactInfoTabbutton")[0].click()

            },
            error: (error) => {
                console.log(error);
            }
        });
    });
    $("#contactInfoform").submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            success: (response) => {
                $("#operationInfoTabbutton").click()

                console.log(response)
            },
            error: (error) => {
                console.log(error);
            }
        });
    });


    $(".previous-tab-btn").click((e) => {
        $(".tab-pane").removeClass("active").removeClass("show");
        let targetTab = $(e.target).closest(".tab-pane");
        $(".tab-pane").eq(targetTab.index() - 1).addClass("active show");
        $(".nav-item>a").removeClass("active");
        $(".nav-item").eq(targetTab.index() - 1).find("a").addClass("active");
    })

    // $("#operationInfoform").submit(function(event) {
    //     event.preventDefault();
    //     $.ajax({
    //         url: $(this).attr('action'),
    //         type: $(this).attr('method'),
    //         data: $(this).serialize(),
    //         success: (response) => {

    //             console.log(response)
    //         },
    //         error: (error) => {
    //             console.log(error);
    //         }
    //     });
    // });


    $(document).ready(function() {

    });
</script>
@endsection