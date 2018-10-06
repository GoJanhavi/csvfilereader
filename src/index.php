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
        $table = html::generateTable($records);

        include 'view/layout.html';
    }
}
class csv{
    static public function getRecords($file){


        $file = fopen($file,"r");

        $fieldNames = array();
        $count = 0;

        while(! feof($file))
        {
            $record = fgetcsv($file);

            if($count == 0){
                $fieldNames = $record;
            }
            else{
                $recordArray[] = recordsFactory::create($fieldNames, $record);
            }

            $count++;

        }

        fclose($file);
        return $recordArray;

    }
}

class htmlTable{
    static public function generateTableStructure($thead, $tbody){
        $table = "<thead class='thead-dark'>".$thead."</thead><tbody>".$tbody."</tbody>";
        return $table;
    }
}

class html{
    static public function generateTable($records){
        $tbody="";
        foreach ($records as $item) {
                $array = $item->returnArray();

                $keys=array_keys($array);
                $values=array_values($array);

                $theadOutput = htmlTableRows::generateRowColStructure($keys,'th');

                $tbodyOutput = htmlTableRows::generateRowColStructure($values,'td');
                $tbody.= $tbodyOutput;
        }

        $table = htmlTable::generateTableStructure($theadOutput,$tbody);
        return $table;

    }

}

class htmlTableRows{

    static public function generateRowColStructure($array,$colType){
        $htmlOutput = '';
        foreach($array as $key => $value){
            if($key==0){
                $htmlOutput .= '<tr>';
            }
            $htmlOutput .= "<$colType>$value</$colType>";
            if($key==(count($array)-1)){
                $htmlOutput .= '</tr>';
            }
        }
        return $htmlOutput;
    }

}

class record{

    public function __construct(Array $fieldNames = null, Array $values = null)
    {
       $record = array_combine($fieldNames,$values);

       foreach($record as $key => $value) {
           $this->createProperty($key,$value);
       }

    }

    public function returnArray(){
        $array = (array) $this;
        return $array;
    }

    public function createProperty($name, $value){
        $this->{$name} = $value;
    }
}

class recordsFactory{

    static public function create(Array $fieldNames = null, Array $values = null){

       $record = new record($fieldNames, $values);
        return $record;
    }
}
class system{

    static public function printPage($printValue){

        print_r($printValue);

    }

}