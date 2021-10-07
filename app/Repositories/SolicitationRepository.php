<?php

namespace ApiWebPsp\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SolicitationRepository.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
interface SolicitationRepository extends RepositoryInterface
{
    /**
     * @return mixed
     */
    public function getIdUser();

    /**
     * @param $id_status
     * @return mixed
     */
    public function countSatus($id_status);

    /**
     * @param $cancelados
     * @param $concluidos
     * @return array
     * @throws \Exception
     */
    public function countMounth($cancelados, $concluidos);

    /**
     * @param $user
     * @param $status
     * @return mixed
     */
    public function getSolicitations($user,$status,$protocols);

    /**
     * @return mixed
     */
    public function countStatusNow();

    public function getTotalSolicitations();

}
