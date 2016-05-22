<?php
/**
 * Created by PhpStorm.
 * User: joe_z
 * Date: 2016-05-12
 * Time: 3:50 PM
 */
include_once('LinkedListInterface.php');

class customLLNode
{
    public $data, $next;

    public function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getNext()
    {
        return $this->next;
    }

    public function setNext($next)
    {
        $this->next = $next;
    }
}

class customLinkedList implements CustomLinkedListInterface , JsonSerializable
{
    private $firstNode;
    private $currentNode;
    private $previousNode;
    private $size;
    private $found;

    function __construct()
    {
        $this -> firstNode = new customLLNode(null);
        $this -> currentNode = new customLLNode(null);
        $this -> previousNode = new customLLNode(null);

        $this -> size = 0;
    }

    public function insert($data)
    {
        //PostCondition:: here we create a new node, assign the value of the new node's link to next
        //                ,then assign this list node to the new link and increase the count by one.

        $newNode = new customLLNode($data);

        $newNode->setNext($this -> firstNode);
        $this -> firstNode = $newNode;
        $this -> currentNode = $this -> firstNode;

        $this->size++;
    }

    public function delete($data)
    {
        $this -> find($data);
        if ($this -> found)
        {
            if ($this -> firstNode == $this -> currentNode) {
                $this -> firstNode = $this -> firstNode -> getNext();
            }
            else {
                $this -> previousNode -> setNext($this -> currentNode ->getNext());
            }
        }
        $this -> size--;
    }

    public function find($data)
    {
        $this -> found = false;
        $this -> currentNode = $this -> firstNode;


        while ($this -> currentNode -> getNext() != null) {
            if ($this -> currentNode -> getData() === $data) {
                $this -> found = true;
                return $this -> found;
            } else {
              $this -> previousNode = $this -> currentNode;
                $this -> currentNode = $this -> currentNode -> getNext();
            }
        }
        return false;
    }


    public function toString()
    {
        $output = "";
        $node = $this->firstNode;
        while ($node->getNext() <> NULL) {
            $output .= $node->getData() . ", ";
            $node = $node->getNext();
        }
        return $output;
    }

    public function isEmpty()
    {
        return ($this->size === 0 ? 'false' : 'true');
    }

    public function sizeOf()
    {
        return $this->size;
    }

    public function getData()
    {
        return $this->currentNode->getData();
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        $output = array();
        $node = $this->firstNode;
        while ($node->getNext() <> NULL) {
            $output[]= $node -> getData() . ", ";
            $node = $node -> getNext();
        }
        return json_encode($output);

    }
}

