@extends('layouts.admin')

@section('content')
<div class="container">
@if (Session::has('error') )
 <p class="alert alert-danger">
  {{ $error }} 
 </p> 
 @endif
 <h1 class="text-center">Register Real Property Tax Receipt</h1>
 <form action="{{ route('record-real-property-tax-receipt', $accountable_form_id) }}" method="post">
  @csrf

  <input type="text" name="accountable_form_id" value="{{ $accountable_form_id }}" id="accountable_form_id" hidden>
  <input type="text" name="accountable_form_type_id" value="{{ $accountable_form_id }}" id="accountable_form_id" hidden>

  <p class="alert alert-info">Payor: {{ $accountableForm->payor }}</p>
  <div class="form-group">
   <label for="receipt_no_pf_no_25">Receipt No. P.F. No. 25</label>
   <input type="number" name="receipt_no_pf_no_25" value="{{ old('receipt_no_pf_no_25') }}" id="receipt_no_pf_no_25" class="form-control" autofocus>
   @error('receipt_no_pf_no_25')
   <div class="text-danger mt-2 text-sm">
    {{ $message }}
   </div>
  @enderror
  </div>

  <div class="form-group">
   <label for="period_covered">Period Covered</label>
   <input type="text" name="period_covered" value="{{ old('period_covered')  }}" id="period_covered" class="form-control" autofocus>
   @error('period_covered')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

  <div class="form-group">
   <label for="classification">Classification</label>
   <input type="text" name="classification" value="{{ old('classification')  }}" id="classification" class="form-control" autofocus>
   @error('classification')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

  <div class="form-group">
   <label for="tax_declaration_no">Tax Declaration Number</label>
   <input type="text" name="tax_declaration_no" value="{{ old('tax_declaration_no')  }}"  class="form-control" autofocus> 
   @error('tax_declaration_no')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

  <!-- <div class="form-check">
    <input type="checkbox" class="form-check-input" id="formCheck">
    <label class="form-check-label" for="exampleCheck1">I checked that the values are correct.</label>
</div> -->

<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="customSwitch1" name="is_reviewed" value="1">
        <label class="custom-control-label text-danger" for="customSwitch1">I checked that the values are correct.</label>
    </div>
</div>



  <button class="btn btn-primary btn-lg">Assign to Collector</button>
 </form>
</div>
@endsection