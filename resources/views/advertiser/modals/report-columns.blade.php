   {{-- Start of Report Columns Modal  --}}
   <div class="modal fade" id="define-report-columns-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-modal="true" role="dialog">
       <div class="modal-dialog modal-lg">
           <div class="modal-content shadow shadow-5">
               <form id="reportColumnsForm" action="{{ route('store.reportcolumns') }}" method="POST" class="needs-validation" novalidate>
                   @csrf
                   <div class="modal-header border-bottom">
                       <h5 class="text-uppercase modal-title">Add Report Columns</h5>
                       <button type="button" class="btn p-0" data-dismiss="modal" aria-label="Close">
                           <h3 class="fe-x m-0"></h3>
                       </button>
                   </div>
                   <div class="modal-body modal-scroll">
                       <div class="row">
                           <div class="col-md-6 mb-3">
                               <label for="dateKey" class="form-label">Key</label>
                               <input type="text" class="form-control" disabled value="date" id="dateKey" name="dateKey">
                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">
                                   You must enter valid input
                               </div>
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="dateColValue" class="form-label">Value</label>
                               <input type="text" class="form-control" id="dateColValue" @if($lastSegment!='view' ) @else disabled @endif value="{{ $advertiser->reportColumns->date ??  old('date') }}" name="dateColValue">
                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">
                                   You must enter valid input
                               </div>
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="feedKey" class="form-label">Key</label>
                               <input type="text" class="form-control" disabled value="feed" id="feedKey" name="feedKey">
                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">
                                   You must enter valid input
                               </div>
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="feedColValue" class="form-label">Value</label>
                               <input type="text" class="form-control" id="feedColValue" @if($lastSegment!='view' ) @else disabled @endif value="{{ $advertiser->reportColumns->feed ??  old('feed') }}" name="feedColValue">
                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">
                                   You must enter valid input
                               </div>
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="subidKey" class="form-label">Key</label>
                               <input type="text" class="form-control" disabled value="subid" id="subidKey" name="subidKey">
                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">
                                   You must enter valid input
                               </div>
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="subidColValue" class="form-label">Value</label>
                               <input type="text" class="form-control" id="subidColValue" @if($lastSegment!='view' ) @else disabled @endif value="{{ $advertiser->reportColumns->subid ??  old('subid') }}" name="subidColValue">
                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">
                                   You must enter valid input
                               </div>
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="countryKey" class="form-label">Key</label>
                               <input type="text" class="form-control" disabled value="country" id="countryKey" name="countryKey">
                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">
                                   You must enter valid input
                               </div>
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="countryColValue" class="form-label">Value</label>
                               <input type="text" class="form-control" id="countryColValue" @if($lastSegment!='view' ) @else disabled @endif value="{{ $advertiser->reportColumns->country ??  old('country') }}" name="countryColValue">
                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">
                                   You must enter valid input
                               </div>
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="totalSearchesKey" class="form-label">Key</label>
                               <input type="text" class="form-control" disabled value="total searches" id="totalSearchesKey" name="totalSearchesKey">
                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">
                                   You must enter valid input
                               </div>
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="totalSearchesColValue" class="form-label">Value</label>
                               <input type="text" class="form-control" id="totalSearchesColValue" @if($lastSegment!='view' ) @else disabled @endif value="{{ $advertiser->reportColumns->total_searches ??  old('total_searches') }}" name="totalSearchesColValue">
                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">
                                   You must enter valid input
                               </div>
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="monitizedSearchesKey" class="form-label">Key</label>
                               <input type="text" class="form-control" disabled value="monitized searches" id="monitizedSearchesKey" name="monitizedSearchesKey">
                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">
                                   You must enter valid input
                               </div>
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="monitizedSearchesColValue" class="form-label">Value</label>
                               <input type="text" class="form-control" id="monitizedSearchesColValue" @if($lastSegment!='view' ) @else disabled @endif value="{{ $advertiser->reportColumns->monitized_searches ??  old('monitized_searches') }}" name="monitizedSearchesColValue">
                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">
                                   You must enter valid input
                               </div>
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="paidClicksKey" class="form-label">Key</label>
                               <input type="text" class="form-control" disabled value="paid clicks" id="paidClicksKey" name="paidClicksKey">
                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">
                                   You must enter valid input
                               </div>
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="paidClicksColValue" class="form-label">Value</label>
                               <input type="text" class="form-control" id="paidClicksColValue" @if($lastSegment!='view' ) @else disabled @endif value="{{ $advertiser->reportColumns->paid_clicks ??  old('paid_clicks') }}" name="paidClicksColValue">
                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">
                                   You must enter valid input
                               </div>
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="revenueKey" class="form-label">Key</label>
                               <input type="text" class="form-control" disabled value="revenue" id="revenueKey" name="revenueKey">
                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">
                                   You must enter valid input
                               </div>
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="revenueColValue" class="form-label">Value</label>
                               <input type="text" class="form-control" id="revenueColValue" @if($lastSegment!='view' ) @else disabled @endif value="{{ $advertiser->reportColumns->revenue ??  old('revenue') }}" name="revenueColValue">
                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">
                                   You must enter valid input
                               </div>
                           </div>

                       </div>
                   </div>
                   <div class="modal-footer border-top">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                       @if($lastSegment!='view')
                       <button type="submit" class="btn btn-primary">Save Details</button>
                       @endif
                   </div>
               </form>
           </div>
       </div>
   </div>{{-- End of Report Columns Modal  --}}
