<?php

namespace Model;

use Helper\DBHelper;

class Message
{
    protected int $id;
    protected string $name;
    protected string $lastName;
    protected string $email;
    protected string $phone;
    protected string $subjectId;

    /**
     * @return string
     */
    public function getSubjectId(): string
    {
        return $this->subjectId;
    }

    /**
     * @param string $subjectId
     */
    public function setSubjectId(string $subjectId): void
    {
        $this->subjectId = $subjectId;
    }
    protected string $message;
    protected int $status;
    protected const TABLE = 'requests';


    public function getId(): string
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }



    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public static function getAllRequests() :array
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->get();

        $requests = [];
        foreach ($data as $element) {
            $request = new Message();
            $request->load($element['id']);
            $requests[] = $request;
        }
        return $requests;
    }

    public function load(int $id): Message
    {
        $db = new DBHelper();
        $request = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
        if (!empty($request)) {
            $this->id = $request['id'];
            $this->name = $request['name'];
            $this->lastName = $request['last_name'];
            $this->email = $request['email'];
            $subject = new Subject();
            $this->subject = $subject->getSubjectById($request['id'])->getName();
            $this->message = $request['message'];
            $this->status = $request['status'];
        }
        return $this;
    }

    public function assignData(): void
    {
        $this->data = [
            'name' => $this->name,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject_id' => $this->subjectId,
            'message' => $this->message,
            'status' => $this->status,
        ];
    }

    public function save()
    {
        $this->assignData();
        $db = new DBHelper();
        $db->insert(static::TABLE, $this->data)->exec();
    }

    public function delete($id)
    {
        $db = new DBHelper();
        $db->delete()->from(static::TABLE)->where('id', $id)->exec();
    }
}