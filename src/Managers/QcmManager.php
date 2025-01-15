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
        return $this->generateDisplayQuiz($this->buildQcm($id));
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

    public function generateDisplayQuiz(Qcm $qcm, int $currentQuestionIndex = 0): string
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

    public function displayAllQcm(): string
    {
        // Récupérer tous les QCM depuis le repository
        $qcms = $this->qcmRepository->findAll();

        // Utiliser la méthode generateDisplayChoix pour générer l'affichage
        return $this->generateDisplayChoix($qcms);
    }


    private function generateDisplayChoix(array $qcms): string
    {
        ob_start();
    ?>
        <main>


            <article class="input-field2">
                <h1>HELLO</h1>

                <div class="flex">
                    <?php
                    foreach ($qcms as $qcm) : ?>
                        <div class="card">
                            <img src="assets/imgs/iconquizfinal.png" alt="logo-quiz">
                            <h2><?= htmlspecialchars($qcm->getTheme()); ?></h2>
                            <form method="POST" action="../public/process/handlePlay.php">
                                <input type="hidden" name="quiz_id" value="<?= htmlspecialchars($qcm->getId()); ?>">
                                <button type="submit" class="login-btn2" name="jouer">Jouer</button>
                            </form>
                        </div> <?php endforeach ?>
                </div>      <a href="./logout.php" class="login-btn ">DECONNEXION</a>
            </article>
      
          
        </main>  
<?php
                    return ob_get_clean();
                }
}
