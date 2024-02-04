<?php

/**
 * 
 */
class Make
{
	private $array;

	function __construct($array)
	{
		$this->array = $array;
	}

	    public function CSV()
    {
        $csv = fopen("plan.csv", "w");
        //Use the function mb_convert_encoding to convert especial characters EX: mb_convert_enconding('DESCRIÇÃO', 'ISO-8859-1', 'UTF-8');
        $header = ["NOTA","CHAVE DE ACESSO"];
        fputcsv($csv, $header, ';');
        $s = Query::queryCBIO();
        $counter = 0;
        while (($row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
            $txtRow[$counter] = $row["CHAVE_ACESSO"];
            $counter++;
            
           fputcsv($csv, $row, ';');
        }
        fclose($csv);

        echo '<iframe src="plan.csv">/iframe>';
    }

    public function TXT()
    {        
        $txt = fopen("text.txt", "w");
        $counter = count($this->array);

        while($aux > 0){
            $posix = $counter - $aux;
            if($posix == ($counter-1)){
                $text = strval($txtRow[$posix]);
            }else{
                $text = strval($txtRow[$posix]) . ",";
            }
            $aux--;
            fwrite($txt, $text);
        }
        fclose($txt);

        echo '<iframe src="text.txt">/iframe>';
    }

    public function ZIP()
    {
        $zip = new ZipArchive();
        if($zip->open("compressed.zip", ZipArchive::OVERWRITE))
        {
            $zip->addFile("plan.csv");
            $zip->addFile("text.txt");
        }
        $zip->close();

        echo '<iframe src="compressed.zip">/iframe>';
    }
}