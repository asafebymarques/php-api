<?php
/**
 * Created by PhpStorm.
 * User: leiviton
 * Date: 12/07/18
 * Time: 12:49
 */

namespace ApiWebPsp\Http\Controllers\Api\V1\Admin;


trait ValidationControllerTrait
{

       /**
     * @param $req Object
     * @return array|bool
     *
     * This function compare dates
     */
    public function validateDate($req)
    {

        $startDate = $req->dateInitialContract;

        $endDate = $req->dateFinalContract;

        if ($startDate > $endDate) {
            return false;
        }else{
            return true;
        }
    }

    /**
     * @param $cnpj string
     * @return array|bool
     *
     * This function validate cnpj
     */
    public function validateCnpj($cnpj)
    {
        if ($cnpj === ""){
            return true;
        }

        if (empty($cnpj)) {
            return false;
        }

        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        // Size validate
        if (strlen($cnpj) != 14) {
            return false;
        }

        // First digit validate
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }

        // Second digit validate
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;
        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
        //dd($view);
        //return $view;
    }

    function validateCPF($cpf) {

        // Verifica se um nÃºmero foi informado
        if($cpf === ""){
            return true;
        }

        if(empty($cpf)) {
            return false;
        }

        // Elimina possivel mascara
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados Ã© igual a 11
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequÃªncias invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
            return false;
            // Calcula os digitos verificadores para verificar se o
            // CPF Ã© vÃ¡lido
        } else {

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    return false;
                }
            }

            return true;
        }
    }

    public function validatePlate($plate)
    {
        if(preg_match('/^[A-Z]{3}\-[0-9]{4}$/', $plate))
        {
            return true;
        }else{
            return false;
        }
    }

    public function validateRenavam($renavam){

        #Completa com zeros a esquerda caso o renavam seja com 9 digitos
        $renavam = str_pad($renavam, 11, "0", STR_PAD_LEFT);


        #Valida se possui 11 digitos
        if( !preg_match("/[0-9]{11}/", $renavam) ){
            return false;
        }

        $renavamSemDigito = substr($renavam, 0, 10);
        $renavamReversoSemDigito = strrev($renavamSemDigito);


        // Multiplica as strings reversas do renavam pelos numeros multiplicadores
        // Exemplo: renavam reverso sem digito = 69488936
        // 6, 9, 4, 8, 8, 9, 3, 6
        // * * * * * * * *
        // 2, 3, 4, 5, 6, 7, 8, 9 (numeros multiplicadores - sempre os mesmos [fixo])
        // 12 + 27 + 16 + 40 + 48 + 63 + 24 + 54
        // soma = 284

        $soma = 0;
        $multiplicador = 2;
        for ($i = 0; $i < 10; $i++) {
            $algarismo = substr($renavamReversoSemDigito, $i, 1);
            $soma += $algarismo * $multiplicador;

            if( $multiplicador >=9) {
                $multiplicador = 2;
            }else{
                $multiplicador++;
            }
        }

        # mod11 = 284 % 11 = 9 (resto da divisao por 11)
        $mod11 = $soma % 11;

        #Faz-se a conta 11 (valor fixo) - mod11 = 11 - 9 = 2
        $ultimoDigitoCalculado = 11 - $mod11;

        #ultimoDigito = Caso o valor calculado anteriormente seja 10 ou 11, transformo ele em 0
        #caso contrario, eh o proprio numero
        $ultimoDigitoCalculado = ($ultimoDigitoCalculado >= 10 ? 0 : $ultimoDigitoCalculado);

        # Pego o ultimo digito do renavam original (para confrontar com o calculado)
        $digitoRealInformado = substr($renavam, -1);

        #Comparo os digitos calculado e informado
        if($ultimoDigitoCalculado == $digitoRealInformado){
            return true;
        }

        return false;

    }

    /**
     * @param $cnh
     * @return bool
     */
    public function validateCnh($cnh)
    {
        // Trecho retirado do respect validation
        $ret = false;
        if ((strlen($input = preg_replace('/[^\d]/', '', $cnh)) == 11)
            && (str_repeat($input[1], 11) != $input)
        ) {
            $dsc = 0;
            for ($i = 0, $j = 9, $v = 0; $i < 9; ++$i, --$j) {
                $v += (int)$input[$i] * $j;
            }
            if (($vl1 = $v % 11) >= 10) {
                $vl1 = 0;
                $dsc = 2;
            }
            for ($i = 0, $j = 1, $v = 0; $i < 9; ++$i, ++$j) {
                $v += (int)$input[$i] * $j;
            }
            $vl2 = ($x = ($v % 11)) >= 10 ? 0 : $x - $dsc;
            $ret = sprintf('%d%d', $vl1, $vl2) == substr($input, -2);
        }
        return $ret;
    }

    /**
     * @param $email
     * @return bool
     */
    public function isMail($email){
        $er = "/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/";
        if (preg_match($er, $email)){
            return true;
        } else {
            return false;
        }
    }



    public function getReverse($lat,$long)
    {
        $url = "https://reverse.geocoder.api.here.com/6.2/reversegeocode.json?prox=".$lat."%2C".$long."%2C250&mode=retrieveAddresses&maxresults=1&gen=9&app_id=nyKybJs4fZYfMCd7jfsx&app_code=E_xE5837hGk33SL8M6hWIg";

        $placeHere = json_decode(@file_get_contents($url));

        return $placeHere->Response->View[0]->Result[0]->Location->Address->Label;
    }
}
