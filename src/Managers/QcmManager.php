<?php

final class QcmManager
{

    private QcmRepository $qcmRepository;
    private QuestionRepository $questionRepository;
    private AnswerRepository $answerRepository;

    public function __construct()
    {
        $this->qcmRepository = new QcmRepository;
        $this->questionRepository = new QuestionRepository;
        $this->answerRepository = new AnswerRepository;
    }

    public function generateQcm(int $id): string
    {
        return $this->generateDisplay($this->buildQcm($id));
    }

    private function buildQcm(int $id): ?Qcm
    {
        // Récupération du QCM de base
        $qcm = $this->qcmRepository->findById($id);
        if (!$qcm) {
            return null;
        }

        // Récupération des questions associées au QCM
        $questions = $this->questionRepository->findByQcmId($id);
        foreach ($questions as $question) {
            // Récupération des réponses associées à chaque question
            $answers = $this->answerRepository->findAnswerByQuestionId($question->getId());
            $question->setAnswers($answers);
        }

        // Association des questions au QCM
        $qcm->setQuestions($questions);

        return $qcm;
    }


    private function generateDisplay(Qcm $qcm, int $currentQuestionIndex = 0): string
    {
        $questions = $qcm->getQuestions();
        if (!isset($questions[$currentQuestionIndex])) {
            return '<p>Fin du quiz !</p>';
        }

        $question = $questions[$currentQuestionIndex];
        ob_start(); 
    ?>
        <main>
            <section>
                <h1><?= htmlspecialchars($qcm->getTheme()) ?></h1>
                <h3><?= htmlspecialchars($question->getWording()) ?></h3>
                <ul>
                    <?php foreach ($question->getAnswers() as $answer): ?>
                        <li><?= htmlspecialchars($answer->getAnswer()) ?></li>
                    <?php endforeach; ?>
                </ul>
                <button id="next-question" data-current="<?= $currentQuestionIndex ?>">Suivant</button>
            </section>
        </main>
    <?php
        return ob_get_clean();
    }
}
