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
        $qcm = $this->buildQcm($id);

        session_start();

        if (!isset($_SESSION['qcm']) && !isset($_SESSION['current_question'])) {

            $_SESSION[$_GET['quiz_id']];
            $_SESSION['qcm'] = $qcm;
            $_SESSION['current_question'] = 0;
        }


        return $this->generateDisplayQuiz($qcm, $_SESSION['current_question']);
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

    public function generateDisplayQuiz(Qcm $qcm, int $currentQuestionIndex = 0, ?int $score = null, bool $finished = false): string
    {
        $questions = $qcm->getQuestions();

        ob_start();
?>
        <main>
            <article class="input-field3">
                <div>
                    <h1><?= htmlspecialchars($qcm->getTheme()) ?></h1>

                    <?php if (!$finished && isset($questions[$currentQuestionIndex])): ?>
                        <h2>Question <?= $currentQuestionIndex + 1; ?>/<?= count($questions); ?></h2>
                    <?php endif; ?>
                </div>

                <div id="quiz-container">
                    <?php if ($finished): ?>
                        <h3>Quiz terminé ! Votre score : <?= $score; ?> / <?= count($questions); ?></h3>
                        <a href="../choixquizz.php" class="login-btn3">Revenir au menu</a>
                    <?php else: ?>
                        <?php if (isset($questions[$currentQuestionIndex])): ?>
                            <?php $question = $questions[$currentQuestionIndex]; ?>
                            <h3 class="question" id="question-text">
                                <?= htmlspecialchars($question->getWording()); ?>
                            </h3>

                            <form method="post" action="../public/process/handleNext.php">
                                <div id="answers">
                                    <?php foreach ($question->getAnswers() as $answer): ?>
                                        <input
                                            class="reponses"
                                            type="radio"
                                            name="answer"
                                            value="<?= $answer->getId(); ?>"
                                            data-correct="<?= $answer->getIsCorrect() ? '1' : '0'; ?>">
                                        <?= htmlspecialchars($answer->getAnswer()); ?>
                                        </input>
                                    <?php endforeach; ?>
                                </div>

                                <button id="suivant-btn" class="suivant-btn-off" type="submit" name="suivant">Suivant</button>
                            </form>
                        <?php else: ?>
                            <?php var_dump($_SESSION)?>
                            <p>Aucune question disponible.</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </article>
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
                </div> <a href="./logout.php" class="login-btn ">DECONNEXION</a>
            </article>


        </main>
<?php
        return ob_get_clean();
    }
}
