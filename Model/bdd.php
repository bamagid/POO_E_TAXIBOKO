<?php
class Database {
    private $bdd;

    public function setBDD($bdd) {
        $this->bdd = $bdd;
    }

    public function getBdd() {
        return $this->bdd;
    }

    public function connect($bdd) {
        $this->setBDD($bdd);
    }
}
?>
