<h1 class="text-center pt-5 pb-5">Neuen Kunden hinzufügen</h1>

{{ content() }}

{{ flash.output() }}

{{ form("index/create") }}

    <fieldset class="col-8 offset-2">

        {{ form.label('first_name') }}
        {{ form.render('first_name', ['class': 'form-control']) }}

        {{ form.label('last_name') }}
        {{ form.render('last_name', ['class': 'form-control']) }}

        {{ form.label('email') }}
        {{ form.render('email', ['class': 'form-control']) }}

        <div class="row">
            <div class="col-5">
                {{ link_to("index", "&larr; Zurück", 'class': "button button-grey") }}
            </div>
            <div class="col-5 offset-2">
                {{ submit_button("Speichern", "class": "button button-green") }}
            </div>
        </div>

    </fieldset>

</form>