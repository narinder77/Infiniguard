@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Add Order -->
        <div class="modal fade" id="status-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Notes for INFINIGUARD® QR number 0000360</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label class="text-black font-w500">Status</label>
                                <select class="form-select form-control" aria-label="Default select example">
                                    <option selected>Answered</option>
                                    <option value="1">Unanswered</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">Notes<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="heading-part d-lg-flex d-block mb-3 pb-3 border-bottom justify-content-between align-items-center">
            <h3 class="mb-0">Warranty Inspected Records</h3>
            <div>
                <a href="{{ url('qr-client-information') }}" class="btn btn-primary rounded">Client</a>
                <a href="#" class="btn btn-primary rounded">Download Inspection Report</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 table-outer">
                <div class="table-responsive card-table rounded table-hover fs-14">
                    <table class="table border-no display mb-4 dataTablesCard project-bx" id="WarrantyInspectedRecords">
                        <thead>
                            <tr>
                                <th>ID </th>
                                <th>Date </th>
                                <th>Time </th>
                                <th>Activity </th>
                                <th>Location </th>
                                <th>Notes/Claim </th>
                                <th>Inspection Pictures </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID </th>
                                <th>Date </th>
                                <th>Time </th>
                                <th>Activity </th>
                                <th>Location </th>
                                <th>Notes/Claim </th>
                                <th>Inspection Pictures </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function($) {
            let id = getLastPathname();
            let WarrantyInspectedRecords = $('#WarrantyInspectedRecords').DataTable({
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
                    url: "{{ route('admin.inspection-history.show', ':id') }}".replace(':id', id),
                    type: "GET",
                    dataType: 'json',
                    data: {
                        id: id
                    }
                },
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                        orderable: false,
                        "targets": [0,1,2,3, 4, 5,6]
                    },
                    {
                        searchable: false,
                        "targets": [3, 4, 5,6]
                    },
                    {
                        'visible': false,
                        'targets': [0]
                    }
                ],
                columns: [{
                        data: 'inspection_id',
                        name: 'inspection_id'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'time',
                        name: 'time'
                    },
                    {
                        data: 'activity',
                        name: 'activity'
                    },
                    {
                        data: 'inspection_address',
                        name: 'inspection_address'
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            let status = row.equipment_claim_status;
                            let equipment_claim_status = status == 1 ? 'answered' : 'unanswered';
                            let className = status == 1 ? ' btn-info' : 'btn-warning';
                            return `<a href="javascript:void(0)" class="btn ${className} d-block rounded" data-bs-toggle="modal" data-bs-target="#claimstatus">${equipment_claim_status}</a>`;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            let equipment_claim_qr_id = row.equipment_claim_qr_id;
                            url = "{{ route('admin.warranty-claims.edit', ':id') }}".replace(':id',
                                equipment_claim_qr_id)
                            return `<a href="${url}">View Maintenance History</a>`;
                        }
                    },
                ]
            });
            $('#example tbody').on('click', 'tr', function() {
                var data = table.row(this).data();
            });
        })(jQuery);
    </script>
@endpush
