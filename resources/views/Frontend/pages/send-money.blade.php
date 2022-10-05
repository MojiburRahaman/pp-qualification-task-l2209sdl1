@extends('Frontend.master')

@section('title','Add-Money')
@section('content')

<div class="col-lg-6 m-lg-auto col-12 col-md-12">


    <!-- Default Card Example -->
    <div class="card mb-4">
        <div class="card-header">
            Send Money
        </div>
        <div class="card-body"> 
            @if (session()->get('error'))
                
            <div class="alert alert-danger">
                {{session()->get('error')}}
            </div>
            @endif
            <form action="{{ route('SendMoneyPost') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">User Email</label>
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
                <div class="form-group">
                   <button type="submit" class="btn btn-success">Add Money</button>
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
</script>
@endsection