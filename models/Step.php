<?php
require_once __DIR__ . '/Connexion.php';

class Step
{
    private int $id;
    private string $name;
    private string $url_img;
    private string $description;
    private string $question;
    private int $answer_id;
    private int $course_id;
    private ?string $indice;
    private int $order;

    public function __construct(int $id, string $name, string $url_img, string $description, string $question, int $answer_id, int $course_id, ?string $indice, int $order)
    {
        $this->id = $id;
        $this->name = $name;
        $this->url_img = $url_img;
        $this->description = $description;
        $this->question = $question;
        $this->answer_id = $answer_id;
        $this->course_id = $course_id;
        $this->indice = $indice;
        $this->order = $order;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getUrlImg(): string
    {
        return $this->url_img;
    }

    public function setUrlImg(string $url_img)
    {
        $this->url_img = $url_img;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function setQuestion(string $question)
    {
        $this->question = $question;
    }

    public function getAnswerId(): int
    {
        return $this->answer_id;
    }

    public function setAnswerId(int $answer_id)
    {
        $this->answer_id = $answer_id;
    }

    public function getCourseId(): int
    {
        return $this->course_id;
    }

    public function setCourseId(int $course_id)
    {
        $this->course_id = $course_id;
    }

    public function getIndice(): ?string
    {
        return $this->indice;
    }

    public function setIndice(?string $indice)
    {
        $this->indice = $indice;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function setOrder(int $order)
    {
        $this->order = $order;
    }

    public static function findById(int $id, bool $asArray = false)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT * FROM step WHERE id = :id');
        $req->execute(['id' => $id]);

        $step = $req->fetch();
        if ($step) {
            if ($asArray) {
                return [
                    'id' => $step['id'],
                    'name' => $step['name'],
                    'url_img' => $step['url_img'],
                    'description' => $step['description'],
                    'question' => $step['question'],
                    'answer_id' => $step['answer_id'],
                    'course_id' => $step['course_id'],
                    'indice' => $step['indice'],
                    'order' => $step['order']
                ];
            } else {
                return new Step($step['id'], $step['name'], $step['url_img'], $step['description'], $step['question'], $step['answer_id'], $step['course_id'], $step['indice'], $step['order']);
            }
        }
        return false;
    }

    public static function findAllByCourseId(int $course_id): array
    {
        $pdo = Connexion::connect();

        $req = $pdo->prepare('SELECT * FROM step where course_id = :id ORDER BY `order` asc');
        $req->bindParam("id", $course_id, PDO::PARAM_INT);
        $req->execute();
        $steps = [];
        while ($step = $req->fetch())
        {
            $steps[] = new Step($step['id'], $step['name'], $step['url_img'], $step['description'], $step['question'], $step['answer_id'], $step['course_id'], $step['indice'], $step['order']);
        }
        return $steps;
    }

    public static function countByCourseId(int $course_id): int
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('SELECT count(*) as count FROM step where course_id = :id');
        $req->bindParam("id", $course_id, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetch();
        return $result['count'];
    }

    public static function create(string $name, string $url_img, string $description, string $question, int $answer_id, int $course_id, ?string $indice, int $order)
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('INSERT INTO step (name, url_img, description, question, answer_id, course_id, indice, `order`) VALUES (:name, :url_img, :description, :question, :answer_id, :course_id, :indice, :order)');
        $rep = $req->execute([
            'name' => $name, 
            'url_img' => $url_img, 
            'description' => $description, 
            'question' => $question, 
            'answer_id' => $answer_id, 
            'course_id' => $course_id,
            'indice' => $indice,
            'order' => $order
        ]);
        return $rep ? new Step($pdo->lastInsertId(), $name, $url_img, $description, $question, $answer_id, $course_id, $indice, $order) : $rep;
    }

    public static function update(int $id, string $name, string $url_img, string $description, string $question, int $answer_id, int $course_id, ?string $indice, $order): bool
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('UPDATE step SET name = :name, url_img = :url_img, description = :description, question = :question, answer_id = :answer_id, course_id = :course_id, indice = :indice, order = :order WHERE id = :id');
        return $req->execute([
            'name' => $name, 
            'url_img' => $url_img, 
            'description' => $description, 
            'question' => $question, 
            'answer_id' => $answer_id, 
            'course_id' => $course_id,
            'indice' => $indice,
            'order' => $order,
            'id' => $id
        ]);
    }

    public static function delete(int $id): bool
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('DELETE FROM step WHERE id = :id');
        return $req->execute(['id' => $id]);
    }

    public static function deleteAllByCourseId(int $course_id): bool
    {
        $pdo = Connexion::connect();
        $req = $pdo->prepare('DELETE FROM step WHERE course_id = :id');
        return $req->execute(['id' => $course_id]);
    }
}