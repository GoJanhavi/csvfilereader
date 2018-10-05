<?php
/**
 * Created by PhpStorm.
 * User: janhavi
 * Date: 10/4/18
 * Time: 9:49 AM
 */
main::start("data.csv");
Class main{
    static public function start($filename){
        $records = csv ::getRecords($filename);
       // $table = html::generateTable($records);
        system::printPage($records);
    }
}
class csv{
    static public function getRecords($file){


        $file = fopen($file,"r");

        while(! feof($file))
        {
            $row = fgetcsv($file);
            $recordArray[] = $row;
        }

        fclose($file);

        return $recordArray;

    }
}


/*class html{
    static public function generateTable($records){

        $table = $records;
        return $table;

    }
}*/

class system{

    static public function printPage($page){

        print_r($page);

    }

}
