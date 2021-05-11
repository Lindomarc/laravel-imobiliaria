@component("mail::message")

    # Novo Contato
    Contato: {{ $name }} <{{ $email }}>
    Telefone: {{ $phone }}
    {{ $message }}

@endcomponent
