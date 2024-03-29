<?php

namespace App\Http\Controllers;

use App\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Country;
use App\State;
use App\City;
use App\Bank;
use Illuminate\Support\Facades\Validator;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $teamMembers = DB::table('team_members')
        //     ->leftJoin('advertisers', 'team_members.id', '=', 'advertisers.team_member_id')->get();
        $teamMembers= TeamMember::orderBy('created_at', 'desc')->get();
        
            // dd($teamMembers);
        return view('teammembers.index',compact('teamMembers'));
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

        return view('teammembers.create', compact('countries', 'states', 'cities', 'banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('test');
        $validatedData = $request->validate([
            'name'  => 'required',
            'email' => 'required',
            'password'=> 'required',
            'amPhone'=>'required',
            // 'skype'=> 'required',
            // 'linkedin'=> 'required',
        ]);
        // dd($validatedData);
        $teamMember = new TeamMember();
        // dd($validatedData);
        $teamMember->name = $request->name;
        $teamMember->email = $request->email;
        $teamMember->password = $request->password;
        $teamMember->skype = $request->skype;
        $teamMember->linkedin = $request->linkedin;
        $teamMember->amPhone = $request->amPhone;
        $teamMember->country_code = $request->country_code;
        // dd($teamMember);
        $teamMember->save();
        // $teamMember->create($validatedData);
        return redirect()->route('team-members.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = TeamMember::query()->where('id',$id)->first();
        return view('teammembers.edit',compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamMember $teamMember)
    {
        $countries = Country::all();
        $banks = Bank::all();
        $selectedcountry = $teamMember->country_code;
        return view('teammembers.create', compact('teamMember','selectedcountry', 'countries', 'banks'));
    }

    public function view(TeamMember $teamMember)
    {
        $currentUrl = url()->current();
        $segments = request()->segments();
        $lastSegment = last($segments);
        $teamMember = TeamMember::where('id', $lastSegment)->firstOrFail();
        $countries = Country::all();
        $banks = Bank::all();
        $selectedcountry = $teamMember->country_code;
        return view('teammembers.create', compact('teamMember','selectedcountry', 'countries', 'banks'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkUniqueteamEmail(Request $request)
    {
        $id = $request->teammember_id;
        $validator = Validator::make($request->all(), [
            'input_field' => 'unique:team_members,email',
        ]);
        // $validator = Validator::make($request->all(), [
        //     'input_field' => [
        //         'email',
        //         Rule::unique('team_members', 'email')->ignore(Auth::id())
        //     ]
        // ]);
        
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'The email is already used.']);
        }
        
        return response()->json(['status' => 'success']);
        

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'The email is already used.']);
        }

        return response()->json(['status' => 'success']);
    }

    public function checkUniqueteamPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'input_field' => 'unique:team_members,amPhone',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'The Phone# is already used.']);
        }

        return response()->json(['status' => 'success']);
    }
    public function update(Request $request, $id)
    {
        $members = TeamMember::query()->where('id',$id)->first();
        $members->name = $request->name;
        $members->email = $request->email;
        $members->password = $request->password;
        $members->skype = $request->skype;
        $members->linkedin = $request->linkedin;
        $members->amPhone = $request->amPhone;
        $members->country_code = $request->country_code;
        // dd($members);
        $members->update();
        return redirect()->route('team-members.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = TeamMember::findOrFail($id);
        $member->delete();
        return redirect()->route('team-members.index');


    }

    
}
