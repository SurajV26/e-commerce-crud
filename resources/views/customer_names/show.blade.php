@extends('customer_names.layout')

@section('content')
<style>
    .pdf-page {
        width: 100%;
        padding: 20px;
        border: 1px solid #000;
    }

    .pdf-table {
        width: 100%;
    }

    .pdf-table th, .pdf-table td {
        border: 1px solid #000;
        padding: 8px;
    }

    .pdf-table th {
        background-color: #f2f2f2;
    }
</style>

<div class="pdf-page">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Customer Details</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('customer_names.index') }}"><i class="fa fa-home"></i> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <table class="pdf-table">
                <tbody>
                    <tr>
                        <th>Customer Name</th>
                        <td>{{ $customer_name->party_name }}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{ $customer_name->location }}</td>
                    </tr>
                    <tr>
                        <th>Billing Name</th>
                        <td>{{ $customer_name->billing_name }}</td>
                    </tr>
                    <tr>
                        <th>Contact Person</th>
                        <td>{{ $customer_name->contact_person }}</td>
                    </tr>
                    <tr>
                        <th>Contact Number</th>
                        <td>{{ $customer_name->contact_number }}</td>
                    </tr>
                    <tr>
                        <th>Email Address</th>
                        <td>{{ $customer_name->email }}</td>
                    </tr>
                    <tr>
                        <th>Executive Name</th>
                        <td>{{ $customer_name->executive_name }}</td>
                    </tr>
                    <tr>
                        <th>No. Of Licences</th>
                        <td>{{ $customer_name->no_of_licenses }}</td>
                    </tr>
                    <tr>
                        <th>AMC Start Date</th>
                        <td>{{ !empty($customer_name->amc_start_date) ? date('d-m-Y', strtotime($customer_name->amc_start_date)) : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>AMC Expiry Date</th>
                        <td>{{ !empty($customer_name->amc_expiry_date) ? date('d-m-Y', strtotime($customer_name->amc_expiry_date)) : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Past AMC Charge (Exclusive GST)</th>
                        <td>{{ $customer_name->past_amc_charge }}</td>
                    </tr>
                    <tr>
                        <th>New Quoted AMC Charge (Exclusive GST)</th>
                        <td>{{ $customer_name->new_quoted_amc_charge }}</td>
                    </tr>
                    <tr>
                        <th>AMC STATUS (EXPIRED/ACTIVE)</th>
                        <td>{{ $customer_name->amc_status }}</td>
                    </tr>
                    <tr>
                        <th>Payment Status</th>
                        <td>{{ $customer_name->payment_status }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $customer_name->address }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
