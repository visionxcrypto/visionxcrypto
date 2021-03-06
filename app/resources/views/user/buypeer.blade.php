
@extends('include.userdashboard')

@section('content')

    <style>

        #clockdiv{
            font-family: sans-serif;
            color: #fff;
            display: inline-block;
            font-weight: 100;
            text-align: center;
            font-size: 30px;
        }

        #clockdiv > div{
            padding: 10px;
            border-radius: 3px;
            background: #00BF96;
            display: inline-block;
        }

        #clockdiv div > span{
            padding: 15px;
            border-radius: 3px;
            background: #00816A;
            display: inline-block;
        }

        .smalltext{
            padding-top: 5px;
            font-size: 16px;
        }
    </style>
    <<!-- Main Content-->
    <div class="main-content side-content pt-0">

        <div class="container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Make Payment</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">PeerToPeer</li>
                        </ol>
                    </div>

                </div>
                <!-- End Page Header -->

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card productdesc">
                            <div class="card-body h-100">
                                <div class="row">

                                    <div class="col-xl-6 col-lg-12 col-md-12">
                                        <div class="mt-4 mb-4">
                                            <h4 class="mt-1 mb-3">Bank Details</h4>


                                            <h5 class="mb-2">Bank Name <b>{{$data->bankname}}</b></h5>

                                            <h5 class="mb-2">Account Number <b>{{$data->accountnumber}}</b></h5>
                                            <h5 class="mb-2">Account Name <b>{{$data->accountname}}</b></h5>

                                            <hr>
                                            <h5 class="mb-2">Amount To Send <b>{{$basic->currency_sym}}{{number_format($data->main_amo,2)}}</b></h5>


                                            <h6 class="mt-4 fs-16 text-danger">Please ensure your are sending from your to hasten your transaction process</h6>
                                            <p class="text-danger">{{$basic->sitename}} will not be responsible for any loss arising from you funding a wrong account number other than the one provided on this page</p>


                                        </div>
                                        <p>Click on the I have paid button below to complete your transaction.</p><br>

                                        <h1 id="title">Countdown Clock</h1>
                                        <div id="clockdiv">
                                            <div>
                                                <span class="days"></span>
                                                <div class="smalltext">Days</div>
                                            </div>
                                            <div>
                                                <span class="hours"></span>
                                                <div class="smalltext">Hours</div>
                                            </div>
                                            <div>
                                                <span class="minutes"></span>
                                                <div class="smalltext">Minutes</div>
                                            </div>
                                            <div>
                                                <span class="seconds"></span>
                                                <div class="smalltext">Seconds</div>
                                            </div>
                                        </div>

                                        <div class="text-center mt-4 mb-4 btn-list">
                                            <a href="#" data-toggle="modal" data-target="#pay-confirm" class="btn ripple btn-primary"><i class="fe fe-check"> </i>I Have Paid</a>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- End Row -->
                </div>
            </div>
        </div>
        <!-- End Main Content-->



        <!-- Select2 modal -->
        <form role="form" method="POST"  action="{{ route('ebuypeerpaid') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="modal" id="pay-confirm">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Are You Sure You Have Paid?</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <!-- Select2 -->
                            <div class="withdraw-address">


                                <br>
                                <div class="withdraw-address">
                                    <small>Upload Proof Of Payment Screenshot</small>
                                    <div class="input-group file-browser">
                                        <input type="text" class="form-control border-right-0 browse-file" placeholder="choose" readonly>
                                        <label class="input-group-btn">
														<span class="btn btn-primary">
															Browse <input  name="photo" type="file" required style="display: none;" multiple>
														</span>
                                        </label>
                                    </div>
                                </div>




                                <!-- Select2 -->

                            </div>
                            <div class="modal-footer">

                                <input name="trx" hidden value="{{$data->trx}}">

                                <button class="btn ripple btn-primary" type="submit">Proceed</button>
                                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
        <!-- End Select2 modal -->
    </div></div></div></div>

    <script>
        function getTimeRemaining(endtime) {
            const total = Date.parse(endtime) - Date.parse(new Date());
            const seconds = Math.floor((total / 1000) % 60);
            const minutes = Math.floor((total / 1000 / 60) % 60);
            const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
            const days = Math.floor(total / (1000 * 60 * 60 * 24));

            return {
                total,
                days,
                hours,
                minutes,
                seconds
            };
        }

        function initializeClock(id, endtime) {
            const clock = document.getElementById(id);
            const daysSpan = clock.querySelector('.days');
            const hoursSpan = clock.querySelector('.hours');
            const minutesSpan = clock.querySelector('.minutes');
            const secondsSpan = clock.querySelector('.seconds');

            function updateClock() {
                const t = getTimeRemaining(endtime);

                daysSpan.innerHTML = t.days;
                hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                if (t.total <= 0) {
                    document.getElementById('title').innerHTML="EXPIRED DO NOT PAY AGAIN";
                    document.getElementById('title').style="color:red";
                    clearInterval(timeinterval);
                }
            }

            updateClock();
            const timeinterval = setInterval(updateClock, 1000);
        }

        const deadline = new Date(Date.parse("{{$data->timeout}}") + 15 * 60 * 1000);
        initializeClock('clockdiv', deadline);
    </script>

@endsection
