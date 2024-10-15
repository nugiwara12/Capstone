@extends('layouts.app1')

@section('title', 'Orders')

@section('contents')
    <hr />

    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Product Title</th>
                <th>Payment Status</th>
                <th>Delivery Status</th>
            </tr>
        </thead>
        <tbody>
            @if($order->count() > 0)
                @foreach($order as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{$rs->name}}</td>
                        <td class="align-middle">{{$rs->email}}</td>
                        <td class="align-middle">{{$rs->address}} , {{$rs->barangay}} , {{$rs->city}} , {{$rs->province}}</td>
                        <td class="align-middle">{{$rs->phone}}</td>
                        <td class="align-middle">{{$rs->product_title}}</td>
                        <td class="align-middle">{{$rs->payment_status}}</td>
                        <td class="align-middle">
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle {{ $rs->delivery_status === 'Delivered' ? 'disabled' : '' }}"
                                        type="button"
                                        id="dropdownMenuButton"
                                        data-bs-toggle="{{ $rs->delivery_status === 'Delivered' ? '' : 'dropdown' }}"
                                        aria-expanded="false">
                                    {{$rs->delivery_status}}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @if ($rs->delivery_status !== 'Delivered')
                                        <li><a class="dropdown-item" href="{{route('order_shipped', $rs->id)}}">Shipped</a></li>
                                        <li><a class="dropdown-item" href="{{route('order_delivered', $rs->id)}}">Delivered</a></li>
                                    @endif
                                    {{-- <li><form id="deleteForm-{{ $rs->id }}" action="{{ route('products.destroy', $rs->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <a class="dropdown-item" href="#" onclick="confirmation(event, {{ $rs->id }})">Delete</a>
                                    </form></li> --}}
                                </ul>
                            </div>

                        </td>
                    </tr>
                @endforeach
            @else
            <tr>
                <td class="text-center" colspan="5">Product not found</td>
            </tr>
            @endif
        </tbody>

    </table>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
@endsection
