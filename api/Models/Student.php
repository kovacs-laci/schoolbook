<?php

namespace Api\Models;
class Student {
    private $id;
    private $name;
    private $classId;

    public function __construct($id, $name, $classId) {
        $this->id = $id;
        $this->name = $name;
        $this->classId = $classId;
    }

    // Getterek és setterek
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getClassId() {
        return $this->classId;
    }
}
