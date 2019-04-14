@extends('layouts.app')

@section('css')
<style type="text/css">
    .center-block {
        margin: 5px auto;
        text-align: center;
        display: block;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <form method="POST" id="formNumber" action="{{ route('get.student_data') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" id="s_number" name="s_number" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="Get the data">
            </div>
        </form>
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

                <div class="panel-body">
                    Data Goes here
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#formNumber').on('submit', function(e) {
        e.preventDefault();

        var number = $('#s_number').val();
        // alert(number);

        $.ajax({
            url: "{{ route('get.student_data') }}",
            type: 'POST',
            data: {'_token': "{{ csrf_token() }}", 's_number': number},
            success: function(data) {
                console.log(data);
            }
        });
    })
</script>
@endsection
