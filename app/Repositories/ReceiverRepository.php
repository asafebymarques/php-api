<?php

namespace ApiWebPsp\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PatientRepository.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
interface ReceiverRepository extends RepositoryInterface
{
    /**
     * @param $status
     * @return mixed
     */
    public function listReceivers();

    /**
     * @param $status
     * @return mixed
     */
    public function listReceiversTrash();

    /**
     * @param $cpf
     * @return mixed
     */
    public function getCpf($cpf);

    public function getCompanyName($name);

}
