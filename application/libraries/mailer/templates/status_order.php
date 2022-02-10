<div style="max-width: 60%; margin: 0 auto; border: 1px solid #e2e2e2; padding: 20px; font-family: Verdana">
    <div style="text-align: center; background-color: #383d47; padding: 2rem 3.25rem 2rem 2.813rem;">
        <img src="{base_url}uploads/{logo}" style="margin: 30px auto;width: auto; height: 50px">
    </div>
    <h2 style="text-align: center">Witaj {first_name}!</h2>
    <h2 style="text-align: center;">Dziękujemy za zakupy w naszym sklepie internetowym - {company}</h2>
    <h2 style="text-align: center;">{status_title}</h2>
    <h4 style="text-align: center;">
        {status_desc}</p>
    </h4>
    <div style="font-size: 1rem; margin: 0 auto; font-family: Verdana; text-align: center;">
        <p>
            Imię i nazwisko:<br>
            <b>{first_name} {last_name}</b>
        </p>
        <p>
            Adres e-mail:<br>
            <b>{email}</b>
        </p>
        <p>
            Numer telefonu:<br>
            <b>{phone}</b>
        </p>
        <p>
            Adres dostawy:<br>
            <b>{country}, {city} {zipcode}<br>
                {street} {housenumber}{flatnumber}</b>
        </p>
        {company_client}
        {nip}
        {address_company}
        <p>
            Sposób dostawy:<br>
            <b>{delivery} - {delivery_cost} PLN</b>
        </p>
        <p>
            Metoda płatności:<br>
            <b>{payment}</b>
        </p>

        <p>
            Kwota zamówienia:<br>
            <b>{suma} PLN</b>
        </p>
    </div>
    <div style="font-size: 1rem; margin: 0 auto; font-family: Verdana; text-align: center;">
        {payment_url}
    </div>
    <div style="font-size: 1rem; margin: 0 auto; font-family: Verdana;">
        <h2>Koszyk</h2>
        {cart}
        <div style="text-align: right">
            <h3>Suma koszyka: {sumaCart} PLN</h3>
        </div>
    </div>
</div>