@extends('admin.layouts.app')

@section('content')
    <section class="main-wrapper">
        <div class="upperboxs">
            <div class="row">
                <div class="col-sm-4">
                    <a href="{{ url('providers') }}" style="text-decoration:none">
                        <div class="box box1">
                            <h2>50</h2>
                            <p>Certified Providers</p>
                            <div class="box-icon">
                                <img class="logo-compact" src="{{ asset('assets/images/provider-dash.png') }}" alt="">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('applicators') }}" style="text-decoration:none">
                        <div class="box box2">
                            <h2>50</h2>
                            <p>Certified Applicators</p>
                            <div class="box-icon">
                                <img class="logo-compact" src="{{ asset('assets/images/applicator-dash.png') }}"
                                    alt="">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('equipment') }}" style="text-decoration:none">
                        <div class="box box3">
                            <h2>50</h2>
                            <p>Registered Equipment</p>
                            <div class="box-icon">
                                <img class="logo-compact" src="{{ asset('assets/images/equipments-dash.png') }}"
                                    alt="">
                            </div>
                        </div>
                    </a>
                </div>
                <!--div class="col-sm-3">
                    <a href="{{ url('claims') }}" style="text-decoration:none">
                        <div class="box box4">
                            <h2>50</h2>
                            <p>Warranty Claims</p>
                            <div class="box-icon">
                                <img class="logo-compact" src="{{ asset('assets/images/claims-dash.png') }}" alt="">
                            </div>
                        </div>
                    </a>
                </div-->
            </div>
        </div>
        <div class="col-12">
            <div class="card">

                <div class="card-body table-outer table-no-space">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>QR Number</th>
                                    <th>Certified Providers</th>
                                    <th>Certification Id</th>
                                    <th>Application Date</th>
                                    <th>Inspection History</th>
                                    <th>Days Since</th>
                                    <th>Days Since Last Inspection</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>21212121</td>
                                    <td>xyz company</td>
                                    <td>#56565656</td>
                                    <td>20/12/2024</td>
                                    <td>asfsdfsadfsd</td>
                                    <td> 10 Days </td>
                                    <td> 20/08/2023</td>
                                </tr>
                                <tr>
                                    <td>21212121</td>
                                    <td>xyz company</td>
                                    <td>#56565656</td>
                                    <td>20/12/2024</td>
                                    <td>asfsdfsadfsd</td>
                                    <td> 10 Days </td>
                                    <td> 20/08/2023</td>
                                </tr>
                                <tr>
                                    <td>21212121</td>
                                    <td>xyz company</td>
                                    <td>#56565656</td>
                                    <td>20/12/2024</td>
                                    <td>asfsdfsadfsd</td>
                                    <td> 10 Days </td>
                                    <td> 20/08/2023</td>
                                </tr>
                                <tr>
                                    <td>21212121</td>
                                    <td>xyz company</td>
                                    <td>#56565656</td>
                                    <td>20/12/2024</td>
                                    <td>asfsdfsadfsd</td>
                                    <td> 10 Days </td>
                                    <td> 20/08/2023</td>
                                </tr>
                                <tr>
                                    <td>21212121</td>
                                    <td>xyz company</td>
                                    <td>#56565656</td>
                                    <td>20/12/2024</td>
                                    <td>asfsdfsadfsd</td>
                                    <td> 10 Days </td>
                                    <td> 20/08/2023</td>
                                </tr>
                                <tr>
                                    <td>21212121</td>
                                    <td>xyz company</td>
                                    <td>#56565656</td>
                                    <td>20/12/2024</td>
                                    <td>asfsdfsadfsd</td>
                                    <td> 10 Days </td>
                                    <td> 20/08/2023</td>
                                </tr>
                                <tr>
                                    <td>21212121</td>
                                    <td>xyz company</td>
                                    <td>#56565656</td>
                                    <td>20/12/2024</td>
                                    <td>asfsdfsadfsd</td>
                                    <td> 10 Days </td>
                                    <td> 20/08/2023</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--charts-->
        <!--div class="row">
            <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Warranty Claims</h4>
                    </div>
                    <div class="card-body">
                        <div id="animating-donut" class="ct-chart ct-golden-section chartlist-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">QR Codes Status</h4>
                    </div>
                    <div class="card-body">
                        <div id="animating-donut" class="ct-chart ct-golden-section chartlist-chart"></div>
                    </div>
                </div>
            </div>
        </div-->

    </section>
@endsection
