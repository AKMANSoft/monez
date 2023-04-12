<?php

namespace App\Http\Controllers;

use App\AdvertiserBankDetail;
use App\AdvertiserReportColumn;
use App\AdvertiserReportType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Advertiser;
use App\Country;
use App\State;
use App\City;
use App\Bank;
use App\TeamMember;
use Illuminate\Support\Facades\Validator;

class AdvertiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisers = Advertiser::orderBy('id', 'desc')->get();
        // dd($advertisers);
        return view('advertiser.index', compact('advertisers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $banks = Bank::all();
        $teamMembers = TeamMember::all();
        $advertisers = Advertiser::all();

        $teamMemberIds = $teamMembers->pluck('id')->toArray();
        $assignedAdvertisers = Advertiser::whereIn('team_member_id', $teamMemberIds)->get();
        $assignedTeamMemberIds = $assignedAdvertisers->pluck('team_member_id')->toArray();
        $availableTeamMembers = TeamMember::whereNotIn('id', $assignedTeamMemberIds)->get();

        // dd($availableTeamMembers);
        return view('advertiser.create', compact('countries','availableTeamMembers', 'states', 'cities', 'banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dfd('test');
        $validatedData = $request->validate([
            'dbaId' => 'required',
            'companyName'  => 'required',
            'url' => 'required',
            'accEmail' => 'required',
            'password' => 'required',
            'address1' => 'required',
            'city_id' => 'required',
            'country_id' => 'required',
            'amFirstName' => 'required',
            'amLastName' => 'required',
            'amEmail' => 'required',
            'revSharePer' => 'required',
            'paymentTerms' => 'required',
            //            'reportEmail' => 'required',
            //            'agreementDoc' => 'required|max:2048|mimes:pdf,pdf',
            //            'document' => 'required|max:2048|mimes:pdf,pdf',
        ]);
        $Ios = [];
        if ($request->hasFile('ios')) {
            foreach ($request->file('ios') as $io) {
                $ioName = $io->getClientOriginalName();
                $dbaId = $request->dbaId;
                $agreementDoc = $dbaId . "-" . time() . $ioName;
                $io->move(public_path('assets/files/uploads/ios/' . $dbaId . ''), $agreementDoc);
                $Ios[] = $agreementDoc;
            }
        } else {
            $agreementDoc = "Not Delivered";
        }
        $Documents = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $document) {
                $documentName = $document->getClientOriginalName();
                $dbaId = $request->dbaId;
                $documentFile = $dbaId . "-" . time() . $documentName;
                $document->move(public_path('assets/files/uploads/document/' . $dbaId . ''), $documentFile);
                $Documents[] = $documentFile;
            }
        } else {
            $document = "Not Delivered";
        }

        $adv = new Advertiser;

        $adv->dbaId = $request->dbaId;
        $adv->companyName = $request->companyName;
        $adv->regId = $request->regId;
        $adv->vat = $request->vat;
        $adv->url = $request->url;
        $adv->accEmail = $request->accEmail;
        $adv->password = $request->password;
        $adv->billEmail = $request->billEmail;
        $adv->reportEmail = $request->reportEmail;
        $adv->address1 = $request->address1;
        $adv->address2 = $request->address2;
        $adv->city_id = $request->city_id;
        $adv->state_id = $request->state_id;
        $adv->country_id = $request->country_id;
        $adv->zipCode = $request->zipCode;
        $adv->amFirstName = $request->amFirstName;
        $adv->amLastName = $request->amLastName;
        $adv->amEmail = $request->amEmail;
        $adv->amPhone = $request->amPhone;
        $adv->amSkype = $request->amSkype;
        $adv->amLinkedIn = $request->amLinkedIn;
        $adv->agreementDoc = implode(",", $Ios);
        $adv->revSharePer = $request->revSharePer;
        $adv->paymentTerms = $request->paymentTerms;
        $adv->payoneer = $request->payoneer;
        $adv->paypal = $request->paypal;
        $adv->document = implode(',', $Documents);
        $adv->notes = $request->notes;
        $adv->agreement_start_date = $request->AgreementStartDate;
        $adv->team_member_id = $request->team_member_id;
        // dd($adv);
        $adv->save();

        $bankDetails = new AdvertiserBankDetail;
        $bankDetails->advertiser_id = $adv->id;
        $bankDetails->beneficiary_name = $request->beneficiaryName;
        $bankDetails->beneficiary_address = $request->beneficiaryAddress;
        $bankDetails->bank_name = $request->bankName;
        $bankDetails->bank_address = $request->bankAddress;
        $bankDetails->account_number = $request->accountNumber;
        $bankDetails->routing_number = $request->routingNumber;
        $bankDetails->iban = $request->iban;
        $bankDetails->swift = $request->swift;
        $bankDetails->currency = $request->currency;
        $bankDetails->save();


        //updating bank id
        $lastId = $bankDetails->id;
        // print_r($lastId);
        // if ($lastId !== null) {
        //     $lastId = $lastId->bank_id;
        //     $lastId++;
        //     $newId =$lastId;
        // } else {
        //     $newId ='1';
        // }
        $advertiser =Advertiser::where('id', $adv->id)->first();
        $advertiser->bank_id = $lastId;
       
        $advertiser->update();
        // dd($advertiser);


        $advertiserReportColumn = new AdvertiserReportColumn;
        $advertiserReportColumn->advertiser_id = $adv->id;
        $advertiserReportColumn->date = $request->dateColValue;
        $advertiserReportColumn->feed = $request->feedColValue;
        $advertiserReportColumn->subid = $request->subidColValue;
        $advertiserReportColumn->country = $request->countryColValue;
        $advertiserReportColumn->total_searches = $request->totalSearchesColValue;
        $advertiserReportColumn->monitized_searches = $request->monitizedSearchesColValue;
        $advertiserReportColumn->paid_clicks = $request->paidClicksColValue;
        $advertiserReportColumn->revenue = $request->revenueColValue;
        $advertiserReportColumn->save();

        $advertiserReportType = new AdvertiserReportType();
        $advertiserReportType->advertiser_id = $adv->id;
        $advertiserReportType->report_type = $request->reportType;
        $advertiserReportType->api_key = $request->apiKey;
        $advertiserReportType->dashboard_path = $request->dashboardPath;
        $advertiserReportType->email = $request->email;
        $advertiserReportType->password = $request->password;
        $advertiserReportType->gdriveEmail = $request->gdriveEmail;
        $advertiserReportType->gdrivePassword = $request->gdrivePassword;
        $advertiserReportType->save();
        return view('advertiser.index')->with('success', 'Advertiser Form Data Has Been Inserted Successfuly:');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function view(Advertiser $advertiser)
    {
        $countries = Country::all();
        $banks = Bank::all();
        $teamMembers = TeamMember::all();
        $selectedteam = $advertiser->team_member_id;
        $teamMemberIds = $teamMembers->pluck('id')->toArray();
        $assignedAdvertisers = Advertiser::whereIn('team_member_id', $teamMemberIds)->get();
        $assignedTeamMemberIds = $assignedAdvertisers->pluck('team_member_id')->toArray();
        $availableTeamMembers = TeamMember::whereNotIn('id', $assignedTeamMemberIds)->get();
        return view('advertiser.edit', compact('advertiser','availableTeamMembers', 'countries', 'banks','selectedteam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertiser $advertiser)
    {
        $countries = Country::all();
        $banks = Bank::all();
        $selectedteam = $advertiser->team_member_id;
        return view('advertiser.edit', compact('advertiser', 'countries', 'banks','selectedteam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertiser $advertiser)
    {
        $validatedData = $request->validate([
            'dbaId' => 'required',

        ]);

        $advertiser->dbaId = $request->dbaId;
        $advertiser->companyName = $request->companyName;
        $advertiser->regId = $request->regId;
        $advertiser->vat = $request->vat;
        $advertiser->url = $request->url;
        $advertiser->accEmail = $request->accEmail;
        $advertiser->password = $request->password;
        $advertiser->billEmail = $request->billEmail;
        $advertiser->reportEmail = $request->reportEmail;
        $advertiser->address1 = $request->address1;
        $advertiser->address2 = $request->address2;
        $advertiser->city_id = $request->city_id;
        $advertiser->state_id = $request->state_id;
        $advertiser->country_id = $request->country_id;
        $advertiser->zipCode = $request->zipCode;
        $advertiser->amFirstName = $request->amFirstName;
        $advertiser->amLastName = $request->amLastName;
        $advertiser->amEmail = $request->amEmail;
        $advertiser->amPhone = $request->amPhone;
        $advertiser->amSkype = $request->amSkype;
        $advertiser->amLinkedIn = $request->amLinkedIn;

        //old data
        $oldIos = $advertiser->agreementDoc;
        $oldDocuments = $advertiser->document;
        $Ios = [];
        if ($request->hasFile('ios')) {
            foreach ($request->file('ios') as $io) {
                $ioName = $io->getClientOriginalName();
                $dbaId = $request->dbaId;
                $agreementDoc = $dbaId . "-" . time() . $ioName;
                $io->move(public_path('assets/files/uploads/ios/' . $dbaId . ''), $agreementDoc);
                $Ios[] = $agreementDoc;
            }
        } else {
            $agreementDoc = "Not Delivered";
        }
        $Documents = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $document) {
                $documentName = $document->getClientOriginalName();
                $dbaId = $request->dbaId;
                $documentFile = $dbaId . "-" . time() . $documentName;
                $document->move(public_path('assets/files/uploads/document/' . $dbaId . ''), $documentFile);
                $Documents[] = $documentFile;
            }
        } else {
            $document = "Not Delivered";
        }
        $advertiser->agreementDoc = implode(',', array_merge(explode(',', $oldIos), $Ios));
        $advertiser->document = implode(',', array_merge(explode(',', $oldDocuments), $Documents));
        // $advertiser->agreementDoc = implode(',', $Ios);
        $advertiser->revSharePer = $request->revSharePer;
        $advertiser->paymentTerms = $request->paymentTerms;
        $advertiser->bank_id = $request->bank;
        $advertiser->payoneer = $request->payoneer;
        $advertiser->paypal = $request->paypal;
        // $advertiser->document = implode(',', $Documents);
        $advertiser->notes = $request->notes;
        $advertiser->agreement_start_date = $request->AgreementStartDate;

        // dd($advertiser);
        $advertiser->update();

        return redirect()->route('advertiser.index')->with('success', 'Advertiser Form Data Has Been Updated Successfuly:');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertiser $advertiser)
    {
        $advertiser->delete();

        return redirect()->route('advertiser.index');
    }

    public function checkUniqueDbId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'input_field' => 'unique:advertisers,dbaid',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'The value is not unique.']);
        }

        return response()->json(['status' => 'success']);
    }


    public function DownloadPdf(Request $request, $id, $pdf, $name)
    {
        $advertiser = Advertiser::where('id', $id)->first();
        $document = $advertiser->document;
        $dbaId = $advertiser->dbaId;
        $filePath = public_path('assets/files/uploads/document/' . $dbaId . '/' . $name);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }

    public function accountInfo(Request $request,Advertiser $advertiser , $currentedit){
        // dd($currentedit);
        $countries = Country::all();
        $banks = Bank::all();
        $teamMembers = TeamMember::all();
        $selectedteam = $advertiser->team_member_id;
        $teamMemberIds = $teamMembers->pluck('id')->toArray();
        $assignedAdvertisers = Advertiser::whereIn('team_member_id', $teamMemberIds)->get();
        $assignedTeamMemberIds = $assignedAdvertisers->pluck('team_member_id')->toArray();
        $availableTeamMembers = TeamMember::whereNotIn('id', $assignedTeamMemberIds)->get();
        return view('advertiser.edit', compact('advertiser','availableTeamMembers', 'countries', 'banks'));
    }
}
