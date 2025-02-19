@php
    $delimiter = ",";
    $newline = "\n";
@endphp

Fecha del reporte: {{ $data['date'] }}{!! $newline !!}

@if($data['filtros']['dateInit'] || $data['filtros']['dateEnd'] || $data['filtros']['zoneId'] || $data['filtros']['type'])
"Filtro aplicado"{!! $newline !!}
@if ($data['filtros']['dateInit'])
"Fecha Inicio","{{ $data['filtros']['dateInit'] }}"{!! $newline !!}
@endif
@if ($data['filtros']['dateEnd'])
"Fecha Fin","{{ $data['filtros']['dateEnd'] }}"{!! $newline !!}
@endif
@if ($data['filtros']['zoneId'])
"Zona","{{ $data['filtros']['zoneId'] }}"{!! $newline !!}
@endif
@if ($data['filtros']['type'])
"Tipo","{{ $data['filtros']['type'] }}"{!! $newline !!}
@endif
@endif

{!! $newline !!}

"LLamadas no previstas"{!! $newline !!}
"Fecha","Operador","Paciente","Zona","Tipo","Subtipo","Duración","Descripción"{!! $newline !!}
@foreach ($data['calls']['noPrevistas'] as $call)
"{{ date('d/m/Y H:i', strtotime($call->date)) }}","{{ $call->operator }}","{{ $call->patient }}","{{ $call->zone }}","{{ $call->type }}","{{ $call->subType }}","{{ $call->duration }} {{ __('pdf.reportCalls.table.min') }}","{{ $call->description }}"{!! $newline !!}
@endforeach

{!! $newline !!}

"LLamadas previstas"{!! $newline !!}
"Fecha","Tipo Alerta","Subtipo Alerta","Descripción Alerta","Operador","Paciente","Zona","Tipo","Subtipo","Duración","Descripción"{!! $newline !!}
@foreach ($data['calls']['previstas'] as $call)
"{{ date('d/m/Y H:i', strtotime($call->date)) }}","{{ $call->alertType }}","{{ $call->alertSubType }}","{{ $call->alertDescription }}","{{ $call->operator }}","{{ $call->patient }}","{{ $call->zone }}","{{ $call->type }}","{{ $call->subType }}","{{ $call->duration }} {{ __('pdf.reportCalls.table.min') }}","{{ $call->description }}"{!! $newline !!}
@endforeach
