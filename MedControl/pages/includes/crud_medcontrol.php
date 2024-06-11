<?php
class PacienteQuerys extends medcontrol_db
{
    public $records_per_page = 10;

    /*
    Esta função realiza uma consulta para selecionar todos os pacientes, 
    paginados com base no número da página fornecida. O parâmetro opcional 
    $page é usado para calcular o deslocamento na consulta SQL e obter 
    os registros apropriados para exibir na página especificada.
    
    Parâmetros:
        - $page (int): Opcional. O número da página a ser exibida. Padrão é 1.
    
    Retorna:
        - array: Um array contendo os dados dos pacientes selecionados. 
        Se não houver pacientes, retorna um array vazio.
        - false: Se ocorrer um erro durante a execução da consulta.
    */
    public function select_all_pacientes($page = 1)
    {
        try {
            $offset = ($page - 1) * $this->records_per_page;
            $result = $this->connect()->prepare("
                SELECT 
                    ID, 
                    nome_completo, 
                    idade, 
                    sexo, 
                    cidade, 
                    estado, 
                    CPF, 
                    email, 
                    telefone 
                FROM 
                    paciente
                LIMIT $offset, :records_per_page
            ");
            $result->bindParam(':records_per_page', $this->records_per_page, PDO::PARAM_INT);
            $result->execute();
            if ($result->rowCount() > 0) {
                $pacientes = array();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $pacientes[] = $row;
                }
                return $pacientes;
            } else {
                return array();
            }
        } catch (PDOException $error) {
            echo "<tr><td colspan='8'>Erro na consulta: " . $error->getMessage() . "</td></tr>";
            return false;
        }
    }


