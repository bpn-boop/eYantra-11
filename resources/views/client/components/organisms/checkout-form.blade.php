<div class="container py-4 {{ $amount == 0 ? 'd-none' : '' }}">
    <form action="{{ route('initiateEsewaPayment') }}" method="post" >
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror bg-transparent" placeholder="Mike" value="{{ old('name') }}" required>
            @error('name') 
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="text" name="phone" id="phone" class="form-control  @error('phone') is-invalid @enderror bg-transparent" placeholder="08122387xxxx" value="{{ old('phone') }}" required>
            @error('phone') 
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control  @error('address') is-invalid @enderror bg-transparent" placeholder="Suryabinayak-4, Bhaktapur" value="{{ old('address') }}" required>
            @error('address') 
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="note">Note</label>
            <textarea name="note" id="note" cols="30" class="form-control @error('note') is-invalid @enderror bg-transparent" placeholder="Please add  more details  . . .">{{ old('note') }}</textarea>
            @error('note')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!-- <button type="submit" class="btn btn-primary float-end">Order</button> -->
        <button type="submit" class="esewa-btn-green float-end mt-2" disabled>
            Pay via
            <img src="http://developer.esewa.com.np/assets/img/esewa_logo.png" alt="Esewa Logo">
        </button>
    </form>

    <!-- <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
        @csrf
        <input type="text" id="amount" name="amount" value="{{$amount}}" required placeholder="Amount" hidden>
        <input type="text" id="tax_amount" name="tax_amount" value ="{{$tax_amount}}" required placeholder="Tax Amount" hidden>
        <input type="text" id="total_amount" name="total_amount" value="{{$total_amount}}" required placeholder="Total Amount" hidden>
        <input type="text" id="transaction_uuid" name="transaction_uuid" value="{{$transaction_uuid}}" required placeholder="Transaction UUID" hidden>
        <input type="text" id="product_code" name="product_code" value ="{{$product_code}}" required placeholder="Product Code" hidden>
        <input type="text" id="product_service_charge" name="product_service_charge" value="{{$product_service_charge}}" required placeholder="Product Service Charge" hidden>
        <input type="text" id="product_delivery_charge" name="product_delivery_charge" value="{{$product_delivery_charge}}" required placeholder="Product Delivery Charge" hidden>
        <input type="text" id="success_url" name="success_url" value="{{$success_url}}" required placeholder="Success URL" hidden>
        <input type="text" id="failure_url" name="failure_url" value="{{$failure_url}}" required placeholder="Failure URL" hidden>
        <input type="text" id="signed_field_names" name="signed_field_names" value="{{$signed_field_names}}" required placeholder="Signed Field Names" hidden>
        <input type="text" id="signature" name="signature" value="{{$signature}}" required placeholder="Signature" hidden>
        <button type="submit" class="esewa-btn-green float-end mt-2" disabled>
            Pay via
            <img src="http://developer.esewa.com.np/assets/img/esewa_logo.png" alt="Esewa Logo">
        </button>
    </form> -->
</div>

@if ($amount == 0)
 <div class="container py-4 d-flex justify-content-center">
    <a href="{{ route('clientProducts') }}" class="btn btn-success px-4 py-2 d-flex align-items-center gap-2">
        <i class="bi bi-bag-plus-fill"></i> Start Shopping
    </a>
</div>

@endif
@push('js')
    <script>
        autosize();
        function autosize(){
            var text = $('#note');

            text.each(function(){
                $(this).attr('rows',1);
                resize($(this));
                this.style.overflow = 'hidden';
                this.style.backgroundColor = 'transparent';
            });

            text.on('input', function(){
                resize($(this));
            });
            
            function resize ($text) {
                $text.css('height', 'auto');
                $text.css('height', $text[0].scrollHeight+'px');
            }
        }

        // esewa payment related
        const payWithEsewaBtn = document.querySelector('.esewa-btn-green')

        function checkInputs() {
            const name = document.querySelector('input[name="name"]').value.trim();
            const phone = document.querySelector('input[name="phone"]').value.trim();
            const address = document.querySelector('input[name="address"]').value.trim();
            const note = document.querySelector('textarea[name="note"]').value.trim();
            
            if (name !== '' && phone !== '' && address !== '') {
                payWithEsewaBtn.removeAttribute('disabled');
            } else {
                payWithEsewaBtn.setAttribute('disabled', '');
            }
        }

        // Listen for input events on all relevant fields
        document.querySelectorAll('input[name="name"], input[name="phone"], input[name="address"]').forEach(input => {
            input.addEventListener('input', checkInputs);
        });
    </script>
@endpush

@push('css')
<style>
   .esewa-btn-green {
    display: inline-flex;
    align-items: center;
    color: #28a745;
    padding: 0.3rem 0.7rem;
    border-radius: 0.375rem;
    font-weight: 600;
    cursor: pointer;
    gap: 0.5rem;
    font-family: Arial, sans-serif;
    transition: background-color 0.2s ease;
    border: 1px solid #28a745;
  }
  .esewa-btn-green img {
    width: 24px;
    height: auto;
  }
  .esewa-btn-green:hover {
    background-color: #218838;
    color: white;
  }
  .esewa-btn-green img{
    width: 4rem;
    height: auto;
  }

/* button disabled */
.esewa-btn-green:hover:not(:disabled) {
  background-color: #218838;
}

.esewa-btn-green:disabled,
.esewa-btn-green[disabled] {
  color: #a3d9a5;
  cursor: not-allowed;
  opacity: 0.7;
  pointer-events: none;
  border: 1px solid #a3d9a5;
}

.esewa-btn-green:disabled img {
  filter: grayscale(100%);
  opacity: 0.5;
}
</style>
@endpush
