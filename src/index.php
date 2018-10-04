<?php
/**
 * Created by PhpStorm.
 * User: janhavi
 * Date: 10/4/18
 * Time: 9:49 AM
 */
main::start();
Class main{
    static public function start(){
        $records = csv ::getRecords();
        $table = html::generateTable($records);
        system::printPage($table);
    }
}
class csv{
    static public function getRecords(){

        $records = 'testing functions';
        return $records;
        
    }
}

class html{
    static public function generateTable($records){

        $table = $records;
        return $table;

    }
}

class system{

    static public function printPage($page){

        echo $page;

    }

}