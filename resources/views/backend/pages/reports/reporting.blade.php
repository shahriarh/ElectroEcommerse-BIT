@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">

    <div class="card">
      <div class="card-header">
        Monthly Sales Report
      </div>
      <div class="card-body">
        @include('backend.partials.messages')
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th>Product</th>
              <th>Sales Qty</th>
              <th>Amount (Unit Price)</th>
              <th>Total Tk</th>
            </tr>
          </thead>

          <tbody>
            @php ($totals = [])
            <!-- @foreach ($data as $product) -->
            <tr>

              <td>{{ $product->title }}</td>
              <td>{{ $product->qty }}</td>
              <td>{{ $product->price }}</td>
              <td>{{ $totals[] = $product->qty * $product->price }}</td>
            </tr>
            <!--  @endforeach -->
            <tr class="info">
              <td>SubTotal:</td>
              <td>{{ array_sum( array_column($data, 'qty') ) }}</td>
              <td></td>
              <!-- <td>{{ array_sum( array_column($data, 'price') ) }}</td> -->
              <td>{{ array_sum($totals) }}</td>
            </tr>
          </tbody>


        </table>
      </div>
    </div>

  </div>
</div>
<!-- main-panel ends -->
@endsection
