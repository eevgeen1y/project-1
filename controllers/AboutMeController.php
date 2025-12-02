<?php

class AboutMeController
{
    private string $name;
    private string $email;
    private string $bio;
    private array $skills;
    private array $education;
    private array $experience;

    public function __construct()
    {
        $this->name = "Іван Петренко";
        $this->email = "ivan.petrenko@example.com";
        $this->bio = "Студент курсу веб-технологій та PHP. Захоплююся розробкою веб-додатків та вивченням сучасних технологій.";
        $this->skills = ["PHP", "HTML", "CSS", "JavaScript", "MySQL"];
        $this->education = [
            "Університет" => "Національний університет",
            "Факультет" => "Комп'ютерні науки",
            "Група" => "КН-24"
        ];
        $this->experience = [
            [
                "position" => "Студент-розробник",
                "company" => "Університет",
                "period" => "2023 - дотепер",
                "description" => "Вивчення веб-технологій та створення проєктів"
            ]
        ];
    }

    public function getData(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'bio' => $this->bio,
            'skills' => $this->skills,
            'education' => $this->education,
            'experience' => $this->experience
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function getSkills(): array
    {
        return $this->skills;
    }

    public function getEducation(): array
    {
        return $this->education;
    }

    public function getExperience(): array
    {
        return $this->experience;
    }
}
