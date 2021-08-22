@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Payment</div>

                    <div class="card-body">
                        <form action="#" method="post" id="paymentForm">
                            <div class="row">
                                <div class="col">
                                    <label for="">How much you want to pay?</label>
                                    <input type="number" min="5" step="0.01" class="form-control" name="values"
                                           value="{{mt_rand(500,100000)/100}}">
                                    <small class="form-text text-muted">
                                        Use values with up to tow decimal positions,using dot "."
                                    </small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center mt-2">
                                    <button class="btn btn-primary" type="submit">Pay</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
