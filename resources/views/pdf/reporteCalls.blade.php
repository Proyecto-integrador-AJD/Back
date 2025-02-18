<!DOCTYPE html>
<html>

<head>
    <title>{{ __('pdf.reportCalls.title') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        h1 {
            color: #333;
        }
    </style>
</head>

<body>
    <h1>{{ __('pdf.reportCalls.title') }}</h1>
    <p>{{ __('pdf.reportCalls.subTitle') }}: {{ $date['date'] }}</p>


    <!-- //! Filtro -->
    <h2>{{ __('pdf.reportCalls.titleFilter') }}</h2>
    <table>
        <thead>
            <tr>
                @if ($date['filtros']['dateInit'] != null)
                    <th>{{ __('pdf.reportCalls.filterTableHeader.dateInit') }}</th>

                @endif 

                @if ($date['filtros']['dateEnd'] != null)
                    <th>{{ __('pdf.reportCalls.filterTableHeader.dateEnd') }}</th>
                @endif 
                
                @if ($date['filtros']['zoneId'] != null)
                    <th>{{ __('pdf.reportCalls.filterTableHeader.zone') }}</th>
                @endif 
                
                @if ($date['filtros']['type'] != null)
                    <th>{{ __('pdf.reportCalls.filterTableHeader.type') }}</th>
                @endif 
            </tr>
        </thead>
        <tbody>
            <tr>
                @if ($date['filtros']['dateInit'] != null)
                    <td>{{ $date['filtros']['dateInit'] }}</td>
                @endif 

                @if ($date['filtros']['dateEnd'] != null)
                    <td>{{ $date['filtros']['dateEnd'] }}</td>
                @endif 
                
                @if ($date['filtros']['zoneId'] != null)
                    <td>{{ $date['filtros']['zoneId'] }}</td>
                @endif 
                
                @if ($date['filtros']['type'] != null)
                    <td>{{ $date['filtros']['type'] }}</td>
                @endif
            </tr>
        </tbody>
    </table>


    <!-- //! LLamadas no previstas -->
    <h2>{{ __('pdf.reportCalls.noPrevistas.title') }}</h2>
    <table border="1" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>{{ __('pdf.reportCalls.tableHeader.date') }}</th>
                <th>{{ __('pdf.reportCalls.tableHeader.operator') }}</th>
                <th>{{ __('pdf.reportCalls.tableHeader.patient') }}</th>
                <th>{{ __('pdf.reportCalls.tableHeader.zone') }}</th>
                <th>{{ __('pdf.reportCalls.tableHeader.type') }}</th>
                <th>{{ __('pdf.reportCalls.tableHeader.subType') }}</th>
                <th>{{ __('pdf.reportCalls.tableHeader.duration') }}</th>
                <th>{{ __('pdf.reportCalls.tableHeader.description') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($date['calls']['noPrevistas'] as $call)
                <tr>
                    <td>{{ $call->date }}</td>
                    <td>{{ $call->operator }}</td>
                    <td>{{ $call->patient }}</td>
                    <td>{{ $call->zone }}</td>
                    <td>{{ $call->type }}</td>
                    <td>{{ $call->subType }}</td>
                    <td>{{ $call->duration }}</td>
                    <td>{{ $call->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <!-- //! LLamadas previstas -->
    <h2>{{ __('pdf.reportCalls.previstas.title') }}</h2>

</body>

</html>