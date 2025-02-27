<x-template.layout title="Orders" >  
  <x-organisms.navbar path="/orders"/>

  <div class="mt-4 mb-3 ms-5 me-5">
    <h1>My Orders</h1>
    <table class="table mt-4">
    <thead>
        <tr>
        <th scope="col">No</th>
        <th scope="col">Title</th>
        <th scope="col">Total Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Status</th>
        <th scope="col">Address</th>
        <th scope="col">Note</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($orders as $order)
          <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$order->orderDetail->title}}</td>
            <td>{{$order->total}}</td>
            <td>{{$order->orderDetail->quantity}}</td>
            <td>
            @if($order->status == 0)
                    <span class="badge bg-warning" >Unprocessed</span>
                  @elseif($order->status == 1)
                    <span class="badge bg-info">Confirmed</span>
                  @elseif($order->status == 2)
                    <span class="badge bg-primary">Processed</span>
                  @elseif($order->status == 3)
                    <span class="badge bg-danger">Pending</span>
                  @elseif($order->status == 4)
                    <span class="badge bg-secondary">Shipping</span>
                  @elseif($order->status == 5)
                    <span class="badge bg-success">Completed</span>
                  @endif
            </td>
            <td>{{$order->address}}</td>
            <td>{{$order->note}}</td>
          </tr>
        @endforeach
    </tbody>
    </table>
  </div>

  <x-organisms.footer :shop="$shop"/>
</x-template.layout>