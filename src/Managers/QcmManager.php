<?php

final class QcmManager
{

    private QcmRepository $qcmrepository;
    private QuestionRepository $questionrepository;
    private AnswerRepository $answerrepository;

    public function __construct()
    {
        $this->qcmrepository = new QcmRepository;
        $this->questionrepository = new QuestionRepository;
        $this->answerrepository = new AnswerRepository;
    }

    public function getQcmById(int $id): ?Qcm
    {
        // Récupération du QCM de base
        $qcm = $this->qcmrepository->findById($id);
        if (!$qcm) {
            return null;
        }

        // Récupération des questions associées au QCM
        $questions = $this->questionrepository->findByQcmId($id);
        foreach ($questions as $question) {
            // Récupération des réponses associées à chaque question
            $answers = $this->answerrepository->findAnswerByQuestionId($question->getId());
            $question->setAnswers($answers);
        }

        // Association des questions au QCM
        $qcm->setQuestions($questions);

        return $qcm;
    }


    public function createQcm(string $theme): ?int
    {
        return $this->qcmrepository->insert($theme);
    }

    public function createQcmObjet(string $theme): Qcm
    {
        return $this->qcmrepository->findByTheme($theme);;
    }

    public function createQuestionObject(int $qcmId): array
    {
        return $this->questionrepository->findByQcmId($qcmId);
    }

    public function createAnswersObject(int $questionId): array
    {
        return $this->answerrepository->findAnswerByQuestionId($questionId);
    }

    public function getQcmDetailsById(int $id): ?array
    {
        $qcm = $this->qcmrepository->findById($id);

        if ($qcm) {
            return [
                "theme" => strtoupper($qcm->getTheme()),
                "wording" => ($qcm->getQuestions())
            ];
        }
    }
 public function answersByQuestions(array $questions)
{
    foreach ($questions as $question) {
        $this->answerrepository->findAnswerByQuestionId($question->getId());
        var_dump($question);
    }
    
}
    public function generateDisplay(string $theme): string
    {

        $qcm = $this->createQcmObjet($theme);
        $questions = $this->createQuestionObject($qcm->getId());
$this->answersByQuestions($questions);
        $answers = $this->createAnswersObject(1);
       


        $html = "<p>" . htmlspecialchars($qcm->getTheme()) . "</p>";

        foreach ($qcm->getQuestions() as $question) {
            $html .= "<h3>" . htmlspecialchars($question->getWording()) . "</h3>";
            $html .= "<ul>";

            foreach ($question->getAnswers() as $answer) {
                $html .= "<li>" . htmlspecialchars($answer->getAnswer()) . "</li>";
            }

            $html .= "</ul>";
        }

        return $html;
    }
}
