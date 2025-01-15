<?php

final class QcmRepository extends AbstractRepository
{


    private QcmMapper $mapper;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new QcmMapper();
    }

    
    public function findAll(): array
    {
        $query = "SELECT * FROM qcm";
        $stmt = $this->pdo->query($query);
        $qcmDatas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($qcmDatas as $qcmData) {
            $qcms[] = QcmMapper::mapToObject($qcmData);
        }

        return $qcms;
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

        $qcm = QcmMapper::mapToObject($qcmData);

        if ($qcm) {
            return $qcm;
        } else {
            return null;
        }
    }


    public function insert(string $theme): ?int
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
