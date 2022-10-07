@extends('Frontend.master')

@section('title','Cash Out')
@section('content')

<div class="col-lg-6 m-lg-auto col-12 col-md-12">
    <!-- Default Card Example -->
    <div class="card mb-4">
        <div class="card-header">
            Cash Out
        </div>
        <div class="card-body">
            @if (session()->get('error'))

            <div class="alert alert-danger">
                {{session()->get('error')}}
            </div>
            @endif
            <form action="{{ route('CashOutViewpost') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Agent User Email</label>
                    <input type="email" name="email" class="form-control" id="email">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" class="form-control" id="amount">
                    @error('amount')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group" id="nidform" style="display: none">
                    <label for="nid">Nid</label>
                    <input type="number" name="nid" class="form-control" id="nid" disabled>
                    @error('nid')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Cash Out</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@section('script_js')
<script>
    @if (session('success'))
        
    Command: toastr["success"]('{{session('success')}}')
    @endif

    
    const amount = $('#amount').val();
  if (amount >= 17514.23) {
     $('#nidform').show();
     document.getElementById("nid").disabled = false;
     document.getElementById("nid").required =true;
    }else{
        
        $('#nidform').hide();
        document.getElementById("nid").required =false;
        document.getElementById("nid").disabled = true;
    }

    $('#amount').keyup(function(){
    const amount = $('#amount').val();
  if (amount >= 17514.23) {
     $('#nidform').show();
     document.getElementById("nid").disabled = false;
     document.getElementById("nid").required =true;
    }else{
        
        $('#nidform').hide();
        document.getElementById("nid").required =false;
        document.getElementById("nid").disabled = true;
    }
    
});
</script>
@endsection