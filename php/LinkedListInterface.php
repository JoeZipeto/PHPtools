<?php
/**
 * Created by PhpStorm.
 * User: joe_z
 * Date: 2016-05-13
 * Time: 4:46 PM
 */

interface CustomLinkedListInterface{

    public function isEmpty();

    public function sizeOf();

    public function insert($data);

    public function delete($data);
    
}