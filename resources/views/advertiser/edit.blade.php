@extends('layouts.vertical', ['title' => 'Advertisers Profile'])

@section('content')
@php
$condition='view';
$currentUrl = url()->current();
$segments = request()->segments();
$lastSegment = last($segments);
$paymentTermsValues=config('constant.payment_terms_values');
$currencyList=config('constant.currency_list');
$reportTypes=config('constant.report_type');
@endphp
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 text-uppercaset"><i class="mdi mdi-office-building me-1"></i> Advertiser Info</h4>
                @include('advertiser.edit-form')
                
            </div>
        </div>
    </div>
</div>

@endsection