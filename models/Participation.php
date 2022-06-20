<?php

class Participation
{
    private int $id;
    private int $user_id;
    private int $course_id;
    private DateTime $start_date;
    private ?DateTime $end_date;
    private string $state;
    private int $step;
    private int $score;

    /**
     * @param int $id
     * @param int $user_id
     * @param int $course_id
     * @param DateTime $start_date
     * @param ?DateTime $end_date
     * @param string $state
     * @param int $step
     * @param int $score
     */
    public function __construct(int $id, int $user_id, int $course_id, DateTime $start_date, ?DateTime $end_date, string $state, int $step, int $score)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->course_id = $course_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->state = $state;
        $this->step = $step;
        $this->score = $score;
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
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getCourseId(): int
    {
        return $this->course_id;
    }

    /**
     * @param int $course_id
     */
    public function setCourseId(int $course_id): void
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
     * @return int
     */
    public function getStep(): int
    {
        return $this->step;
    }

    /**
     * @param int $step
     */
    public function setStep(int $step): void
    {
        $this->step = $step;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @param int $score
     */
    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    public static function findById(int $id)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM participation WHERE id = :id');
        $req->execute(['id' => $id]);

        $participation = $req->fetch();
        if ($participation) {
            $startDate = new DateTime($participation['start_date']);
            $endDate = new DateTime($participation['end_date']);
            return new Participation($participation['id'], $participation['user_id'], $participation['course_id'], $startDate, $endDate, $participation['state'], $participation['step'], $participation['score']);
        }
        return false;
    }

    public static function findInProgressByUserId(int $userId)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare("SELECT * FROM participation WHERE user_id = :user_id AND state = 'inProgress'");
        $req->execute(['user_id' => $userId]);

        $participation = $req->fetch();
        if ($participation) {
            $startDate = new DateTime($participation['start_date']);
            $endDate = new DateTime($participation['end_date']);
            return new Participation($participation['id'], $participation['user_id'], $participation['course_id'], $startDate, $endDate, $participation['state'], $participation['step'], $participation['score']);
        }
        return false;
    }

    public static function findAll(): array
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM participation');
        $req->execute();

        while ($participation = $req->fetch())
        {
            $participation[] = new Participation($participation['id'], $participation['user_id'], $participation['course_id'], $participation['start_date'], $participation['end_date'], $participation['state'], $participation['step'], $participation['score']);
        }
        return $participation;
    }

    public static function findAllByUser(int $user_id):array
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM participation WHERE user_id = :user_id');
        $req->execute(['user_id' => $user_id]);

        while ($participation = $req->fetch())
        {
            $participation[] = new Participation($participation['id'], $participation['user_id'], $participation['course_id'], $participation['start_date'], $participation['end_date'], $participation['state'], $participation['step'], $participation['score']);
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

        while ($participation = $req->fetch())
        {
            $participation[] = new Participation($participation['id'], $participation['user_id'], $participation['course_id'], $participation['start_date'], $participation['end_date'], $participation['state'], $participation['step'], $participation['score']);
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
        return $rep ? new Participation($pdo->lastInsertId(), $user_id, $course_id, $date, null, $state, 0, 0) : $rep;
    }

    public function update(int $user_id, int $course_id, DateTime $start_date, DateTime $end_date, string $state, int $step, int $score): bool
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('UPDATE participation SET user_id = :user_id, course_id = :course_id, start_date = :start_date, end_date = :end_date, state = :state, step = :step, score = :score WHERE id = :id');
        $rep = $req->execute([
            'user_id' => $user_id,
            'course_id' => $course_id,
            'start_date' => $start_date->format("Y-m-d H:i:s"),
            'end_date' => $end_date->format("Y-m-d H:i:s"),
            'state' => $state,
            'step' => $step,
            'score' => $score,
            'id' => $this->getId()
        ]);
        if ($rep) {
            $this->setUserId($user_id);
            $this->setCourseId($course_id);
            $this->setDateStart($start_date);
            $this->setDateEnd($end_date);
            $this->setState($state);
            $this->setStep($step);
        }
        return $rep;
    }

    public function finish(bool $abandon = false)
    {
        $endDate = new DateTime();
        $timezone = new DateTimeZone('Europe/Paris');
        $endDate->setTimezone($timezone);
        $this->update($this->getUserId(), $this->getCourseId(), $this->getDateStart(), $endDate, $abandon ? 'abandon' : 'finish', $this->getStep(), $abandon ? 0 : $this->getScore());
    }

    public function updateStep(int $step)
    {
        $this->update($this->getUserId(), $this->getCourseId(), $this->getDateStart(), $this->getDateEnd(), $this->getState(), $step, $this->getScore());
    }

    public function addScore(int $scoreAdded)
    {
        $this->update($this->getUserId(), $this->getCourseId(), $this->getDateStart(), $this->getDateEnd(), $this->getState(), $this->getStep(), $this->getScore() + $scoreAdded);
    }

    public function delete()
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('DELETE FROM participation WHERE id = :id');
        $req->execute(['id' => $this->getId()]);
    }
}