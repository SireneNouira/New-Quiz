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

    private function generateDisplay(Qcm $qcm): string
    {
        ob_start(); ?>
 <main>
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
</main>


<?php
        return ob_get_clean();
    }
}
