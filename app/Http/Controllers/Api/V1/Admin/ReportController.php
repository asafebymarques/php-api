<?php

namespace ApiWebPsp\Http\Controllers\Api\V1\Admin;

use ApiWebPsp\Models\Solicitation;
use Carbon\Carbon;
use ApiWebPsp\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function countMonth() {
        //total de chamados por mês nos últimos 12 meses (atual e 11 anteriores).
        //return an array of the last 12 months.
        for ($i = 0; $i <= 11; $i++) {
            $years_months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
            $months[] = date("m", strtotime( date( 'Y-m-01' )." -$i months"));
        }

        foreach ($months as $month) {
            $month_name = date("F", mktime(0, 0, 0, $month, 1));
            $monthsNames[] = $month_name;
        }

        foreach ($years_months as $key => $value) {
            $renewals[] = Solicitation::where('created_at', 'LIKE', $value.'%')->count();
        }

        for ($i = 0; $i <= count($years_months) - 1; $i++) {
            $json[] = array(
                'name' => $this->translateMonth($monthsNames[$i]),
                'value' => $renewals[$i]);
        }

        return response()->json($json, 200);
    }

    public function countMonthByType() {
        //total de chamados por mês nos últimos 12 meses (atual e 11 anteriores) por tipo de ação (Coleta, entrega, Troca).
        for ($i = 0; $i <= 11; $i++) {
            $years_months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
            $months[] = date("m", strtotime( date( 'Y-m-01' )." -$i months"));
        }

        foreach ($months as $month) {
            $month_name = date("F", mktime(0, 0, 0, $month, 1));
            $monthsNames[] = $month_name;
        }

        //delivery
        foreach ($years_months as $key => $value) {
            $delivery[] = Solicitation::where('created_at', 'LIKE', $value.'%')
                ->where('type', 'delivery')
                ->count();
        }

        //exchange
        foreach ($years_months as $key => $value) {
            $exchange[] = Solicitation::where('created_at', 'LIKE', $value.'%')
                ->where('type', 'exchange')
                ->count();
        }

        //collect
        foreach ($years_months as $key => $value) {
            $collect[] = Solicitation::where('created_at', 'LIKE', $value.'%')
                ->where('type', 'collect')
                ->count();
        }

        for ($i = 0; $i <= count($years_months) - 1; $i++) {
            $json[] = array(
                'name' => $this->translateMonth($monthsNames[$i]),
                'series' =>[
                    ['name'=> 'delivery', 'value' => $delivery[$i]],
                    ['name'=> 'exchange', 'value' => $exchange[$i]],
                    ['name'=> 'collect', 'value' => $collect[$i]]
                ]);
        }

        return response()->json($json, 200);
    }

    public function countProductByMonth() {
        //Total de chamados por produto entregues no mês anterior
        $month = date("Y-m", strtotime( date( 'Y-m-01' )." -1 months"));
        $month_name = date("F", mktime(0, 0, 0, date("m", strtotime( date( 'Y-m-01' )." -1 months")), 1));

//        SELECT p.`presentation`, COUNT(p.`id`) as total FROM solicitations s
//        INNER JOIN solicitation_items si ON si.solicitation_id = s.id
//        INNER JOIN products p ON p.id = si.product_id
//        WHERE s.status = 'despachado'
//        AND s.type IN ('collect', 'exchange')
//        GROUP BY p.`presentation`

        $result = DB::table('solicitations')
            ->select('products.presentation as name', DB::raw('COUNT(products.id) as value'))
            ->join('solicitation_items', 'solicitation_items.solicitation_id', '=', 'solicitations.id')
            ->join('products', 'products.id', '=', 'solicitation_items.id')
            ->where('solicitations.status', 'despachado')
            ->where('solicitations.created_at', 'LIKE', $month.'%')
            ->whereIn('solicitations.type', ['collect', 'exchange'])
            ->groupBy('products.presentation')
            ->get();

        return response()->json(['month' => $this->translateMonth($month_name), 'data' => $result], 200);
    }

    public function countStatusByMonth() {
        //Total de chamados por status (Dashboard) do mês corrente
        $month_name = date("F", mktime(0, 0, 0, date("m", strtotime( date( 'Y-m-01' )." -1 months")), 1));
        $mes1 = date_format(new Carbon(), 'm');

        //Concluído - concluído
        //Em atendimento - (EM ATENDIMENTO, AGENDADO AGUARDANDO VISITA)
        //Encerrado sem sucesso - não teremos
        //Em transito - Coletado amostra em transito (fluxo de Troca e coleta)
        //Pendente SAC - avaliar pois não temos o status

        $concluido = Solicitation::where('status', 'concluido')
            ->whereMonth("created_at", $mes1)
            ->count();

        $atendimento = Solicitation::whereIn('status', ['atendimento', 'agendado'])
            ->whereMonth("created_at", $mes1)
            ->count();

        $emtrasito = Solicitation::where('status', 'coletado')
            ->whereMonth("created_at", $mes1)
            ->count();

        $pendente = Solicitation::where('status', 'pendente')
            ->whereMonth("created_at", $mes1)
            ->count();

        $result = array(
            ['name'=> 'Concluido', 'value' => $concluido],
            ['name'=> 'Atendimento', 'value' => $atendimento],
            ['name'=> 'Em Transito', 'value' => $emtrasito],
            ['name'=> 'Pendente', 'value' => $pendente]
        );

        return response()->json(['month' => $this->translateMonth($month_name), 'data' => $result], 200);
    }

    private function translateMonth($m) {

        switch($m) {
            case "January": $month = "Janeiro"; break;
            case "February": $month = "Fevereiro"; break;
            case "March": $month = "Março"; break;
            case "April": $month = "Abril"; break;
            case "May": $month = "Maio"; break;
            case "June": $month = "Junho"; break;
            case "July": $month = "Julho"; break;
            case "August": $month = "Agosto"; break;
            case "September": $month = "Setembro"; break;
            case "October": $month = "Outubro"; break;
            case "November": $month = "Novembro"; break;
            case "December": $month = "Dezembro"; break;
            default: $month = "Unknown"; break;
        }
        return $month;

    }


}
