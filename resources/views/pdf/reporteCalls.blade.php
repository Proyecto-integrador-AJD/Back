<!DOCTYPE html>
<html>

<head>
    <title>{{ __('pdf.reportCalls.title') }}</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        color: #2C3E50;
    }

    h2 {
        text-align: center;
        border-bottom: 2px solid #3498DB;
        padding-bottom: 5px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
        margin-top: 10px;
    }

    thead tr {
        background-color: #3498DB;
        color: white;
        text-align: left;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    tbody tr {
        background-color: #ECF0F1;
        color: #2C3E50;
    }

    th:first-child, td:first-child {
        border-radius: 5px 0 0 5px;
    }

    th:last-child, td:last-child {
        border-radius: 0 5px 5px 0;
    }
</style>
</head>

<body>
    <header>
        <img src="{{ $data['pathLogo'] }}" width="150">

        <h1>{{ __('pdf.reportCalls.title') }}</h1>
        <p>{{ __('pdf.reportCalls.subTitle') }}: {{ $data['date'] }}</p>
    </header>


    <!-- //! Filtro -->
    <h2>{{ __('pdf.reportCalls.titleFilter') }}</h2>
    <table>
        <thead>
            <tr>
                @if ($data['filtros']['dateInit'] != null)
                    <th>{{ __('pdf.reportCalls.filterTableHeader.dateInit') }}</th>

                @endif 

                @if ($data['filtros']['dateEnd'] != null)
                    <th>{{ __('pdf.reportCalls.filterTableHeader.dateEnd') }}</th>
                @endif 
                
                @if ($data['filtros']['zoneId'] != null)
                    <th>{{ __('pdf.reportCalls.filterTableHeader.zone') }}</th>
                @endif 
                
                @if ($data['filtros']['type'] != null)
                    <th>{{ __('pdf.reportCalls.filterTableHeader.type') }}</th>
                @endif 
            </tr>
        </thead>
        <tbody>
            <tr>
                @if ($data['filtros']['dateInit'] != null)
                    <td>{{ $data['filtros']['dateInit'] }}</td>
                @endif 

                @if ($data['filtros']['dateEnd'] != null)
                    <td>{{ $data['filtros']['dateEnd'] }}</td>
                @endif 
                
                @if ($data['filtros']['zoneId'] != null)
                    <td>{{ $data['filtros']['zoneId'] }}</td>
                @endif 
                
                @if ($data['filtros']['type'] != null)
                    <td>{{ $data['filtros']['type'] }}</td>
                @endif
            </tr>
        </tbody>
    </table>


    <!-- //! LLamadas no previstas -->
    <h2>{{ __('pdf.reportCalls.noPrevistas.title') }}</h2>
    <table>
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
            @foreach ($data['calls']['noPrevistas'] as $call)
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