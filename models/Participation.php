<?php

class Participation
{
    private int $id;
    private int $id_user;
    private int $id_course;
    private DateTime $date_start;
    private DateTime $date_end;
    private string $state;

    /**
     * @param int $id
     * @param int $id_user
     * @param int $id_course
     * @param DateTime $date_start
     * @param DateTime $date_end
     * @param string $state
     */
    public function __construct(int $id, int $id_user, int $id_course, DateTime $date_start, DateTime $date_end, string $state)
    {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->id_course = $id_course;
        $this->date_start = $date_start;
        $this->date_end = $date_end;
        $this->state = $state;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     */
    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * @return int
     */
    public function getIdCourse(): int
    {
        return $this->id_course;
    }

    /**
     * @param int $id_course
     */
    public function setIdCourse(int $id_course): void
    {
        $this->id_course = $id_course;
    }

    /**
     * @return DateTime
     */
    public function getDateStart(): DateTime
    {
        return $this->date_start;
    }

    /**
     * @param DateTime $date_start
     */
    public function setDateStart(DateTime $date_start): void
    {
        $this->date_start = $date_start;
    }

    /**
     * @return DateTime
     */
    public function getDateEnd(): DateTime
    {
        return $this->date_end;
    }

    /**
     * @param DateTime $date_end
     */
    public function setDateEnd(DateTime $date_end): void
    {
        $this->date_end = $date_end;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    /**
     * @param int $id
     * @return Participation|bool
     */
    public static function findById(int $id)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM participation WHERE id = :id');
        $req->execute(['id' => $id]);

        $participation = $req->fetch();
        return $participation ? new Participation($participation['id'], $participation['id_user'], $participation['id_course'], $participation['date_start'], $participation['date_end'], $participation['state']) : false;
    }

    public static function findByUser(int $id_user):array
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM participation WHERE id_user = :id_user');
        $req->execute(['id_user' => $id_user]);

        $participation = [];
        while ($participation = $req->fetch())
        {
            $participation[] = new Participation($participation['id'], $participation['id_user'], $participation['id_course'], $participation['date_start'], $participation['date_end'], $participation['state']);
        }
        return $participation;
    }

    /**
     * @param int $id_course
     * @return Participation|bool
     */
    public static function findByCourse(int $id_course):array
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM participation WHERE id_course = :id_course');
        $req->execute(['id_course' => $id_course]);

        $participation = [];
        while ($participation = $req->fetch())
        {
            $participation[] = new Participation($participation['id'], $participation['id_user'], $participation['id_course'], $participation['date_start'], $participation['date_end'], $participation['state']);
        }
        return $participation;
    }

    public static function findAll(): array
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM participation');
        $req->execute();

        $participation = [];
        while ($participation = $req->fetch())
        {
            $participation[] = new Participation($participation['id'], $participation['id_user'], $participation['id_course'], $participation['date_start'], $participation['date_end'], $participation['state']);
        }
        return $participation;
    }

    public static function create(int $id_user, int $id_course, DateTime $date_start, DateTime $date_end, string $state): bool
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('INSERT INTO participation (id_user, id_course, date_start, date_end, state) VALUES (:id_user, :id_course, :date_start, :date_end, :state)');
        return $req->execute([
            'id_user' => $id_user,
            'id_course' => $id_course,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'state' => $state
        ]);
    }

    public static function update(int $id_user, int $id_course, DateTime $date_start, DateTime $date_end, string $state): bool
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('UPDATE participation SET id_user = :id_user, id_course = :id_course, date_start = :date_start, date_end = :date_end, state = :state WHERE id = :id');
        return $req->execute([
            'id_user' => $id_user,
            'id_course' => $id_course,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'state' => $state
        ]);
    }

    public function delete()
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('DELETE FROM participation WHERE id = :id');
        $req->execute(['id' => $this->getId()]);
    }
}