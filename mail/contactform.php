<?php
	// Verifica se há campos vazios
	if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["subject"]) || empty($_POST["message"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		http_response_code(500);
		exit();
	}

	$name = strip_tags(htmlspecialchars($_POST["name"]));
	$email = strip_tags(htmlspecialchars($_POST["email"]));
	$subject = strip_tags(htmlspecialchars($_POST["subject"]));
	$message = strip_tags(htmlspecialchars($_POST["message"]));

	// Cria o e-mail e envia a mensagem
	$to = "clinicamedicaarapua@hotmail.com"; // E-mail para onde será encaminhada a mensagem
	$subject = "Formulário de contato: " . date("d-m-Y H:i");
	$body = "Você recebeu uma nova mensagem do website.\n\nAqui estão os detalhes:\n\nNome: $name\n\nE-mail: $email\n\nAssunto: $subject\n\nMensagem: $message";
	$header = "From: naoresponder@clinicamedicaarapua.com\n"; // E-mail que encaminhará a mensagem
	$header .= "Reply-To: $email";

	if (!mail($to, $subject, $body, $header))
		http_response_code(500);
