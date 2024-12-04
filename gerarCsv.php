<?php
include_once("./dao/clsConexao.php");
include_once("./dao/clsEvent.php");
session_start();

if (isset($_POST['evento_id'])) {
    $event = new Event();
    $event->id = $_POST['evento_id'];
    $event->name = $_POST['n'];
    $query = "SELECT i.id, i.nome, i.email, i.matricula, i.cpf, i.cidade, i.estado, i.sexo, i.nota, e.name, e.id FROM inscritos_fadergs i JOIN event e on e.id = i.evento_id WHERE i.evento_id = " . $event->id;
    $result = Conexao::consultar($query);

if (mysqli_num_rows($result) > 0) {
  // Nome do arquivo CSV
  $filename = "lista_inscritos_" . $event->name . ".csv";

  // Cabeçalhos do CSV
  $headers = array(
    "ID",
    "Nome",
    "Email",
    "Matrícula",
    "CPF",
    "Cidade",
    "Estado",
    "Sexo",
    "Nota",
    "Nome do Evento"
  );

  // Abrir o arquivo CSV para escrita
  $file = fopen($filename, "w");

  // Escrever os cabeçalhos no arquivo CSV
  fputcsv($file, $headers);

  // Escrever os dados dos inscritos no arquivo CSV
  while ($row = mysqli_fetch_assoc($result)) {
    $data = array(
      $row['id'],
      $row['nome'],
      $row['email'],
      $row['matricula'],
      $row['cpf'],
      $row['cidade'],
      $row['estado'],
      $row['sexo'],
      $row['nota'],
      $row['name']
    );
    fputcsv($file, $data);
  }

  // Fechar o arquivo CSV
  fclose($file);

  // Redirecionar para o arquivo CSV gerado
  header("Location: " . $filename);
  exit();
} else {
  echo "Nenhum resultado encontrado.";
 }
}
?>
