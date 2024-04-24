@extends('admin.layouts.app')

@section('content')
    <section class="main-wrapper">
        <div class="upperboxs">
            <div class="row">
                <div class="col-sm-4">
                    <a href="{{ url('providers') }}" style="text-decoration:none">
                        <div class="box box1">
                            <h2>{{ $counts['certified_providers'] }}</h2>
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
                            <h2>{{ $counts['certified_applicators'] }}</h2>
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
                            <h2>{{ $counts['registered_qr_codes'] }}</h2>
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
                        <table id="DashboardTable" class="display min-w850">
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
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>QR Number</th>
                                    <th>Certified Providers</th>
                                    <th>Certification Id</th>
                                    <th>Application Date</th>
                                    <th>Inspection History</th>
                                    <th>Days Since</th>
                                    <th>Days Since Last Inspection</th>
                                </tr>
                            </tfoot>                            
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
@push('scripts')
<script>
    (function($) {
			let DashboardTable = $('#DashboardTable').DataTable({
                language: {
                    lengthMenu: "Show _MENU_ entries",
                    paginate: {
                        "previous": "Previous",
                        "next": "Next"
                    }
                },
                pagingType: "simple_numbers",
                lengthMenu: [ 5, 10, 25, 50, 100],
                pageLength: 10,
				fixedColumns: false,
                processing: true,
                responsive: true,
                serverSide: true,
				ajax: {
                        url: "{!! route('admin.registered-equipments.index') !!}",
                        type: "GET",
						dataType: 'json',
                    },
                order: [[0, 'asc']],
                columnDefs: [
                    { orderable: false, "targets": [4, 5, 6 ] },
                    { searchable: false, "targets": [4, 5, 6] },
                ],
                columns: [
                    {data: 'equipment_qr_id',name: 'equipment_qr_id'},
					{data: 'certified_providers.provider_name',name: 'provider_name'},
                    {data: 'certified_applicators.applicator_certification_id', name: 'applicator_certification_id'},
                    {data: 'created_at',name:'created_at'},
					{
                        data: null,
                        render: function (data, type, row, meta) {
                            let applicator_id = row.applicator_id;
                            let baseUrl = "{{ route('admin.applicators.show', '') }}";
                            return `<a href="https://dev.infiniguard.com/inspection-record">No Maintenance Recorded</a>`;
                        }
                    },
                    {data: 'created_at',name:'created_at'},
                    {data: 'created_at',name:'created_at'},
                ]
            });
            $('#example tbody').on('click', 'tr', function() {
                var data = table.row(this).data();
            });
        })(jQuery);
</script>
@endpush