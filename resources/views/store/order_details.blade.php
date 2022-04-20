  <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Sr.No.

      </th>
      <th class="th-sm">Order

      </th>
      <th class="th-sm">Date

      </th>
      <th class="th-sm">Customer

      </th>
      <th class="th-sm">Total

      </th>
      <th class="th-sm">Payment Status

      </th>
      <th class="th-sm">Delivery method

      </th>
    </tr>
  </thead>
  <tbody>
        @php
            $count = 1;
        @endphp

       @foreach ($orderData as $data)
            
            
        <tr>
          <td>{{ $count }}</td>
          <td>{{ $data->name }}</td>
          <td>  <?php echo date('d-m-Y', strtotime( $data->created_at)); ?></td>
           <td>{{ $data->customer_first_name }} {{ $data->customer_last_name }}</td>
          <td>{{ $data->current_total_price }}</td>
          
          
          
           
           
          <td>{{ $data->financial_status }}</td>
          <td>{{ $data->delivery_method }}</td>
        </tr>
            @php
            $count++;
        @endphp
     @endforeach
   
  </tbody>
  <tfoot>
    <tr>
      <th>Sr.No.
      </th>
      <th>Order
      </th>
      <th>Date
      </th>
      <th>Customer
      </th>
      <th>Total
      </th>
      <th>Payment Status
      </th>
      <th>Delivery method
      </th>
    </tr>
  </tfoot>
</table>