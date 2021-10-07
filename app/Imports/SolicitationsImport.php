<?php

namespace ApiWebPsp\Imports;

use ApiWebPsp\Models\Solicitation;
use ApiWebPsp\Models\SolicitationItem;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SolicitationsImport implements ToCollection
{
    /**
     * @param Collection $collection
     * @return array
     * @throws \Exception
     */
    public function collection(Collection $rows)
    {
        $res = '';
        foreach ($rows as $row) {
            $res .= $row[8];

            $solicitation = Solicitation::create([
                'company_id' => 1,
                'receiver_id' => 2,
                'status' => 'aberto',
                'voucher' => $row[0],
                'type' => $row[1],
                'address_id' => 1,
                'sends' => $row[8]
            ]);

            SolicitationItem::create([
                'product_id' => $row[7],
                'solicitation_id' => $solicitation->id,
                'total' => $row[2] * $row[3],
                'price_unitary' => $row[2],
                'qtd' => $row[3],
                'lot' => $row[4],
                'pen' => $row[5],
                'expiration_date' => $row[6]
            ]);

            QrCode::format('png')->size(350)->generate($solicitation->voucher, public_path("storage/qrcode/" . $solicitation->voucher . '.png'));

        }

        //return ['status' => 'success', 'message' => 'Importado com sucesso', 'title' => 'Sucesso'];
    }
}
