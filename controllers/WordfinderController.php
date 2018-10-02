<?php

require __DIR__ .'/BaseController.php';

class WordfinderController extends BaseController
{
    protected $dictionaryPath = '/usr/share/dict/words';

    public function findWords($exp)
    {
        if (preg_match('/^[!a-z]+$/', $exp) == 0) {
            $this->sendResponse(['message' => 'Characters must be lowercase a-z'], 400);
        }

        if ($this->charRepeated($exp)) {
            $this->sendResponse(['message' => 'Characters must only be used once in the query'], 400);
        }

        $words = $this->searchDictionary($exp);

        if (count($words) < 1) {
            $this->sendResponse(['message' => 'no words were found'], 404);
        }

        $this->sendResponse($words);
    }

    /**
     * Search Linux dictionary for words matching pattern.
     *
     * @todo: grep command currently only finds words where the chars in the query are in the same order as the word itself.
     *
     * @param string $exp
     *
     * @return array
     */
    public function searchDictionary($exp)
    {
        $regex = [];
        $count = strlen($exp);

        for ($pos=0; $pos<$count; $pos++) {
            $regex[] = "[". $exp[$pos] ."]";
        }

        $regex = implode($regex);
        $regex = "'". $regex ."'";

        $words = exec("grep $regex ". $this->dictionaryPath, $foundWords);

        return $foundWords;
    }

    /**
     * Find if a character was used multiple times in the expression.
     *
     * @param string $exp
     *
     * @return boolean
     */
    protected function charRepeated($exp)
    {
        $count = strlen($exp);

        for ($pos=0; $pos<$count; $pos++) {
            if (substr_count($exp, $exp[$pos]) > 1) {
                return true;
            }
        }

        return false;
    }
}




$params = $_REQUEST;

$cont = new WordfinderController;

$exp = $params['exp'] ?? null;

if (!$exp) {
    $cont->sendResponse(['message' => 'parameter `n` not received'], 422);
}

$value = $cont->findWords($exp);

$cont->sendBasicResponse($value);
