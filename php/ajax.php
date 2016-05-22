<?php
require_once('customLinkedList.class.php');
include ('../phptools.php');

$newList = new customLinkedList(null);

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            addLink($newList);
            break;
        case 'find':
            find();
            break;
        case 'remove':
            remove();
            break;
    }
}

function addLink(customLinkedList &$newList){
   $return = $_POST;

    $newList ->insert($return['add']);

    echo $newList ->getData();
    exit;
}

function find(){
    echo 'find';
    exit();
}

function remove(){
    echo 'remove';
    exit();
}
