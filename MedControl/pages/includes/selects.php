<?php
class DBSelects extends medcontrol_db {
    public function select_all_cids() {
        try {
            $result = $this->connect()->query("SELECT * FROM doencas");
            if ($result->rowCount() > 0) {
                $cout = 1;
                while ($cid = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                    <li class="list-group-item">
                        <div class="form-check">
                            <input class="form-check-input" name="'.$cid["CID"].'" type="radio" name="exampleRadios" id="exampleRadios'.$cout.'">
                            <label class="form-check-label" for="exampleRadios'.$cout.'">
                                '.$cid["nome"].'
                            </label>
                        </div>
                    </li>';
                    $cout ++;
                }
            } else {
                echo '
                <li class="list-group-item">
                    <div class="form-check">
                        <input class="form-check-input" name="" type="radio" name="exampleRadios" id="exampleRadios">
                        <label class="form-check-label" for="exampleRadios">
                            Nenhum doença encontrada.
                        </label>
                    </div>
                </li>';
            }
        } catch (PDOException $error){
            echo "Erro na consulta: " . $error->getMessage();
            return false;
        }
    }
}

?>
