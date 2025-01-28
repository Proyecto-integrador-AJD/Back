<x-mail::message>
    # Jornada {{ $partits->first()->jornada }}

    ## Partits Programats:
    @foreach($partits as $partit)
        - **{{ $partit->equipLocal->nom }}** vs **{{ $partit->equipVisitant->nom }}** ({{ $partit->data_partit }})
    @endforeach

    Gràcies,
    **{{ config('app.name') }}**
</x-mail::message>