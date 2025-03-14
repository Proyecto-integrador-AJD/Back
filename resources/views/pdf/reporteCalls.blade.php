<!DOCTYPE html>
<html>

<head>
    <title>{{ __('pdf.reportCalls.title') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @page {
            size: landscape;
        }

        body {
            font-family: Arial, sans-serif;
            color: #2C3E50;
        }

        header {
            img{
                display: inline-block;
            }
            div{
                display: inline-block;
                text-align: center;
            }
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

        thead {
            display: table-header-group;
        }

        tbody {
            display: table-row-group;
        }

        thead tr {
            background-color: #3498DB;
            color: white;
            text-align: left;
        }

        th,
        td {
            padding: 5px;
            border: 1px solid #ddd;
        }

        tbody tr {
            background-color: #ECF0F1;
            color: #2C3E50;
        }

        th:first-child,
        td:first-child {
            border-radius: 5px 0 0 5px;
        }

        th:last-child,
        td:last-child {
            border-radius: 0 5px 5px 0;
        }

        .center {
            text-align: center;
        }

        .justify {
            text-align: justify;
        }
    </style>
</head>

<body>
    <header>
        <img src="{{ $data['pathLogo'] }}" width="150">
        <div>
            <h1>{{ __('pdf.reportCalls.title') }}</h1>
            <p>{{ __('pdf.reportCalls.subTitle') }}: {{ $data['date'] }}</p>
        </div>
    </header>
    <br>
    <br>
    <br>
    <br>
    <br>

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
                    <td class="center">{{ date('d/m/Y H:i', strtotime($call->date)) }}</td>
                    <td>{{ $call->operator }}</td>
                    <td>{{ $call->patient }}</td>
                    <td class="center">{{ $call->zone }}</td>
                    <td>{{ $call->type }}</td>
                    <td>{{ $call->subType }}</td>
                    <td class="center">{{ $call->duration }} {{ __('pdf.reportCalls.table.min') }}</td>
                    <td class="justify">{{ $call->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <!-- //! LLamadas previstas -->
    <div style="page-break-before: always;"></div>
    <h2>{{ __('pdf.reportCalls.previstas.title') }}</h2>
    <table>
        <thead>
            <tr>
                <th>{{ __('pdf.reportCalls.tableHeader.date') }}</th>
                <th>{{ __('pdf.reportCalls.tableHeader.alertType') }}</th>
                <th>{{ __('pdf.reportCalls.tableHeader.alertSubType') }}</th>
                <th>{{ __('pdf.reportCalls.tableHeader.alertDescription') }}</th>
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
            @foreach ($data['calls']['previstas'] as $call)
                <tr>
                    <td class="center">{{ date('d/m/Y H:i', strtotime($call->date)) }}</td>
                    <td>{{ $call->alertType }}</td>
                    <td>{{ $call->alertSubType }}</td>
                    <td>{{ $call->alertDescription }}</td>
                    <td>{{ $call->operator ?? '' }}</td>
                    <td>{{ $call->patient ?? '' }}</td>
                    <td class="center">{{ $call->zone ?? '' }}</td>
                    <td>{{ $call->type ?? '' }}</td>
                    <td>{{ $call->subType ?? '' }}</td>
                    <td class="center">{{ $call->duration ?? '' }} {{ __('pdf.reportCalls.table.min') }}</td>
                    <td class="justify">{{ $call->description ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>