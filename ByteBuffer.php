<?php
class ByteBuffer{
    function __construct($array, $position = 0){
        $this->ByteArray    = $array;
        $this->Position     = $position;
        $this->Length       = count($this->ByteArray);
    }

    function __destruct(){
        unset($this->ByteArray);
        unset($this->Position);
        unset($this->Length);
    }
    /********
    以當前位子，取出1個byte(Byte的容量)的值
    ********/
    public function _GetByte(){
        return $this->_GetBytes(1);
    }
    /********
    以當前位子，取出2個byte(Short的容量)的值
    ********/
    public function _GetShort(){
        return $this->_GetBytes(2);
    }
    /********
    以當前位子，取出4個byte(Int的容量)的值
    ********/
    public function _GetInt(){
        return $this->_GetBytes(4);
    }
    /********
    以當前位子，取出8個byte(Long的容量)的值
    ********/
    public function _GetLong(){
        return $this->_GetBytes(8);
    }
    /********
    給予傳進的array，指定的byte值
    ********/
    public function _GetAdv($array, $pos, $len){
        for ($i = $pos; $i < ($pos + $len); $i++) {
            $array[$i] = $this->_GetBytes(1);
        }
        return $array;
    }
    /********
    Byte  = 1
    Short = 2
    Int   = 4
    Long  = 8
    *********/
    private function _GetBytes($int){
        $result = "";
        for ($i = $this->Position; $i < ($this->Position + $int); $i++) {
            $temp = str_pad(base_convert($this->ByteArray[$i] ,10 ,2), 8, '0', STR_PAD_LEFT);
            $result = $result.$temp;
        }
        $this->Position = $this->Position + $int;
        return base_convert($result, 2, 10);
    }
}
