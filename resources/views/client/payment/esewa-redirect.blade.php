<form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST" id="esewaForm" hidden>
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
</form>

<script>
    document.getElementById('esewaForm').submit();
</script>