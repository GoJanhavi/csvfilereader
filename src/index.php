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
       //system::printPage($records);
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


class html{
    static public function generateTable($records){
        $count = 0;
        foreach ($records as $item) {
            if ($count==0){
                $array = $item->returnArray();
                $keys=array_keys($array);
                system::printPage($keys);
            }
            else{
                $array = $item->returnArray();
                $values=array_values($array);
                system::printPage($values);
            }
            $count++;

        }
      //  return $table;

    }
}

class system{

    static public function printPage($printValue){

        print_r($printValue);

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
