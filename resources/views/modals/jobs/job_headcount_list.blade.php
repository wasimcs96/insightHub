<style>
    .custom-bullet li {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .custom-bullet .bullet {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        margin-right: 8px;
        background: #000;
    }

    .table th {
        padding: 16px 8px !important;
    }

    .table td {
        color: #4B5675 !important;
        font-size: 12px !important;
        font-weight: 500 !important;
        line-height: 16px;
        border-top: 1px solid #F1F1F4 !important;
        height: 52px !important;
        vertical-align: middle;
        padding: 0px 8px 0px 0px !important;
    }

    .table:not(.table-bordered) tbody tr:last-child td,
    .table:not(.table-bordered) tbody tr:last-child th,
    .table:not(.table-bordered) tfoot tr:last-child td,
    .table:not(.table-bordered) tfoot tr:last-child th {
        border-bottom: 1px solid #F1F1F4 !important;
    }

    .table thead th {
        color: #99A1B7 !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        line-height: 16px;
        padding-left: 0px !important;
    }

    .filter-content p {
        color: #4B5675;
        font-size: 12px;
        font-weight: 400;
        line-height: 16px;
        margin-bottom: 0px;
    }

    table tr:nth-child(even) {
        background-color: #FAFAFB;
        /* light yellow or your preferred color */
    }
</style>
<div class="modal-header">
    <h2 class="modal-title">{{ $job_title ?? ''}}</h2>
    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body text-center">
    <table class="table mb-0">
        <thead>
            <tr>
                <th scope="col">Employee Name</th>
                <th scope="col">Headcount ID</th>
                <th scope="col">Email</th>
                <th scope="col">Date of Hire</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody id="employee-table-body">
            {{-- @foreach ($employeeList as $employee)
            <tr>
                <td>{{ $employee->name ?? '' }}</td>
                <td>{{ $employee->headcount_id ?? '-' }}</td>
                <td>{{ $employee->email ?? '-' }}</td>
                <td>{{ $employee->date_of_hire ?? '-' }}</td>
                <td>
                    <a href="" class="btn btn-sm btn-primary">View</a>
                </td>
            </tr>
            @endforeach --}}

        </tbody>
    </table>

</div>
<div class="modal-footer modal-footer d-block border-0" style="padding: 0px 24px 24px 24px">
    <div class="filter-content d-flex justify-content-start gap-2">
        <p><em>Last updated on: {{ $updated_at ?? '' }}</em></p>

    </div>
</div>
