<?php
/**
 * Created by PhpStorm.
 * User: matel
 * Date: 14.06.18
 * Time: 14:49
 */

namespace App\Models;
class Roads
{
    protected $fillable = [
        'load_place',
        'load_date',
        'unload_place',
        'unload_place',
        'spedition',
        'comment'
    ];
    public function zaladunek(){
        return "{$this->load_place} / {$this->unload_place}";
    }
    public function create($arguments, $c){

        $query = $c->db->prepare("INSERT INTO roads VALUES ('', ?, ?, ?, ?, ?, ?, ?, 'dfs')");

        $query->bindValue(1, $arguments['load_place']);
        $query->bindValue(2, $arguments['load_date']);
        $query->bindValue(3, $arguments['unload_place']);
        $query->bindValue(4, $arguments['unload_date']);
        $query->bindValue(5, $arguments['spedition']);
        $query->bindValue(6, $arguments['comment']);
        $query->bindValue(7, date('o-m-d'));

        $query->execute();

    }

}