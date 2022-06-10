<?php

class Participation
{
    private int $id;
    private int $user_id;
    private int $course_id;
    private DateTime $start_date;
    private ?DateTime $end_date;
    private string $state;

    /**
     * @param int $id
     * @param int $user_id
     * @param int $course_id
     * @param DateTime $start_date
     * @param ?DateTime $end_date
     * @param string $state
     */
    public function __construct(int $id, int $user_id, int $course_id, DateTime $start_date, ?DateTime $end_date, string $state)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->course_id = $course_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
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
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setIdUser(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getIdCourse(): int
    {
        return $this->course_id;
    }

    /**
     * @param int $course_id
     */
    public function setIdCourse(int $course_id): void
    {
        $this->course_id = $course_id;
    }

    /**
     * @return DateTime
     */
    public function getDateStart(): DateTime
    {
        return $this->start_date;
    }

    /**
     * @param DateTime $start_date
     */
    public function setDateStart(DateTime $start_date): void
    {
        $this->start_date = $start_date;
    }

    /**
     * @return DateTime
     */
    public function getDateEnd(): DateTime
    {
        return $this->end_date;
    }

    /**
     * @param DateTime $end_date
     */
    public function setDateEnd(DateTime $end_date): void
    {
        $this->end_date = $end_date;
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
        return $participation ? new Participation($participation['id'], $participation['user_id'], $participation['course_id'], $participation['start_date'], $participation['end_date'], $participation['state']) : false;
    }

    public static function findInProgressByUserId(int $userId)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare("SELECT * FROM participation WHERE user_id = :user_id AND state = 'inProgress'");
        $req->execute(['user_id' => $userId]);

        $participation = $req->fetch();
        $startDate = new DateTime($participation['start_date']);
        $endDate = new DateTime($participation['end_date']);
        return $participation ? new Participation($participation['id'], $participation['user_id'], $participation['course_id'], $startDate, $endDate, $participation['state']) : false;
    }

    public static function findAll(): array
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM participation');
        $req->execute();

        $participation = [];
        while ($participation = $req->fetch())
        {
            $participation[] = new Participation($participation['id'], $participation['user_id'], $participation['course_id'], $participation['start_date'], $participation['end_date'], $participation['state']);
        }
        return $participation;
    }

    public static function findAllByUser(int $user_id):array
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM participation WHERE user_id = :user_id');
        $req->execute(['user_id' => $user_id]);

        $participation = [];
        while ($participation = $req->fetch())
        {
            $participation[] = new Participation($participation['id'], $participation['user_id'], $participation['course_id'], $participation['start_date'], $participation['end_date'], $participation['state']);
        }
        return $participation;
    }

    /**
     * @param int $course_id
     * @return Participation|bool
     */
    public static function findAllByCourse(int $course_id):array
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM participation WHERE course_id = :course_id');
        $req->execute(['course_id' => $course_id]);

        $participation = [];
        while ($participation = $req->fetch())
        {
            $participation[] = new Participation($participation['id'], $participation['user_id'], $participation['course_id'], $participation['start_date'], $participation['end_date'], $participation['state']);
        }
        return $participation;
    }

    public static function create(int $user_id, int $course_id, string $state)
    {
        $date = new DateTime();
        $timezone = new DateTimeZone('Europe/Paris');
        $date->setTimezone($timezone);

        $pdo = Connexion::connect();
        $req = $pdo->prepare('INSERT INTO participation (user_id, course_id, start_date, state) VALUES (:user_id, :course_id, :start_date, :state)');
        $rep = $req->execute([
            'user_id' => $user_id,
            'course_id' => $course_id,
            'start_date' => $date->format("Y-m-d H:i:s"),
            'state' => $state
        ]);
        return $rep ? new Participation($pdo->lastInsertId(), $user_id, $course_id, $date, null, $state) : $rep;
    }

    public static function update(int $user_id, int $course_id, DateTime $start_date, DateTime $end_date, string $state): bool
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('UPDATE participation SET user_id = :user_id, course_id = :course_id, start_date = :start_date, end_date = :end_date, state = :state WHERE id = :id');
        return $req->execute([
            'user_id' => $user_id,
            'course_id' => $course_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
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