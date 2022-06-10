<?php
require_once __DIR__ . '/Connexion.php';

class Answer
{
    private int $id;
    private int $step_id;
    private string $libelle;

    public function __construct(int $id, int $step_id, string $libelle)
    {
        $this->id = $id;
        $this->step_id = $step_id;
        $this->libelle = $libelle;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStepId(): int
    {
        return $this->step_id;
    }

    public function setStepId(int $step_id)
    {
        $this->step_id = $step_id;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @param int $id
     * @return Step|false
     */
    public static function findById(int $id)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM answer WHERE id = :id');
        $req->execute(['id' => $id]);

        $answer = $req->fetch();
        return $answer ? new Answer($answer['id'], $answer['step_id'], $answer['libelle']) : false;
    }

    public static function findAllByStepId(int $step_id): array
    {
        $pdo = Connexion::connect();

        $req = $pdo->prepare('SELECT * FROM answer where step_id = :id ORDER BY id');
        $req->bindParam("id", $step_id, PDO::PARAM_INT);
        $req->execute();
        $answers = [];
        while ($answer = $req->fetch())
        {
            $answers[] = new Answer($answer['id'], $answer['step_id'], $answer['libelle']);
        }
        return $answers;
    }

    public static function create(int $step_id, string $libelle)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('INSERT INTO answer (step_id, libelle) VALUES (:step_id, :libelle)');
        $rep = $req->execute([
            'step_id' => $step_id,
            'libelle' => $libelle
        ]);
        return $rep ? new Answer($pdo->lastInsertId(), $step_id, $libelle) : $rep;
    }

    public static function update(int $id, int $step_id, string $libelle): bool
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('UPDATE answer SET step_id = :step_id, libelle = :libelle WHERE id = :id');
        return $req->execute([
            'step_id' => $step_id,
            'libelle' => $libelle,
            'id' => $id
        ]);
    }

    public static function delete(int $id): bool
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('DELETE FROM answer WHERE id = :id');
        return $req->execute(['id' => $id]);
    }

    public static function deleteByStepId(int $step_id)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('DELETE FROM answer WHERE step_id = :id');
        return $req->execute(['id' => $step_id]);
    }
}