<?php
$connect = new PDO("mysql:host=localhost;dbname=biblioteca", "root", "");
if (isset($_POST["nome"])) {
	$busca = $_POST["nome"];
	$query = "select * from livros where titulo like '%".$busca."%' order by titulo";
}
else {
	$query = "select * from livros order by titulo";
}
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$rowCount = $statement->rowCount();

if ($rowCount > 0) {
	$data = '<div class="table-responsive">
		<table class="table bordered">
		<tr>
			<th>id</th>
			<th>titulo</th>
			<th>autor</th>
			<th>ano</th>

		</tr>
	';
	foreach($result as $row) {
		$data .= '
			<tr>
				<td>'.$row["id"].'</td>
				<td>'.$row["titulo"].'</td>
				<td>'.$row["autor"].'</td>
				<td>'.$row["ano_publicacao"].'</td>
			</tr>
		';
	}
	$data .= '</table></div>';
}
else {
	$data = "Nenhum registro localizado.";
}

echo $data;
