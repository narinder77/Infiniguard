@extends('admin.layouts.app')

@section('content')
    <section class="main-wrapper">
        <div class="upperboxs">
            <div class="row">
                <div class="col-sm-4">
                    <a href="{{ route('admin.providers.index') }}" style="text-decoration:none">
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
                    <a href="{{ route('admin.applicators.index') }}" style="text-decoration:none">
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
                    <a href="{{route('admin.registered-equipments.index') }}" style="text-decoration:none">
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
                                    <th>ID </th>
                                    <th>Provider ID </th>
                                    <th> Certified Providers </th>
                                    <th> Certified Providers Administrator </th>
                                    <th> Email </th>
                                    <th> Phone </th>
                                    <th> Certified Providers Status </th>
                                    <th> More Info </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID </th>
                                    <th>Provider ID </th>
                                    <th> Certified Providers </th>
                                    <th> Certified Providers Administrator </th>
                                    <th> Email </th>
                                    <th> Phone </th>
                                    <th> Certified Providers Status </th>
                                    <th> More Info </th>
                                    <th> Action </th>
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
            let sortOrderByColumn = '';
            let sortDirection='';
            let CertifiedProvider = $('#DashboardTable').DataTable({
                language: {
                    lengthMenu: "Show _MENU_ entries",
                    paginate: {
                        "previous": "Previous",
                        "next": "Next"
                    }
                },  
                pagingType: "simple_numbers",
                lengthMenu: [5, 10, 25, 50, 100],
                pageLength: 10,           
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                        url: "{!! route('admin.providers.index') !!}",
                        type: "GET",
                        dataType: 'json',
                    },  
                order: [[1, 'asc']],
                columnDefs: [
                    { orderable: false, "targets": [5,6, 7] },
                    { searchable: false, "targets": [5,6, 7] },
                     {
                        'visible': false,
                        'targets': [1]
                    }
                ],                                  
                columns: [
                    {data: 'id', name: 'id'},  
                    {data: 'provider_id', name: 'provider_id'},                  
                    {data: 'provider_name', name: 'provider_name'},
                    {data: 'provider_administrator', name: 'provider_administrator'},
                    {data: 'provider_email', name: 'provider_email'},
                    {data: 'provider_phone', name: 'provider_phone'},
					{ 
                        data: null,
                        'width':'100px',
                        render: function (data, type, row, meta) {
                            let status = row.provider_status;
    						let checkedAttribute = status == 1 ? 'checked' : ''; 
                            return `<div class="form-check form-switch">
										<input data-certificationProviderId="${row.provider_id}" class="form-check-input" type="checkbox" id="certificationStatus" name="" value="yes" ${checkedAttribute}>
									</div>`;
                        }
                    },                    
                    { 
                        data: null,
                        render: function (data, type, row, meta) {
                            let provider_id = row.provider_id;
                            let baseUrl = "{{ route('admin.providers.show', '') }}";
                            return `<a href="${baseUrl}/${provider_id}" class="btn btn-info d-block rounded">View More Info</a>`;
                        }
                    },
                    { 
                        data: null,
                        render: function (data, type, row, meta) {
                            let provider_id = row.provider_id;
                            let baseUrl = "{{ route('admin.providers.show', '') }}";
                            return `<div class="dropdown">
                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item add-provider" data-id="${provider_id}" href="javascript:void(0);" data-curd="edit" data-bs-toggle="modal" data-bs-target="#add-profile">Edit</a>
                                        <a class="dropdown-item delete-provider" href="javascript:void(0);" data-id="${provider_id}">Delete</a>
                                    </div>
                                </div>`;
                        }
                    },
                ]
            }); 
           

            $('#CertifiedProvider tbody').on('click', 'tr', function() {
                var data = CertifiedProvider.row(this).data();
            });
        })(jQuery);
</script>
@endpush