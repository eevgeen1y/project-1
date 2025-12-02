<?php

abstract class User {
    private $name;
    private $email;

    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }

    abstract public function getRole();

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
}

class Student extends User {
    private $group;

    public function __construct($name, $email, $group) {
        parent::__construct($name, $email);
        $this->group = $group;
    }

    public function getRole() {
        return "Студент";
    }

    public function getGroup() {
        return $this->group;
    }

    public function setGroup($group) {
        $this->group = $group;
    }
}

class Teacher extends User {
    private $subject;

    public function __construct($name, $email, $subject) {
        parent::__construct($name, $email);
        $this->subject = $subject;
    }

    public function getRole() {
        return "Викладач";
    }

    public function getSubject() {
        return $this->subject;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }
}

$student = new Student("Іван Петренко", "ivan.petrenko@example.com", "КН-24");
$teacher = new Teacher("Олена Коваленко", "olena.kovalenko@example.com", "Веб-технології");

echo "Ім'я: " . $student->getName() . "\n";
echo "Email: " . $student->getEmail() . "\n";
echo "Роль: " . $student->getRole() . "\n";
echo "Група: " . $student->getGroup() . "\n";
echo "\n";

echo "Ім'я: " . $teacher->getName() . "\n";
echo "Email: " . $teacher->getEmail() . "\n";
echo "Роль: " . $teacher->getRole() . "\n";
echo "Предмет: " . $teacher->getSubject() . "\n";

?>
