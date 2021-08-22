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
                                <div class="col">
                                    <label for="">Select Currency</label>
                                    <select name="currency" id="" class="custom-select" required>
                                        @foreach($currencies as $currency)
                                            <option value="{{$currency->iso}}">{{strtoupper($currency->iso)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-2">
                                    <label for="">Select Payment Platform</label>
                                    <div class="form-group">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            @foreach($paymentPlatforms as $paymentPlatform)
                                                <label for="" class="btn btn-outline-secondary rounded m-2 p-1">
                                                    <input type="radio" name="payment_platform" value="{{$paymentPlatform->id}}" required>
                                                    <img class="img-thumbnail" src="{{asset($paymentPlatform->image)}}" alt="">
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
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
