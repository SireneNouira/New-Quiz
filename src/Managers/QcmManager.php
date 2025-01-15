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

    public function generateQcm(int $id): string
    {
        return $this->generateDisplay($this->buildQcm($id));
    }

    private function buildQcm(int $id): ?Qcm
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

    private function generateDisplay(Qcm $qcm): string
    {
        ob_start(); ?>

        <section>

            <p> <?= htmlspecialchars($qcm->getTheme()) ?> </p>;

            <?php

            foreach ($qcm->getQuestions() as $question) : ?>
                <h3> <?= htmlspecialchars($question->getWording()) ?> </h3>

                <ul> <?php

                        foreach ($question->getAnswers() as $answer) :  ?>
                        <li> <?= htmlspecialchars($answer->getAnswer()) ?> </li>;
                <?php
                        endforeach;
                    endforeach
                ?>
                </ul>

        </section>





<?php
        return ob_get_clean();
    }
}
