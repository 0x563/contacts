<?php namespace App\Helpers;

class Utils
{
    /**
     *  Get info
     * @param String $filepath
     * @return Array
     */
    public static function getContacts($filepath)
    {
        if (!file_exists($filepath))
        {
            return [];
        }

        $c_nombres  = 0;
        $nombres    = [];
        $c_ruts     = 0;
        $ruts       = [];
        $generos    = [];
        $domicilios = [];
        $comunas    = [];
        $actual     = 0; // 0 - Nada - 1 - Nombre - 2 - Rut - 3 - Genero - 4 Domicilio - 5 Comunas
        $info       = [];

        $data = fopen($filepath, "r") or die("File not found\n");

        while (!feof($data)) {
            $line = fgets($data);

            if ($line == "REPUBLICA DE CHILE\n") {
                $actual = 0;
                continue;
            }

            if ($line == "SERVICIO ELECTORAL\n") {
                $actual = 0;
                continue;
            }

            if ($line == "PADRON ELECTORAL DEFINITIVO - ELECCIONES PRESIDENCIAL, PARLAMENTARIAS Y DE CONSEJEROS REGIONALES 2013\n") {
                $actual = 0;
                continue;
            }

            if ($line == "PAGINA\n") {
                $actual = 0;
                continue;
            }

            if ($line == "REGION\n") {
                $actual = 0;
                continue;
            }

            if ($line == ": DEL BIOBIO\n") {
                $actual = 0;
                continue;
            }


            if ($line == "PROVINCIA : ÑUBLE\n") {
                $actual = 0;
                continue;
            }


            if ($line == "V\n" || $line == "M\n") {
                $actual = 0;
                continue;
            }

            if ($line == "\n") {
                $actual = 0;
                continue;
            }

            if ($line == "NOMBRE\n") {
                $actual = 1;
                continue;
            }

            if ($line == "C.IDENTIDAD\n") {
                $actual = 2;
                continue;
            }

            if ($line == "SEX DOMICILIO ELECTORAL\n") {
                $actual = 3;
                continue;
            }

            if ($actual == 3 && ($line != "MUJ\n" && $line != "VAR\n")) {
                $actual = 4;
                continue;
            }

            if ($line == "CIRCUNSCRIPCION\n") {
                $actual = 5;
                continue;
            }

            switch ($actual) {
                case 1:
                    $nombres[] = trim($line, "\n");
                    break;

                case 2:
                    $ruts[] = trim($line, "\n");
                    break;

                case 3:
                    $generos[] = trim($line, "\n");
                    break;

                case 4:
                    $domicilios[] = trim($line, "\n");
                    break;

                case 5:
                    $comunas[] = trim($line, "\n");
                    break;

                default:break;
            }
        }

        fclose($data);

        $c_nombres = count($nombres);
        $c_ruts = count($ruts);

        if ($c_nombres == $c_ruts) {
            echo "Loading $c_nombres contacts ... Please be patient!\n";
            return array_combine($nombres, $ruts);
        }

        return [];
    }

}