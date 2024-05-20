@extends('layouts.app')

@section('title', 'Admin Portal')

@section('content')

    <div class="page-wrapper">

        <header class="header">
            <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
                <div class="container">
                    <div class="header-left col-lg-2 w-auto pl-0">
                        <a href="" class="logo">
                            <img src="{{ asset('assets/images/amby-logo.png') }}" width="111" height="44"
                                alt="Porto Logo">
                        </a>
                    </div><!-- End .header-left -->
                    <div class="header-right w-lg-max">
                        <div
                            class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                            <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                        </div>
                        <a href="{{ route('home') }}" class="btn btn-dark">Back to Cart</a>
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
        </header><!-- End .header -->

        <main class="main">
            <div class="container account-container custom-account-container">
                <div class="row">
                    <div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-2 order-0">
                        <h2 class="text-uppercase">Dashboard</h2>
                        <ul class="nav nav-tabs list flex-column mb-0" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link active" id="order-tab" data-toggle="tab" href="#order" role="tab"
                                    aria-controls="order" aria-selected="true">Transactions</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="">Logout</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-10 order-lg-last order-1 tab-content">


                        <div class="tab-pane fade show active" id="order" role="tabpanel">
                            <div class="order-content">
                                <h3 class="account-sub-title d-none d-md-block"><i
                                        class="sicon-social-dropbox align-middle mr-3"></i>Transactions</h3>
                                <div class="order-table-container text-center">


                                    <div class="dashboard-content">




                                        <div class="row row-lg">
                                            <div class="col-6 col-md-4">
                                                <div class="feature-box text-center pb-4">
                                                    <div class="feature-box-content">
                                                        <h3 style="color: #08C">ALL TRANSACTIONS</h3>
                                                    </div>
                                                    <h3 style="color: #08C">₦{{ number_format($totalTransactions, 2) }}</h3>
                                                </div>
                                            </div>




                                            <div class="col-6 col-md-4">
                                                <div class="feature-box text-center pb-4">
                                                    <div class="feature-box-content">
                                                        <h3 style="color: #08C">FLUTTERWAVE</h3>
                                                    </div>
                                                    <h3 style="color: #08C">₦{{ number_format($totalFlutterwave, 2) }}</h3>
                                                </div>
                                            </div>

                                            <div class="col-6 col-md-4">
                                                <div class="feature-box text-center pb-4">
                                                    <div class="feature-box-content">
                                                        <h3 style="color: #08C">PAYSTACK</h3>
                                                    </div>
                                                    <h3 style="color: #08C">₦{{ number_format($totalPaystack, 2) }}</h3>
                                                </div>
                                            </div>
                                        </div><!-- End .row -->
                                    </div>


                                    <div class="mb-4"></div>

                                    <div class="form-group form-group-sm">

                                        <form method="get" action="{{ route('dashboard') }}">
                                            <div class="row" style="gap: 1rem;">
                                                <div class="col-md-6">
                                                    <div class="select-custom">
                                                        <select class="form-control form-control-sm" name="date_filter">
                                                            <option value="">All Dates</option>
                                                            <option value="today"
                                                                {{ $dateFilter == 'today' ? 'selected' : '' }}>Today
                                                            </option>
                                                            <option value="yesterday"
                                                                {{ $dateFilter == 'yesterday' ? 'selected' : '' }}>
                                                                Yesterday</option>
                                                            <option value="this_week"
                                                                {{ $dateFilter == 'this_week' ? 'selected' : '' }}>
                                                                This Week</option>
                                                            <option value="last_week"
                                                                {{ $dateFilter == 'last_week' ? 'selected' : '' }}>
                                                                Last Week</option>
                                                            <option value="this_month"
                                                                {{ $dateFilter == 'this_month' ? 'selected' : '' }}>
                                                                This Month</option>
                                                            <option value="last_month"
                                                                {{ $dateFilter == 'last_month' ? 'selected' : '' }}>
                                                                Last Month</option>
                                                            <option value="this_year"
                                                                {{ $dateFilter == 'this_year' ? 'selected' : '' }}>
                                                                This Year</option>
                                                            <option value="last_year"
                                                                {{ $dateFilter == 'last_year' ? 'selected' : '' }}>
                                                                Last Year</option>
                                                        </select>
                                                    </div><!-- End .select-custom -->
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary">Filter</button>
                                                </div>

                                            </div>
                                        </form>

                                    </div>


                                    <div class="table-responsive">
                                        <table id="example" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Payment Method</th>
                                                    <th>Payment Type</th>
                                                    <th>Transaction Ref</th>
                                                    <th>Currency</th>
                                                    <th>Amount</th>
                                                    <th>Service Charge</th>
                                                    <th>status</th>
                                                    <th>Narration</th>
                                                    <th>Sender Email</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                @foreach ($transactions as $transaction)
                                                    <tr>
                                                        <td>{{ $transaction->payment_method }}</td>
                                                        <td>{{ $transaction->payment_type }}</td>
                                                        <td>{{ $transaction->tx_ref }}</td>
                                                        <td>{{ $transaction->currency }}</td>
                                                        <td>{{ $transaction->amount }}</td>
                                                        <td>{{ $transaction->app_fee }}</td>
                                                        <td>{{ $transaction->status }}</td>
                                                        <td>{{ $transaction->narration }}</td>
                                                        <td>{{ $transaction->user->email }}</td>
                                                        <td>{{ $transaction->created_at }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div><!-- End .tab-pane -->


                    </div><!-- End .tab-content -->
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-5"></div><!-- margin -->
        </main><!-- End .main -->

    </div><!-- End .page-wrapper -->


    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->




    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>


    <!-- jQuery UI JS -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>


    <script>
        new DataTable('#example');
    </script>

@endsection
