<?php

class AnswerRepository extends AbstractRepository
{

  


    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Trouve un answer en fonction de son id
     */
    // public function findById(int $id): ?Answer
    // {
    //     $sql = "SELECT * FROM answer WHERE id = :id";

    //     try {

    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->execute([
    //             ":id" => $id
    //         ]);
    //         $answerData = $stmt->fetch(PDO::FETCH_ASSOC);

    //     } catch (PDOException $error) {
    //         echo "Erreur lors de la requete : " . $error->getMessage();
    //     }

    //     $answer = $this->mapper->mapToObject($answerData);

    //     if($answer){
    //         return $answer;
    //     } else {
    //         return null;
    //     }

    // }


    public function insert(string $answer, bool $isCorrect, int $id_question): ?int
    {
        $sql = "INSERT INTO `answer`(`answer`, `isCorrect`, `id_question`) VALUES (:answer, :isCorrect, :id_question)";

        try {

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":answer" => $answer,
                ":isCorrect" => $isCorrect,
                ":id_question" => $id_question
            ]);

              // Retourne l'ID de la réponse insérée
              return (int)$this->pdo->lastInsertId();
        } catch (PDOException $error) {
            echo "Erreur lors de la requete : " . $error->getMessage();
        }
    }

    public function findAnswerByQuestionId(int $id_question): array
    {
        $sql = "SELECT * FROM answer WHERE id_question = :id_question";
        $answers = [];

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([":id_question" => $id_question]);

            while ($answerData = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $answers[] = AnswerMapper::mapToObject($answerData);
            }

        } catch (PDOException $error) {
            // Log the error instead of echoing it
            error_log("Erreur lors de la requête findByQuestionId: " . $error->getMessage());
        }

        return $answers;
    }
}