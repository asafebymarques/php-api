<!DOCTYPE html
        PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.heading-description td {
            /* background: #12b79d; */
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            text-align: left;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body
        style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; color: #74787e; height: 100%; hyphens: auto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title" style="width: 65px;">
                            <img
                                    src="data:image/jpeg;base64,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"
                                    style="width:100%; max-width:300px;">
                        </td>

                        <td>
                            Protocolo: {{$order->protocol}}<br>
                            Manifestação: {{$order->manifestation}}<br>
                            Tipo: @if($order->type == 'delivery')<br>
                            Entrega
                            @elseif($order->type == 'collect')
                                Coleta
                            @elseif($order->type == 'other')
                                {{$order->description_other_type}}
                            @elseif($order->type == 'exchange')
                                Troca
                            @endif
                            Data: {{date_format($order->created_at, 'd/m/Y H:s:i')}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table>
        <tr class=" heading-description">
            <td cellpadding="10">Email para notificação de agendamento no sistema DRS SAC<br>
                {{$order->company->name}}
            </td>
            <td style="text-align: right;"><img style="width: 90px;"
                                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIgAAABhCAMAAAA6LxkqAAAJk2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS41LWMwMTEgNzkuMTQ5NTk4LCAyMDEyLzEwLzEwLTEyOjA5OjU2ICAgICAgICAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICAgeG1sbnM6ZGFtPSJodHRwOi8vd3d3LmRheS5jb20vZGFtLzEuMCIKICAgIHhtbG5zOnRpZmY9Imh0dHA6Ly9ucy5hZG9iZS5jb20vdGlmZi8xLjAvIgogICBkYzpmb3JtYXQ9ImltYWdlL3BuZyIKICAgZGM6bW9kaWZpZWQ9IjIwMTQtMDgtMjBUMTE6NDM6MDIrMDE6MDAiCiAgIGRhbTpzaXplPSI0NzYyIgogICBkYW06UGh5c2ljYWx3aWR0aGluaW5jaGVzPSItMS4wIgogICBkYW06ZXh0cmFjdGVkPSIyMDE0LTA4LTIwVDExOjUxOjE4KzAxOjAwIgogICBkYW06c2hhMT0iNmYxNmZmZDY4YmM2MDY1MDRmYTM3ZmNmODUxMGIzY2U0YjU4MzBlNyIKICAgZGFtOk1JTUV0eXBlPSJpbWFnZS9wbmciCiAgIGRhbTpOdW1iZXJvZnRleHR1YWxjb21tZW50cz0iMCIKICAgZGFtOk51bWJlcm9maW1hZ2VzPSIxIgogICBkYW06UHJvZ3Jlc3NpdmU9Im5vIgogICBkYW06RmlsZWZvcm1hdD0iUE5HIgogICBkYW06Qml0c3BlcnBpeGVsPSI4IgogICBkYW06UGh5c2ljYWxoZWlnaHRpbmluY2hlcz0iLTEuMCIKICAgZGFtOlBoeXNpY2Fsd2lkdGhpbmRwaT0iLTEiCiAgIGRhbTpQaHlzaWNhbGhlaWdodGluZHBpPSItMSIKICAgZGFtOkNvbW1lbnRzPSJYTUw6Y29tLmFkb2JlLnhtcDogJmx0Oz94cGFja2V0IGJlZ2luPSZxdW90O++7vyZxdW90OyBpZD0mcXVvdDtXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQmcXVvdDs/Jmd0OyYjeEE7Jmx0O3g6eG1wbWV0YSB4bWxuczp4PSZxdW90O2Fkb2JlOm5zOm1ldGEvJnF1b3Q7IHg6eG1wdGs9JnF1b3Q7QWRvYmUgWE1QIENvcmUgNS41LWMwMTEgNzkuMTQ5NTk4LCAyMDEyLzEwLzEwLTEyOjA5OjU2ICAgICAgICAmcXVvdDsmZ3Q7JiN4QTsgJmx0O3JkZjpSREYgeG1sbnM6cmRmPSZxdW90O2h0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMmcXVvdDsmZ3Q7JiN4QTsgICZsdDtyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSZxdW90OyZxdW90OyYjeEE7ICAgIHhtbG5zOmRjPSZxdW90O2h0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvJnF1b3Q7JiN4QTsgICAgeG1sbnM6ZGFtPSZxdW90O2h0dHA6Ly93d3cuZGF5LmNvbS9kYW0vMS4wJnF1b3Q7JiN4QTsgICAgeG1sbnM6dGlmZj0mcXVvdDtodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyZxdW90OyYjeEE7ICAgZGM6Zm9ybWF0PSZxdW90O2ltYWdlL3BuZyZxdW90OyYjeEE7ICAgZGM6bW9kaWZpZWQ9JnF1b3Q7MjAxNC0wOC0yMFQxMTo0MzowMi4zMjMrMDU6MzAmcXVvdDsmI3hBOyAgIGRhbTpzaXplPSZxdW90OzQ3NjImcXVvdDsmI3hBOyAgIGRhbTpQaHlzaWNhbHdpZHRoaW5pbmNoZXM9JnF1b3Q7LTEuMCZxdW90OyYjeEE7ICAgZGFtOmV4dHJhY3RlZD0mcXVvdDsyMDE0LTA4LTIwVDExOjUxOjE4LjE3NSswNTozMCZxdW90OyYjeEE7ICAgZGFtOnNoYTE9JnF1b3Q7NmYxNmZmZDY4YmM2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"
                                                alt=""></td>
        </tr>
    </table>

    <table>
        <tr class="heading">
            <td colspan="2">Dados do paciente</td>
        </tr>

        <tr class="details">
            <td>Nome</td>
            <td>{{ $order->patient->name }}</td>
        </tr>

        <tr class="details">
            <td>CNPJ/CPF</td>
            <td>{{ substr($order->patient->cpf,0,3).'.***.***-'.substr($order->patient->cpf,9,12) }}</td>
        </tr>
    </table>
    <table>
        <tr class="heading">
            <td colspan="3">Contatos do paciente</td>
        </tr>
        <tbody>
        @foreach($order->patient->patient_contacts as $contact)
            <tr class="item">
                <td>Celular</td>
                <td>{{$contact->cellphone}}</td>
            </tr>
            <tr class="item">
                <td>Telefone</td>
                <td>{{$contact->phone}}</td>
            </tr>
            <tr class="item">
                <td>Email</td>
                <td>{{$contact->email}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <table>
        <tr class="heading">
            <td colspan="3">Endereço do paciente</td>
        </tr>
        <tbody>
        <tr class="item">
            <td>Logradouro</td>
            <td>
                {{ $order->address->street .', '.$order->address->number }}<br>
                @if($order->address->complement != '')
                    Complemento: {{$order->address->complement}} - @endif
            </td>
        </tr>
        <tr class="item">
            <td>Bairro</td>
            <td>{{$order->address->neighborhood }}</td>
        </tr>
        <tr class="item">
            <td>Cidade</td>
            <td>{{ $order->address->city.'-'.$order->address->uf }}</td>
        </tr>
        </tbody>
    </table>

    <table>

            <tr class="heading">
                <td colspan="3">Produto(s)</td>
            </tr>
            <tbody>
            @foreach($order->solicitation_items as $o)
            <tr class="item">
                <td>Produto</td>
                <td>{{$o->product->product}}</td>
            </tr>
            <tr class="item">
                <td>Quantidade</td>
                <td>{{$o->qtd}}</td>
            </tr>
            <tr class="item">
                <td>Lote</td>
                <td>{{$o->lot}}</td>
            </tr>
            <tr class="item">
                <td>Caneta</td>
                <td>{{$o->pen}}</td>
            </tr>
            <tr class="item">
                <td>Validade</td>
                <td>{{$o->expiration_date}}</td>
            </tr>
            @endforeach
            </tbody>
    </table>

    <table>
        <tr>
            <td height="25">&nbsp;</td>
        </tr>
        <tr class=" heading-description">
            <td style="text-align: center;">Para reagendamento ou tirar duvidas entre em<br> contato pelo telefone (55)
                55555-5555,ou pelo nosso site <a href="https://drsgroup.com.br">aqui</a></td>
        </tr>
    </table>

</div>
</body>

</html>
