<?php

class QcmRepository extends AbstractRepository
{

    
    private QcmMapper $mapper;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new QcmMapper();
   
    }

    /**
     * Trouve un qcm en fonction de son id
     */
    public function findByTheme(string $theme): ?Qcm
    {
        $sql = "SELECT * FROM qcm WHERE theme = :theme";

        try {

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":theme" => $theme
            ]);
            $qcmData = $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {
            echo "Erreur lors de la requete : " . $error->getMessage();
        }

        $qcm = $this->mapper->mapToObject($qcmData);

        if($qcm){
            return $qcm;
        } else {
            return null;
        }

    }
    public function findById(string $id): ?Qcm
    {
        $sql = "SELECT * FROM qcm WHERE id = :id";

        try {

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id" => $id
            ]);
            $qcmData = $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {
            echo "Erreur lors de la requete : " . $error->getMessage();
        }

        $qcm = $this->mapper->mapToObject($qcmData);

        if($qcm){
            return $qcm;
        } else {
            return null;
        }

    }


    public function insert(string $theme) : ?int
    {
        $sql = "INSERT INTO `qcm`(`theme`) VALUES (:theme)";

        try {

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":theme" => $theme
            ]); 

            // Retourne l'ID du QCM inséré
            return (int) $this->pdo->lastInsertId();
        } catch (PDOException $error) {
            echo "Erreur lors de la requete : " . $error->getMessage();
        }
    }

}