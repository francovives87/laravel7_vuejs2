mercadopago test

<form action="{{ route('mp.payment') }}" method="post">
    @csrf
<button type="submit">Pagar</button>
</form>