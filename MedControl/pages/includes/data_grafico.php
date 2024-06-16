<?php
class DataGraphic extends medcontrol_db
{
    public $records_per_page = 10;

    public function MapaGeoChart($tipo_casos, $id_doenca=1, $statusObito = 0)
    {
        try {
            // Monta a condição do WHERE baseada no tipo de casos escolhido
            $where_condition = "";
            if ($tipo_casos == 'confirmado') {
                $where_condition = "pr.status_diagnostico = 'Confirmado'";
                $situacao = "'Contaminados: '";
            } elseif ($tipo_casos == 'suspeito') {
                $where_condition = "pr.status_diagnostico = 'Suspeito'";
                $situacao = "'Suspeitos: '";
            } elseif ($tipo_casos == 'todos') {
                $where_condition = "(pr.status_diagnostico)";
                $situacao = "'Mortos: '";
            }

            $query = "
                SELECT 
                    p.cidade AS cidade, 
                    COUNT(*) AS contaminados, 
                    CONCAT($situacao, COUNT(*)) AS Infoadicional,
                    d.nome AS doenca
                FROM 
                    prontuario pr
                JOIN 
                    paciente p ON pr.ID_paciente = p.ID
                JOIN 
                    doencas d ON pr.ID_doenca = d.ID
                WHERE 
                    $where_condition
                    AND pr.ID_doenca = :id_doenca
                    AND pr.obito = :statusObito
                    AND YEAR(pr.data_diagnostico) = :ano_atual
                GROUP BY 
                    p.cidade, d.nome;
            ";

            $ano_atual = date('Y');
            $result = $this->connect()->prepare($query);
            $result->bindParam(':id_doenca', $id_doenca, PDO::PARAM_INT);
            $result->bindParam(':statusObito', $statusObito, PDO::PARAM_INT);
            $result->bindParam(':ano_atual', $ano_atual, PDO::PARAM_INT);

            $result->execute();

            if ($result->rowCount() > 0) {
                $data = array();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return array();
            }
        } catch (PDOException $error) {
            echo "Erro na consulta: " . $error->getMessage();
            return false;
        }
    }


    public function GraficoXChart($tipo_casos, $id_doenca=1, $statusObito = 0)
    {
        try {
            $where_condition = "";
            if ($tipo_casos == 'confirmado') {
                $where_condition = "pr.status_diagnostico = 'Confirmado'";
            } elseif ($tipo_casos == 'suspeito') {
                $where_condition = "pr.status_diagnostico = 'Suspeito'";
            } elseif ($tipo_casos == 'todos') {
                $where_condition = "(pr.status_diagnostico)";
            }

            $data = array();

            $queryAtual = "
                SELECT 
                    WEEK(data_diagnostico) AS Semana,
                    COUNT(*) AS Casos
                FROM 
                    prontuario pr
                WHERE 
                    $where_condition
                    AND pr.ID_doenca = :id_doenca
                    AND pr.obito = :statusObito
                    AND YEAR(pr.data_diagnostico) = YEAR(CURDATE())
                GROUP BY 
                    Semana
                ORDER BY 
                    Semana;
            ";

            $queryPassado = "
                SELECT 
                    WEEK(pr.data_diagnostico) AS Semana,
                    COUNT(*) AS Casos
                FROM 
                    prontuario pr
                WHERE 
                    $where_condition
                    AND pr.ID_doenca = :id_doenca
                    AND pr.obito = :statusObito
                    AND YEAR(pr.data_diagnostico) = YEAR(CURDATE()) - 1
                GROUP BY 
                    Semana
                ORDER BY 
                    Semana;
            ";
            
            // Preparando e executando consulta para o ano atual
            $resultAtual = $this->connect()->prepare($queryAtual);
            $resultAtual->bindParam(':id_doenca', $id_doenca, PDO::PARAM_INT);
            $resultAtual->bindParam(':statusObito', $statusObito, PDO::PARAM_INT);
            $resultAtual->execute();
            
            // Processando resultados para o ano atual
            if ($resultAtual->rowCount() > 0) {
                while ($row = $resultAtual->fetch(PDO::FETCH_ASSOC)) {
                    $data['anoAtual'][] = array('Semana' => $row['Semana'], 'Casos' => $row['Casos']);
                }
            }
            
            // Preparando e executando consulta para o ano passado
            $resultPassado = $this->connect()->prepare($queryPassado);
            $resultPassado->bindParam(':id_doenca', $id_doenca, PDO::PARAM_INT);
            $resultPassado->bindParam(':statusObito', $statusObito, PDO::PARAM_INT);
            $resultPassado->execute();
            
            // Processando resultados para o ano passado
            if ($resultPassado->rowCount() > 0) {
                while ($row = $resultPassado->fetch(PDO::FETCH_ASSOC)) {
                    $data['anoPassado'][] = array('Semana' => $row['Semana'], 'Casos' => $row['Casos']);
                }
            }
            
            return $data;
        } catch (PDOException $error) {
            echo "Erro na consulta: " . $error->getMessage();
            return false;
        }
    }