    /*
    Esta função calcula o número total de páginas necessárias para exibir 
    todos os pacientes, com base no número de registros por página definido 
    na propriedade $records_per_page da classe.
    */
    public function pagination_pacientes()
    {
        $count_query = $this->connect()->query("
            SELECT COUNT(*) as total_paciente  FROM paciente;
        ");
        $count_query->execute();
        $total_pacientes = $count_query->fetch(PDO::FETCH_ASSOC)['total_paciente'];

        return ceil($total_pacientes / $this->records_per_page);
    }


    /*
        Esta função atualiza um prontuário existente no banco de dados com os novos dados fornecidos.
    */
    public function update_paciente($nome, $idade, $sexo, $cidade, $estado, $CPF, $email, $telefone, $id_paciente)
    {
        try {
            $connection = $this->connect();
            $result = $connection->prepare("
                UPDATE 
                    paciente
                SET
                    nome_completo = :nome,
                    idade = :idade,
                    sexo = :sexo,
                    cidade = :cidade,
                    estado = :estado,
                    CPF = :CPF,
                    email = :email,
                    telefone = :telefone
                WHERE
                    ID = :id_paciente
            ");
            $result->bindParam(':nome', $nome, PDO::PARAM_STR);
            $result->bindParam(':idade', $idade, PDO::PARAM_INT);
            $result->bindParam(':sexo', $sexo, PDO::PARAM_STR);
            $result->bindParam(':cidade', $cidade, PDO::PARAM_STR);
            $result->bindParam(':estado', $estado, PDO::PARAM_STR);
            $result->bindParam(':CPF', $CPF, PDO::PARAM_STR);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->bindParam(':telefone', $telefone, PDO::PARAM_STR);
            $result->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
    
            if (!$result) {
                throw new Exception("Erro ao preparar a declaração: " . implode(", ", $connection->errorInfo()));
            }
    
            if (!$result->execute()) {
                throw new Exception('Ocorreu um erro ao salvar o prontuário');
            }
    
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    /*
    Esta função realiza uma consulta para selecionar todos os prontuários 
    associados a um paciente específico, paginados com base no número da 
    página fornecida. O parâmetro $id_paciente identifica o paciente cujos 
    prontuários estão sendo consultados.
    
    Parâmetros:
        - $id_paciente (int): O ID do paciente cujos prontuários estão sendo consultados.
        - $page (int): Opcional. O número da página a ser exibida. Padrão é 1.
    
    Retorna:
        - array: Um array contendo os dados dos prontuários selecionados para o paciente.
        Se não houver prontuários, retorna um array vazio.
        - false: Se ocorrer um erro durante a execução da consulta.
    */
    public function select_all_prontuarios($id_paciente, $page = 1)
    {
        try {
            $offset = ($page - 1) * $this->records_per_page;
            $result = $this->connect()->prepare("
                SELECT
                    po.ID,
                    pe.nome_completo, 
                    ds.nome as doenca, 
                    po.status_diagnostico, 
                    CASE 
                        WHEN po.obito = 0 THEN 'N'
                        ELSE 'S' 
                    END AS obito, 
                    po.data_diagnostico, 
                    fo.nome 
                FROM 
                    prontuario po 
                INNER JOIN 
                    paciente pe 
                ON 
                    pe.ID = po.ID_paciente 
                INNER JOIN 
                    doencas ds 
                ON 
                    ds.ID = po.ID_doenca 
                INNER JOIN 
                    funcionario fo 
                ON 
                    fo.ID = po.ID_funcionario 
                WHERE 
                    pe.ID = :id_paciente
                ORDER BY 
                    po.data_diagnostico DESC
                LIMIT :offset, :records_per_page
            ");
            $result->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
            $result->bindParam(':offset', $offset, PDO::PARAM_INT);
            $result->bindParam(':records_per_page', $this->records_per_page, PDO::PARAM_INT);
            $result->execute();

            if ($result->rowCount() > 0) {
                $prontuarios = array();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $prontuarios[] = $row;
                }
                return $prontuarios;
            } else {
                return array();
            }
        } catch (PDOException $error) {
            echo "<tr><td colspan='7'>Erro na consulta: " . $error->getMessage() . "</td></tr>";
            return false;
        }
    }


    /*
    Esta função calcula o número total de páginas necessárias para exibir 
    todos os prontuários, com base no número de registros por página definido 
    na propriedade $records_per_page da classe.
    */
    public function pagination_prontuarios($id_paciente)
    {
        // Consulta para obter o número total de prontuários
        $count_query = $this->connect()->prepare("
            SELECT COUNT(*) AS total_prontuarios
            FROM prontuario po
            INNER JOIN paciente pe ON pe.ID = po.ID_paciente
            WHERE pe.ID = :id_paciente
        ");
        $count_query->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
        $count_query->execute();
        $total_prontuarios = $count_query->fetch(PDO::FETCH_ASSOC)['total_prontuarios'];

        return ceil($total_prontuarios / $this->records_per_page);
    }


    /*
        Esta função insere um novo prontuário no banco de dados com os dados fornecidos.
        
        Parâmetros:
            - $ID_paciente (int): O ID do paciente associado ao prontuário.
            - $ID_doenca (int): O ID da doença associada ao prontuário.
            - $status_diagnostico (string): O status do diagnóstico.
            - $obito (int): Indica se houve óbito ou não (0 para não, 1 para sim).
            - $ID_funcionario (int): O ID do funcionário que registrou o prontuário.
        
        Comportamento:
            - Se a inserção for bem-sucedida, o prontuário é adicionado ao banco de dados.
            - Se ocorrer algum erro durante a execução da inserção, uma mensagem de erro é definida.
    */
    public function insert_prontuario($ID_paciente, $ID_doenca, $status_diagnostico, $obito, $ID_funcionario)
    {
        try {
            $stmt = $this->connect()->prepare("
                INSERT INTO prontuario 
                (ID_paciente, ID_doenca, status_diagnostico, obito, ID_funcionario) 
                VALUES (?, ?, ?, ?, ?)
            ");

            if (!$stmt) {
                throw new Exception("Erro ao preparar a declaração: " . implode(", ", $this->connect()->errorInfo()));
            }

            $bind_result = $stmt->execute([$ID_paciente, $ID_doenca, $status_diagnostico, $obito, $ID_funcionario]);

            if (!$bind_result) {
                throw new Exception('Ocorreu um erro ao salvar o prontuário');
            }

            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    /*
        Esta função atualiza um prontuário existente no banco de dados com os novos dados fornecidos.
    */
    public function update_prontuario($ID_doenca, $status_diagnostico, $obito, $ID_funcionario, $ID_prontuario)
    {
        try {
            $result = $this->connect()->prepare("
                UPDATE 
                    prontuario 
                SET 
                    ID_doenca=:id_doenca, 
                    status_diagnostico=:diagnostico, 
                    obito=:numObito, 
                    ID_funcionario=:id_func
                WHERE 
                    id=:id_pront;
            ");
            $result->bindParam(':id_doenca', $ID_doenca, PDO::PARAM_INT);
            $result->bindParam(':diagnostico', $status_diagnostico, PDO::PARAM_STR);
            $result->bindParam(':numObito', $obito, PDO::PARAM_INT);
            $result->bindParam(':id_func', $ID_funcionario, PDO::PARAM_INT);
            $result->bindParam(':id_pront', $ID_prontuario, PDO::PARAM_INT);
            
            if (!$result) {
                throw new Exception("Erro ao preparar a declaração: " . implode(", ", $this->connect()->errorInfo()));
            }
            
            if (!$result->execute()) {
                throw new Exception('Ocorreu um erro ao salvar o prontuário');
            }
            
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
