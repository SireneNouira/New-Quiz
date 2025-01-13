<?php

final class QcmManager
{
    public function generateDisplay(Qcm $qcm): string
    {
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
