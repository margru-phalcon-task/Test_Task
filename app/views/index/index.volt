
<h1 class="text-center pt-5 pb-5">Kundenverwaltung</h1>

{{ content() }}

{{ flash.output() }}

{% if customers.count() > 0 %}

    <table class="table table-bordered table-hover">
        <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Email</th>
            <th>Hinzugefügt am</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td class="text-right" colspan="5">Users quantity: <?php echo $customers->count(); ?></td>
        </tr>
        </tfoot>
        <tbody>
        {% for customer in customers %}
            <tr>
                <td>{{ customer.id }}</td>
                <td>{{ customer.first_name }}</td>
                <td>{{ customer.last_name }}</td>
                <td>{{ customer.email }}</td>
                <td>{{ customer.created_date }}</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
{% endif %}

<div class="row">
    <div class="col-12 offset-0 col-lg-6 offset-lg-3">

    {{ link_to(
        'index/new',
        '<i class="fa fa-long-arrow-right mr-2"></i> Neuen Kunden hinzufügen',
        'class': "button button-red")
    }}

    </div>
</div>