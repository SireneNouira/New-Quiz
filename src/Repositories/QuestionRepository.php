<?php

class QuestionRepository extends AbstractRepository
{

    private QuestionMapper $mapper;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new QuestionMapper();
    }

    /**
     * Trouve une question en fonction de son id
     */
    // public function findById(int $id): ?Question
    // {
    //     $sql = "SELECT * FROM question WHERE id = :id";

    //     try {

    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->execute([
    //             ":id" => $id
    //         ]);
    //         $questionData = $stmt->fetch(PDO::FETCH_ASSOC);

    //     } catch (PDOException $error) {
    //         echo "Erreur lors de la requete : " . $error->getMessage();
    //     }

    //     $question = $this->mapper->mapToObject($questionData);

    //     if($question){
    //         return $question;
    //     } else {
    //         return null;
    //     }

    // }


    public function insert(string $wording, int $id_qcm, string $explanation): ?int
    {
        $sql = "INSERT INTO `question`(`wording`, `id_qcm`, `explanation`) VALUES ( :wording, :id_qcm, :explanation)";

        try {

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":wording" => $wording,
                ":id_qcm" => $id_qcm,
                ":explanation" => $explanation
            ]);

             // Retourne l'ID de la question insérée
             return (int) $this->pdo->lastInsertId();
        } catch (PDOException $error) {
            echo "Erreur lors de la requete : " . $error->getMessage();
        }
    }

    public function findByQcmId(int $id_qcm): array
    {
        $sql = "SELECT * FROM question WHERE id_qcm = :id_qcm";
        $questions = [];

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([":id_qcm" => $id_qcm]);

            while ($questionData = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $questions[] = $this->mapper->mapToObject($questionData);
            }
        } catch (PDOException $error) {
            // Log the error instead of echoing it
            error_log("Erreur lors de la requête findByQcmId: " . $error->getMessage());
        }

        return $questions;
    }
}