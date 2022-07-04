<?php

namespace Model;

use Helper\DBHelper;

class Subject
{
    protected int $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    protected string $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    protected const TABLE = 'subjects';

    public function getSubjectById($id)
    {
        $db = new DBHelper();
        $subject = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
        if (!empty($subject)) {
            $this->id = $subject['id'];
            $this->name = $subject['name'];
            return $this;
        }
        return null;
    }
    public static function getAll()
    {
        $db = new DBHelper();

        $data = $db->select()->from(self::TABLE)->get();

        $subjects = [];

        foreach ($data as $element) {
            $subject = new Subject();
            $subject->load($element['id']);
            $subjects[] = $subject;
        }

        return $subjects;
    }
    public function load(int $id)
    {
        $db = new DBHelper();
        $subject = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
        if (!empty($subject)) {
            $this->id = $subject['id'];
            $this->name = $subject['name'];
        }
        return $this;
    }
}