    public function GraficoLinhaChart($tipo_casos, $id_doenca=1, $statusObito = 0)
    {
        try {
            // Monta a condição do WHERE baseada no tipo de casos escolhido
            $where_condition = "";
            if ($tipo_casos == 'confirmado') {
                $where_condition = "pr.status_diagnostico = 'Confirmado'";
            } elseif ($tipo_casos == 'suspeito') {
                $where_condition = "pr.status_diagnostico = 'Suspeito'";
            } elseif ($tipo_casos == 'todos') {
                $where_condition = "1=1";
            }
    
            // Query para construção das colunas dinâmicas
            $sqlColumns = "
                SELECT GROUP_CONCAT(DISTINCT
                    CONCAT(
                        'SUM(CASE WHEN p.cidade = \"', cidade, '\" THEN 1 ELSE 0 END) AS `', REPLACE(cidade, ' ', '_'), '`'
                    )
                ) AS columns
                FROM (
                    SELECT cidade
                    FROM paciente
                    GROUP BY cidade
                    ORDER BY COUNT(*) DESC
                    LIMIT 10
                ) AS c;
            ";
    
            // Executa a query para obter as colunas
            $stmt = $this->connect()->query($sqlColumns);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$result || !$result['columns']) {
                return [];
            }
    
            $columns = $result['columns'];
    
            // Query principal usando as colunas dinâmicas
            $query = "
                SELECT WEEK(pr.data_diagnostico) AS Semana, $columns
                FROM prontuario pr
                JOIN paciente p ON pr.ID_paciente = p.ID
                WHERE 
                    $where_condition
                    AND YEAR(pr.data_diagnostico) >= YEAR(CURDATE())
                    AND pr.ID_doenca = :id_doenca
                    AND pr.obito = :statusObito
                GROUP BY Semana
                ORDER BY Semana;
            ";
    
            $stmt = $this->connect()->prepare($query);
            $stmt->bindParam(':id_doenca', $id_doenca, PDO::PARAM_INT);
            $stmt->bindParam(':statusObito', $statusObito, PDO::PARAM_INT);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $columns = array();
                $rows = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $row_data = array();
                    foreach ($row as $key => $value) {
                        if ($key == 'Semana') {
                            $row_data[] = $value;
                        } else {
                            $row_data[] = (int) $value;
                            if (!in_array($key, $columns)) {
                                $columns[] = $key;
                            }
                        }
                    }
                    $rows[] = $row_data;
                }
                $response = array(
                    'columns' => $columns,
                    'rows' => $rows
                );
                return $response;
            } else {
                return array();
            }
        } catch (PDOException $error) {
            echo "Erro na consulta: " . $error->getMessage();
            return false;
        }
    }


    public function GraficoLista($id_doenca=1, $page = 1)
    {
        try {
            $offset = ($page - 1) * $this->records_per_page;
            $query = "
                SELECT
                    @rownum := @rownum + 1 AS id,
                    subquery.cidade,
                    subquery.total_confirmado,
                    subquery.total_suspeito,
                    subquery.total_obitos
                FROM (
                    SELECT
                        pa.cidade,
                        SUM(CASE WHEN pr.status_diagnostico = 'Confirmado' THEN 1 ELSE 0 END) AS total_confirmado,
                        SUM(CASE WHEN pr.status_diagnostico = 'Suspeito' THEN 1 ELSE 0 END) AS total_suspeito,
                        SUM(CASE WHEN pr.obito = 1 THEN 1 ELSE 0 END) AS total_obitos
                    FROM 
                        prontuario pr 
                    INNER JOIN 
                        paciente pa 
                        ON pa.ID = pr.ID_paciente
                    WHERE 
                        pr.ID_doenca = :id_doenca
                        AND YEAR(pr.data_diagnostico) = YEAR(CURDATE())
                    GROUP BY
                        pa.cidade
                    ORDER BY 
                        total_confirmado DESC, 
                        total_suspeito DESC,
                        total_obitos DESC
                    LIMIT $offset, :records_per_page
                ) AS subquery,
                (SELECT @rownum := 0) AS r;
            ";
    
            $stmt = $this->connect()->prepare($query);
            $stmt->bindParam(':records_per_page', $this->records_per_page, PDO::PARAM_INT);
            $stmt->bindParam(':id_doenca', $id_doenca, PDO::PARAM_INT);
            $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
                $data = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return array();
            }
        } catch (PDOException $error) {
            echo "Erro na consulta: " . $error->getMessage();
            return false;
        }
    }


    /*
    Esta função calcula o número total de páginas necessárias para exibir o
    total de casos, com base no número de registros por página definido 
    na propriedade $records_per_page da classe.
    */
    public function pagination_casos($id_doenca=1)
    {   
        $count_query = $this->connect()->prepare("
            SELECT COUNT(DISTINCT pa.cidade) as total_cidades
            FROM prontuario pr
            INNER JOIN paciente pa ON pa.ID = pr.ID_paciente
            WHERE pr.ID_doenca = :id_doenca
        ");
        
        $count_query->bindParam(':id_doenca', $id_doenca, PDO::PARAM_INT);
        $count_query->execute();
        
        $total_cidades = $count_query->fetch(PDO::FETCH_ASSOC)['total_cidades'];
        
        return ceil($total_cidades / $this->records_per_page);
    }


    public function total_casos($tipo_casos, $id_doenca, $statusObito = 0)
    {
        try {
            $where_condition = "";
            if ($tipo_casos == 'confirmado') {
                $where_condition = "pr.status_diagnostico = 'Confirmado'";
            } elseif ($tipo_casos == 'suspeito') {
                $where_condition = "pr.status_diagnostico = 'Suspeito'";
            } elseif ($tipo_casos == 'todos') {
                $where_condition = "pr.status_diagnostico";
            }

            $count_query = $this->connect()->prepare("
                SELECT 
                    total_confirmado,
                    novos_confirmados
                FROM (
                    SELECT 
                        COUNT(*) as total_confirmado
                    FROM 
                        prontuario pr
                    WHERE
                        $where_condition
                        AND pr.ID_doenca = :id_doenca
                        AND pr.obito = :statusObito
                ) AS total,
                (
                    SELECT 
                        COUNT(*) as novos_confirmados
                    FROM 
                        prontuario pr
                    WHERE
                        $where_condition
                        AND pr.ID_doenca = :id_doenca
                        AND pr.obito = :statusObito
                        AND DATE(pr.data_diagnostico) >= CURDATE() - INTERVAL 1 WEEK
                        AND DATE(pr.data_diagnostico) <= CURDATE()
                ) AS novos;
            ");
            
            $count_query->bindParam(':id_doenca', $id_doenca, PDO::PARAM_INT);
            $count_query->bindParam(':statusObito', $statusObito, PDO::PARAM_INT);
            $count_query->execute();
            
            if ($count_query->rowCount() > 0) {
                $data = array();
                while ($row = $count_query->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return array();
            }
        } catch (PDOException $error) {
            echo "Erro na consulta: " . $error->getMessage();
            return false;
        }
    }


    public function select_all_cids() {
        try {
            $result = $this->connect()->query("SELECT * FROM doencas");
            if ($result->rowCount() > 0) {
                $data = array();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return array();
            }
        } catch (PDOException $error){
            echo "Erro na consulta: " . $error->getMessage();
            return false;
        }
    }
}
