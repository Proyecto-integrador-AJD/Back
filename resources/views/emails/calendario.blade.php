@component('mail::message')
# Calendario de Partidos - {{ $arbitro->name }}

Estimado/a {{ $arbitro->name }},

A continuación, encontrarás el calendario de todos los partidos asignados para este año:

@foreach ($partits as $partit)
## Partido {{ $loop->iteration }}

- **Fecha**: {{ $partit->data_partit }}
- **Equipos**: {{ $partit->equipLocal->nom }} vs {{ $partit->equipVisitant->nom }}
- **Estadio**: {{ $partit->estadi->nom }}
@endforeach

Gracias por tu compromiso y esfuerzo.

@lang('Saludos,')  
{{ config('app.name') }}
@endcomponent
