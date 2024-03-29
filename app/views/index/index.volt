
<h1 class="text-center pt-5 pb-5">Contacts List</h1>

{{ content() }}

{{ flash.output() }}

<div class="pull-right mb-2">Page {{ page.current }} / {{ page.total_pages }}</div>

{% if page.total_items > 0 %}

    <table class="table table-bordered table-hover">
        <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Added</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td class="text-right" colspan="7">{{ page.total_items }} Contacts in total</td>
        </tr>
        </tfoot>
        <tbody>
        {% for contact in page.items %}
            <tr>
                <td>{{ contact.id }}</td>
                <td>{{ contact.first_name }}</td>
                <td>{{ contact.last_name }}</td>
                <td>{{ contact.email }}</td>
                <td>{{ contact.created_date }}</td> {# ToDo: Date Format #}
                <td width="7%">
                    {{ link_to("index/edit/" ~ contact.id, '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', "class": "btn btn-default", 'title': 'Edit entry ' ~ contact.id ) }}
                </td>
                <td width="7%">
                    {{ link_to("index/delete/" ~ contact.id, '<i class="fa fa-trash-o" aria-hidden="true"></i>', "class": "btn btn-default", 'title': 'Delete entry ' ~ contact.id ) }}
                </td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
{% else %}
    <p class="text-center">No Contacts saved.</p>
{% endif %}

<div class="pagination float-right">
    {% for pagination in 1 .. page.total_pages %}
        <a href='/index?page={{ pagination }}'>
            {{ pagination }}
        </a>
    {% endfor %}
</div>


<div class="row">
    <div class="col-12 offset-0 col-lg-6 offset-lg-3">

    {{ link_to(
        'index/new',
        '<i class="fa fa-long-arrow-right mr-2"></i> Create New Contact',
        'class': "button button-red")
    }}

    </div>
</div>